<?php

namespace CurrencyCloud\Client;

class Client
{

    const API_URL_PRODUCTION = 'https://api.thecurrencycloud.com';
    const API_URL_DEMONSTRATION = 'https://devapi.thecurrencycloud.com';
    const API_URL_UAT = 'https://api-uat1.ccycloud.com';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;
    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @param string $apiUrl
     * @param \GuzzleHttp\Client $client
     */
    public function __construct($apiUrl, \GuzzleHttp\Client $client)
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
    }
}
