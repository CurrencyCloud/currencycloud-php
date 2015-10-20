<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Client;
use CurrencyCloud\Model\Pagination;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use ReflectionClass;
use stdClass;

abstract class AbstractEntryPoint
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string$method
     * @param string$uri
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
        return $this->client->request($method, $uri, $queryParams, $requestParams, $options, $secured);
    }

    /**
     * @param stdClass $response
     *
     * @return Pagination
     */
    protected function createPaginationFromResponse(stdClass $response)
    {
        $pagination = $response->pagination;
        return Pagination::create(
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
