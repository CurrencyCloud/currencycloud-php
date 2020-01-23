<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\FundingEntryPoint;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class FundingEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canFindFundingAccounts()
    {
        $data = '{
            "funding_accounts": [
              {
                "id": "b7981972-8e29-485b-8a4a-9643fc6ae3sa",
                "account_id": "8d98bdc8-e8e3-47dc-bd08-3dd0f4f7ea7b",
                "account_number": "012345678",
                "account_number_type":"account_number",
                "account_holder_name": "Jon Doe",
                "bank_name": "Starling",
                "bank_address": "3rd floor, 2 Finsbury Avenue, London, EC2M 2PP, GB",
                "bank_country": "UK",
                "currency": "GBP",
                "payment_type": "regular",
                "routing_code": "010203",
                "routing_code_type": "sort_code",
                "created_at": "2018-05-14T14:18:30+00:00",
                "updated_at": "2018-05-14T14:19:30+00:00"
              }
            ],
            "pagination": {
              "total_entries": 1,
              "total_pages": 1,
              "current_page": 1,
              "per_page": 5,
              "previous_page": -1,
              "next_page": -1,
              "order": "created_at",
              "order_asc_desc": "desc"
            }
            }';

        $entryPoint = new FundingEntryPoint(
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'funding_accounts/find',
                [
                    'account_id' => null,
                    'payment_type' => null,
                    'currency' => "GBP",
                    'per_page' => 5,
                    'page' => null,
                    'order' => null,
                    'order_asc_desc' => null
                ]
            )
        );
        $accounts = $entryPoint->findFundingAccounts((new Pagination())->setPerPage(5),"GBP");
        $pagination = $accounts->getPagination();

        $this->assertSame(1, count($accounts->getFundingAccounts()));

        $account = $accounts->getFundingAccounts()[0];
        $this->assertSame("b7981972-8e29-485b-8a4a-9643fc6ae3sa", $account->getId());
        $this->assertSame("8d98bdc8-e8e3-47dc-bd08-3dd0f4f7ea7b", $account->getAccountId());
        $this->assertSame("012345678", $account->getAccountNumber());
        $this->assertSame("account_number", $account->getAccountNumberType());
        $this->assertSame("Jon Doe", $account->getAccountHolderName());
        $this->assertSame("Starling", $account->getBankName());
        $this->assertSame("3rd floor, 2 Finsbury Avenue, London, EC2M 2PP, GB", $account->getBankAddress());
        $this->assertSame("UK", $account->getBankCountry());
        $this->assertSame("GBP", $account->getCurrency());
        $this->assertSame("regular", $account->getPaymentType());
        $this->assertSame("010203",  $account->getRoutingCode());
        $this->assertSame("sort_code", $account->getRoutingCodeType());
        $this->assertSame("2018-05-14T14:18:30+00:00", $account->getCreatedAt()->format(DateTime::RFC3339));
        $this->assertSame("2018-05-14T14:19:30+00:00", $account->getUpdatedAt()->format(DateTime::RFC3339));
        $this->assertSame(1, $pagination->getTotalEntries());
        $this->assertSame(1, $pagination->getTotalPages());
        $this->assertSame(1, $pagination->getCurrentPage());
        $this->assertSame(5, $pagination->getPerPage());
        $this->assertSame(-1, $pagination->getPreviousPage());
        $this->assertSame(-1, $pagination->getNextPage());
        $this->assertSame("created_at", $pagination->getOrder());
        $this->assertSame("desc", $pagination->getOrderAscDesc());


    }
}