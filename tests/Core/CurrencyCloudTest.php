<?php

namespace CurrencyCloud\Tests\Core;

use CurrencyCloud\Client;
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
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use GuzzleHttp\Psr7\Response;
use LogicException;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CurrencyCloudTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canCreateDefaultInstance()
    {
        $session = new Session(Session::ENVIRONMENT_DEMONSTRATION, 'a', 'b');
        $client = CurrencyCloud::createDefault($session);

        $this->assertSame($session, $client->getSession());
        $this->assertInstanceOf(AuthenticateEntryPoint::class, $client->authenticate());
        $this->assertInstanceOf(AccountsEntryPoint::class, $client->accounts());
        $this->assertInstanceOf(BalancesEntryPoint::class, $client->balances());
        $this->assertInstanceOf(BeneficiariesEntryPoint::class, $client->beneficiaries());
        $this->assertInstanceOf(ContactsEntryPoint::class, $client->contacts());
        $this->assertInstanceOf(ConversionsEntryPoint::class, $client->conversions());
        $this->assertInstanceOf(PayersEntryPoint::class, $client->payers());
        $this->assertInstanceOf(PaymentsEntryPoint::class, $client->payments());
        $this->assertInstanceOf(ReferenceEntryPoint::class, $client->reference());
        $this->assertInstanceOf(RatesEntryPoint::class, $client->rates());
        $this->assertInstanceOf(SettlementsEntryPoint::class, $client->settlements());
        $this->assertInstanceOf(TransactionsEntryPoint::class, $client->transactions());
    }

    /**
     * @test
     */
    public function onBehalfOfWorks()
    {
        $transactionsData = '{"id":"c5a990eb-d4d7-482f-bfb1-695261fb1e4d","balance_id":"c5f1f54e-d6d8-4140-8110-f5b99bbc80c3","account_id":"7b9757a8-eee9-4572-86e6-77f4d711eaa6","currency":"USD","amount":"1000.00","balance_amount":"2000.00","type":"credit","action":"conversion","related_entity_type":"conversion","related_entity_id":"ConversionUUID","related_entity_short_reference":"140416-GGJBNQ001","status":"completed","reason":"Reason for Transaction","settles_at":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","completed_at":"2014-01-12T12:24:19+00:00"}';

        $contactsData = '{"login_id":"john.smith","id":"543477161-91de-012f-e284-1e0030c7f352","your_reference":"ACME12345","first_name":"John","last_name":"Smith","account_id":"87077161-91de-012f-e284-1e0030c7f352","account_name":"Company PLC","status":"enabled","phone_number":"06554 87845","mobile_phone_number":"07564 534 54","locale":"en-US","timezone":"Europe/London","email_address":"john.smith@company.com","date_of_birth":"1980-01-22","created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}';

        $mockedClient = $this->getMock(\GuzzleHttp\Client::class, ['request']);

        $mockedClient->expects($this->exactly(2))->method('request')->withConsecutive(
            [$this->equalTo('GET'), 'https://devapi.thecurrencycloud.com/v2/transactions/hi?on_behalf_of=aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa'],
            [$this->equalTo('GET'), 'https://devapi.thecurrencycloud.com/v2/contacts/hi?on_behalf_of=aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa']
        )
            ->will($this->onConsecutiveCalls(
                new Response(200, [], $transactionsData),
                new Response(200, [], $contactsData)
            ));

        /* @var \GuzzleHttp\Client $mockedClient */

        $session = new Session(Session::ENVIRONMENT_DEMONSTRATION, 'a', 'b');
        $currencyCloudClient = new Client($session, $mockedClient, new EventDispatcher());
        $client = CurrencyCloud::createDefault($session, $currencyCloudClient);

        $client->onBehalfOf('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa', function (CurrencyCloud $client) use ($transactionsData, $contactsData) {
            $transaction = $client->transactions()->retrieve('hi');
            $this->validateObjectStrictName($transaction, json_decode($transactionsData, true));
            $contact = $client->contacts()->retrieve('hi');
            $this->validateObjectStrictName($contact, json_decode($contactsData, true));
        });
    }

    /**
     * @test
     */
    public function onBehalfOfFailsWhenInOnBehalfOf()
    {
        $this->setExpectedException(LogicException::class);

        $mockedClient = $this->getMock(\GuzzleHttp\Client::class, ['request']);

        /* @var \GuzzleHttp\Client $mockedClient */

        $session = new Session(Session::ENVIRONMENT_DEMONSTRATION, 'a', 'b');
        $currencyCloudClient = new Client($session, $mockedClient, new EventDispatcher());
        $client = CurrencyCloud::createDefault($session, $currencyCloudClient);

        $client->onBehalfOf('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa', function (CurrencyCloud $client) {
            $client->transactions()->retrieve('hi', 'aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaab');
        });
    }
}