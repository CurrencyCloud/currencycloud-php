<?php

namespace CurrencyCloud\EventDispatcher\Listener;

use CurrencyCloud\EventDispatcher\Event\ClientHttpErrorEvent;
use CurrencyCloud\Exception\ApiException;
use CurrencyCloud\Exception\AuthenticationException;
use CurrencyCloud\Exception\BadRequestException;
use CurrencyCloud\Exception\ForbiddenException;
use CurrencyCloud\Exception\InternalApplicationException;
use CurrencyCloud\Exception\NotFoundException;
use CurrencyCloud\Exception\ToManyRequestsException;

class ClientHttpErrorListener
{

    /**
     * @param ClientHttpErrorEvent $event
     */
    public function onClientHttpErrorEvent(ClientHttpErrorEvent $event)
    {
        $response = $event->getResponse();
        $requestParams = $event->getRequestParams();
        $method = $event->getMethod();
        $url = $event->getUrl();
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
                $class = ToManyRequestsException::class;
                break;
            case 500:
                $class = InternalApplicationException::class;
                break;
            default:
                $class = ApiException::class;
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
                    if (!is_array($messageContext)) {
                        $this->addError($field, $messageContexts, $errors, $messages);
                        break;
                    }
                    $this->addError($field, $messageContext, $errors, $messages);
                }
            }
            $message = implode('; ', $messages);
            $code = $decoded['error_code'];
        } else {
            $message = 'Invalid JSON describing error returned';
            $errors = null;
            $code = 0;
        }
        throw new $class($statusCode, $date, $requestId, $errors, $requestParams, $method, $url, $message, $code);
    }

    private function addError(string $field, array $messageContext, array &$errors, array &$messages) {
        $errors[] = [
            'field' => $field,
            'code' => $messageContext['code'],
            'message' => $messageContext['message'],
            'params' => $messageContext['params']
        ];
        $messages['message'] = $messageContext['message'];
    }
}
