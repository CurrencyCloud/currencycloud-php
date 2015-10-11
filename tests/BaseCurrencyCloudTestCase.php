<?php

namespace CurrencyCloud\Tests;

use CurrencyCloud\CurrencyCloud;
use CurrencyCloud\EntryPoint\AccountsEntryPoint;
use CurrencyCloud\EntryPoint\AuthenticateEntryPoint;
use CurrencyCloud\EntryPoint\BalancesEntryPoint;
use CurrencyCloud\EntryPoint\BeneficiariesEntryPoint;
use CurrencyCloud\EntryPoint\ContactsEntryPoint;
use CurrencyCloud\EntryPoint\ConversionsEntryPoint;
use CurrencyCloud\EntryPoint\PayersEntryPoint;
use CurrencyCloud\EntryPoint\PaymentsEntryPoint;
use CurrencyCloud\EntryPoint\RatesEntryPoint;
use CurrencyCloud\EntryPoint\ReferenceEntryPoint;
use CurrencyCloud\EntryPoint\SettlementsEntryPoint;
use CurrencyCloud\EntryPoint\TransactionsEntryPoint;
use CurrencyCloud\Session;
use GuzzleHttp\Client;
use PHPUnit_Framework_TestCase;

class BaseCurrencyCloudTestCase extends PHPUnit_Framework_TestCase
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

        $client = new Client();
        return new CurrencyCloud(
            $session,
            new AuthenticateEntryPoint($session, $client),
            new AccountsEntryPoint($session, $client),
            new BalancesEntryPoint($session, $client),
            new BeneficiariesEntryPoint($session, $client),
            new ContactsEntryPoint($session, $client),
            new ConversionsEntryPoint($session, $client),
            new PayersEntryPoint($session, $client),
            new PaymentsEntryPoint($session, $client),
            new ReferenceEntryPoint($session, $client),
            new RatesEntryPoint($session, $client),
            new SettlementsEntryPoint($session, $client),
            new TransactionsEntryPoint($session, $client)
        );
    }
}
