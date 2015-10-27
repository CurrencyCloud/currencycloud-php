<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Client;
use CurrencyCloud\SimpleEntityManager;

abstract class AbstractEntityEntryPoint extends AbstractEntryPoint
{

    /**
     * @var SimpleEntityManager
     */
    protected $entityManager;

    /**
     * @param SimpleEntityManager $entityManager
     * @param Client $client
     */
    public function __construct(SimpleEntityManager $entityManager, Client $client)
    {
        parent::__construct($client);
        $this->entityManager = $entityManager;
    }
}
