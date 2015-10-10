<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Exception\ApiException;
use CurrencyCloud\Exception\AuthenticationException;
use CurrencyCloud\Exception\BadRequestException;
use CurrencyCloud\Exception\ForbiddenException;
use CurrencyCloud\Exception\InternalApplicationException;
use CurrencyCloud\Exception\NotFoundException;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Session;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use ReflectionClass;
use stdClass;

abstract class AbstractEntryPoint
{

    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Session
     */
    protected $session;

    /**
     * @param Session $session
     * @param Client $client
     */
    public function __construct(Session $session, Client $client)
    {
        $this->client = $client;
        $this->session = $session;
    }

    /**
     * @param $method
     * @param $uri
     * @param array $queryParams
     * @param array $requestParams
     * @param array $options
     * @param bool $secured
     *
     * @return array|stdClass
     * @throws GuzzleException
     * @throws Exception
     */
    protected function request(
        $method,
        $uri,
        array $queryParams = [],
        array $requestParams = [],
        array $options = [],
        $secured = true
    ) {
        //Check for on behalf of in order to inject it if needed
        $isOnBehalfOfUsedInParams = false;
        foreach ([&$queryParams, &$requestParams] as &$paramsArray) {
            if (array_key_exists('on_behalf_of', $paramsArray)) { //isset is not used because id skips null-s
                if (null !== $paramsArray['on_behalf_of']) {
                    $this->session->setOnBehalfOf($paramsArray['on_behalf_of']);
                    $isOnBehalfOfUsedInParams = true;
                } else {
                    $onBehalfOf = $this->session->getOnBehalfOf();
                    if (null !== $onBehalfOf) {
                        $paramsArray['on_behalf_of'] = $onBehalfOf;
                    }
                }
            }
        }
        try {
            //Wrap whole section if someone, for example, throws exceptions for PHP warnings etc.
            if ($secured) {
                //Perhaps check here if auth token set?
                $options['headers']['X-Auth-Token'] = $this->session->getAuthToken();
            }
            $filter = function ($v) {
                return null !== $v;
            };
            $queryParams = array_filter($queryParams, $filter);
            $requestParams = array_filter($requestParams, $filter);
            if (count($requestParams) > 0) {
                if (!isset($options['form_params'])) {
                    $options['form_params'] = [];
                }
                $options['form_params'] = array_merge($options['form_params'], $requestParams);
            }

            //Force no-exceptions in order to provide descriptive error messages
            $options['http_errors'] = false;
            $url = $this->applyApiBaseUrl($uri, $queryParams);

            if ('GET' === $method) {
                $parameters = $queryParams;
            } else {
                $parameters = $requestParams;
            }

            $response = $this->client->request($method, $url, $options);

            $throwApiException = function ($class = null) use ($response, $parameters, $method, $url) {
                if (null === $class) {
                    switch ($response->getStatusCode()) {
                        case 400:
                            $class = BadRequestException::class;
                            break;
                        case 401:
                            $class = AuthenticationException::class;
                            break;
                        case 403:
                            $class = ForbiddenException::class;
                            break;
                        case 404:
                            $class = NotFoundException::class;
                            break;
                        case 429:
                            $class = TooManyRedirectsException::class;
                            break;
                        case 500:
                            $class = InternalApplicationException::class;
                            break;
                        default:
                            $class = ApiException::class;
                    }
                }
                $statusCode = $response->getStatusCode();
                $date = current($response->getHeader('Date'));
                $requestId = current($response->getHeader('X-Request-Id'));
                $body =
                    $response->getBody()
                        ->getContents();
                $decoded = json_decode($body, true);
                if (is_array($decoded)) {
                    $errors = [];
                    $messages = [];
                    foreach ($decoded['error_messages'] as $field => $messageContexts) {
                        foreach ($messageContexts as $messageContext) {
                            $errors[] = [
                                'field' => $field,
                                'code' => $messageContext['code'],
                                'message' => $messageContext['message'],
                                'params' => $messageContext['params']
                            ];
                            $messages['message'] = $messageContext['message'];
                        }
                    }
                    $message = implode('; ', $messages);
                    $code = $decoded['error_code'];
                } else {
                    $message = 'Invalid JSON describing error returned';
                    $errors = null;
                    $code = 0;
                }
                throw new $class($statusCode, $date, $requestId, $errors, $parameters, $method, $url, $message, $code);
            };

            switch ($response->getStatusCode()) {
                case 200:
                    $data = json_decode(
                        $response->getBody()
                            ->getContents()
                    );

                    if (!is_array($data)
                        && !is_object($data)
                    ) {
                        throw $throwApiException(ApiException::class);
                    }

                    return $data;
                default:
                    $throwApiException();
            }
        } finally {
            //If on-behalf-of was injected through params, clear it now
            if ($isOnBehalfOfUsedInParams) {
                $this->session->clearOnBehalfOf();
            }
        }
        throw new Exception(
            $response->getBody()
                ->getContents()
        );
    }

    /**
     * @param string $path
     * @param array $queryParams
     *
     * @return string
     */
    protected function applyApiBaseUrl($path, array $queryParams)
    {
        if (count($queryParams) > 0) {
            return sprintf('%s%s?%s', $this->session->getApiUrl(), $path, http_build_query($queryParams));
        }
        return sprintf('%s%s', $this->session->getApiUrl(), $path);
    }

    /**
     * @param stdClass $response
     *
     * @return Pagination
     */
    protected function createPaginationFromResponse(stdClass $response)
    {
        $pagination = $response->pagination;
        return new Pagination(
            $pagination->total_entries,
            $pagination->total_pages,
            $pagination->current_page,
            $pagination->per_page,
            $pagination->previous_page,
            $pagination->next_page,
            $pagination->order,
            $pagination->order_asc_desc
        );
    }

    /**
     * @param Pagination $pagination
     *
     * @return array
     */
    protected function convertPaginationToRequest(Pagination $pagination)
    {
        return [
            'page' => $pagination->getCurrentPage(),
            'per_page' => $pagination->getPerPage(),
            'order' => $pagination->getOrder(),
            'order_asc_desc' => $pagination->getOrderAscDesc()
        ];
    }

    /**
     * @param object $object
     * @param mixed $value
     * @param string $propertyName
     */
    protected function setIdProperty($object, $value, $propertyName = 'id')
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }
}
