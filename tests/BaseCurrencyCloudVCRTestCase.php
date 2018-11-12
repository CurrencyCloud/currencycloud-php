<?php

namespace CurrencyCloud\Tests;

use CurrencyCloud\Client;
use CurrencyCloud\CurrencyCloud;
use CurrencyCloud\EntryPoint\AccountsEntryPoint;
use CurrencyCloud\EntryPoint\AuthenticateEntryPoint;
use CurrencyCloud\EntryPoint\BalancesEntryPoint;
use CurrencyCloud\EntryPoint\BeneficiariesEntryPoint;
use CurrencyCloud\EntryPoint\ContactsEntryPoint;
use CurrencyCloud\EntryPoint\ConversionsEntryPoint;
use CurrencyCloud\EntryPoint\IbansEntryPoint;
use CurrencyCloud\EntryPoint\PayersEntryPoint;
use CurrencyCloud\EntryPoint\PaymentsEntryPoint;
use CurrencyCloud\EntryPoint\RatesEntryPoint;
use CurrencyCloud\EntryPoint\ReferenceEntryPoint;
use CurrencyCloud\EntryPoint\SettlementsEntryPoint;
use CurrencyCloud\EntryPoint\TransactionsEntryPoint;
use CurrencyCloud\EntryPoint\VansEntryPoint;
use CurrencyCloud\EventDispatcher\Event\BeforeClientRequestEvent;
use CurrencyCloud\EventDispatcher\Event\ClientHttpErrorEvent;
use CurrencyCloud\EventDispatcher\Listener\BeforeClientRequestListener;
use CurrencyCloud\EventDispatcher\Listener\ClientHttpErrorListener;
use CurrencyCloud\EventDispatcher\Listener\SessionTimeoutListener;
use CurrencyCloud\Session;
use CurrencyCloud\SimpleEntityManager;
use GuzzleHttp\Handler\CurlFactory;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use Symfony\Component\EventDispatcher\EventDispatcher;

class BaseCurrencyCloudVCRTestCase extends BaseCurrencyCloudTestCase
{

    /**
     * @param string $loginId
     * @param string $apiKey
     *
     * @return CurrencyCloud
     */
    protected function getClient(
        $loginId = 'rjnienaber@gmail.com',
        $apiKey = 'ef0fd50fca1fb14c1fab3a8436b9ecb65f02f129fd87eafa45ded8ae257528f0'
    ) {
        //We do not use static method in CurrencyCloud because we are not testing it
        $session = new Session(Session::ENVIRONMENT_DEMONSTRATION, $loginId, $apiKey);

        $eventDispatcher = new EventDispatcher();

        $client = new Client($session, new \GuzzleHttp\Client([
            'sync' => true,
            'handler' => HandlerStack::create(new CurlHandler([
                'handle_factory' => new CurlFactory(0)
            ]))
        ]), $eventDispatcher);

        $authenticateEntryPoint = new AuthenticateEntryPoint($session, $client);

        $eventDispatcher->addListener(ClientHttpErrorEvent::NAME, [
            new ClientHttpErrorListener(), 'onClientHttpErrorEvent'
        ], -255);
        $eventDispatcher->addListener(ClientHttpErrorEvent::NAME, [
            new SessionTimeoutListener($client, $authenticateEntryPoint), 'onClientHttpErrorEvent'
        ], -254);
        $eventDispatcher->addListener(BeforeClientRequestEvent::NAME, [
            new BeforeClientRequestListener($session, $authenticateEntryPoint), 'onBeforeClientRequestEvent'
        ], -255);
        $entityManager = new SimpleEntityManager();
        return new CurrencyCloud(
            $session,
            $authenticateEntryPoint,
            new AccountsEntryPoint($entityManager, $client),
            new BalancesEntryPoint($client),
            new BeneficiariesEntryPoint($entityManager, $client),
            new ContactsEntryPoint($entityManager, $client),
            new ConversionsEntryPoint($client),
            new PayersEntryPoint($client),
            new IbansEntryPoint($entityManager, $client),
            new PaymentsEntryPoint($entityManager, $client),
            new ReferenceEntryPoint($client),
            new RatesEntryPoint($client),
            new SettlementsEntryPoint($entityManager, $client),
            new TransactionsEntryPoint($client),
            new VansEntryPoint($entityManager, $client)
        );
    }

    /**
     * @param string $authToken
     *
     * @return CurrencyCloud
     */
    protected function getAuthenticatedClient($authToken = '038022bcd2f372cac7bab448db7b5c3b')
    {
        $client = $this->getClient();
        $client->getSession()->setAuthToken($authToken);
        return $client;
    }
}
