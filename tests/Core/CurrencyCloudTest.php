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
use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\Payment;
use CurrencyCloud\Session;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use GuzzleHttp\Psr7\Response;
use LogicException;
use RuntimeException;
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

        $paymentsData = '{"id":"543477161-91de-012f-e284-1e0030c7f3123","unique_request_id":null,"short_reference":"140416-GGJANQ001","beneficiary_id":"543477161-91de-012f-e284-1e0030c7f352","conversion_id":"543477161-91de-012f-e284-1e0030c7f352","amount":"1250000.00","currency":"GBP","status":"ready_to_send","payment_type":"regular","reference":"INVOICE 9876","reason":"Salary for March","payment_date":"2014-01-12T00:00:00+00:00","transferred_at":"2014-01-12T13:00:00+00:00","authorisation_steps_required":"0","creator_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","last_updater_contact_id":"ab3477161-91de-012f-e284-1e0030c7f35c","failure_reason":"","payer_id":"","payer_details_source":"","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","failure_returned_amount":"", "purpose_code": null, "charge_type": null, "fee_amount": null, "fee_currency": null}';

        $mockedClient = $this->getMock(\GuzzleHttp\Client::class, ['request']);

        $mockedClient->expects($this->exactly(2))->method('request')->withConsecutive(
            [$this->equalTo('GET'), 'https://devapi.currencycloud.com/v2/transactions/hi?on_behalf_of=aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa'],
            [$this->equalTo('POST'), 'https://devapi.currencycloud.com/v2/payments/me/delete', $this->equalTo([
                'headers' => [
                    'X-Auth-Token' => null,
                    'User-Agent' => 'CurrencyCloudSDK/2.0 PHP/'.CurrencyCloud::$SDK_VERSION
                ],
                'multipart' => [
                    ['name' =>'on_behalf_of', 'contents' => 'aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa']
                ],
                'http_errors' => false
            ])]
        )
            ->will($this->onConsecutiveCalls(
                new Response(200, [], $transactionsData),
                new Response(200, [], $paymentsData)
            ));

        /* @var \GuzzleHttp\Client $mockedClient */

        $session = new Session(Session::ENVIRONMENT_DEMONSTRATION, 'a', 'b');
        $currencyCloudClient = new Client($session, $mockedClient, new EventDispatcher());
        $client = CurrencyCloud::createDefault($session, $currencyCloudClient);

        $client->onBehalfOf('aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa', function (CurrencyCloud $client) use ($transactionsData, $paymentsData) {
            $transaction = $client->transactions()->retrieve('hi');
            $this->validateObjectStrictName($transaction, json_decode($transactionsData, true));
            $payment = new Payment();
            $this->setIdProperty($payment, 'me');
            $contact = $client->payments()->delete($payment);
            $this->validateObjectStrictName($contact, json_decode($paymentsData, true));
        });

        $this->assertNull($session->getOnBehalfOf());
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

    /**
     * @test
     */
    public function canOnBehalfOfFromMethod()
    {
        $mockedClient = $this->getMock(\GuzzleHttp\Client::class, ['request']);

        $transactionsData = '{"id":"c5a990eb-d4d7-482f-bfb1-695261fb1e4d","balance_id":"c5f1f54e-d6d8-4140-8110-f5b99bbc80c3","account_id":"7b9757a8-eee9-4572-86e6-77f4d711eaa6","currency":"USD","amount":"1000.00","balance_amount":"2000.00","type":"credit","action":"conversion","related_entity_type":"conversion","related_entity_id":"ConversionUUID","related_entity_short_reference":"140416-GGJBNQ001","status":"completed","reason":"Reason for Transaction","settles_at":"2014-01-12T12:24:19+00:00","created_at":"2014-01-12T12:24:19+00:00","updated_at":"2014-01-12T12:24:19+00:00","completed_at":"2014-01-12T12:24:19+00:00"}';

        $mockedClient->expects($this->once())->method('request')->withConsecutive(
            [$this->equalTo('GET'), 'https://devapi.currencycloud.com/v2/transactions/hi?on_behalf_of=aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa']
        )
            ->will($this->onConsecutiveCalls(
                new Response(200, [], $transactionsData)
            ));

        /* @var \GuzzleHttp\Client $mockedClient */

        $session = new Session(Session::ENVIRONMENT_DEMONSTRATION, 'a', 'b');
        $currencyCloudClient = new Client($session, $mockedClient, new EventDispatcher());
        $client = CurrencyCloud::createDefault($session, $currencyCloudClient);

        $transaction = $client->transactions()->retrieve('hi', 'aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa');
        $this->validateObjectStrictName($transaction, json_decode($transactionsData, true));
    }

    /**
     * @test
     */
    public function exceptionWhenEntityIsNotManagedByManager()
    {
        $mockedClient = $this->getMock(\GuzzleHttp\Client::class, ['request']);

        $this->setExpectedException(RuntimeException::class, 'Entity is not managed by entity manager and therefore can not be updated');

        /* @var \GuzzleHttp\Client $mockedClient */

        $session = new Session(Session::ENVIRONMENT_DEMONSTRATION, 'a', 'b');
        $currencyCloudClient = new Client($session, $mockedClient, new EventDispatcher());
        $client = CurrencyCloud::createDefault($session, $currencyCloudClient);

        $client->accounts()->update(new Account());
    }
}
