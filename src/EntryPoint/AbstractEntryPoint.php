<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Client\Client;

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
}
