<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\Criteria\FindWithdrawalAccountsCriteria;
use CurrencyCloud\EntryPoint\WithdrawalAccountsEntryPoint;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class WithdrawalAccountsEntryPointTest extends BaseCurrencyCloudTestCase
{
    /**
     * @test
     */
    public function testCanFindWithdrawalAccount()
    {
        $data = '{"withdrawal_accounts": [
                         {
                           "id": "0886ac00-6ab6-41a6-b0e1-8d3faf2e0de2",
                           "account_name": "currencycloud",
                           "account_holder_name": "The Currency Cloud",
                           "account_holder_dob": null,
                           "routing_code": "123456789",
                           "account_number": "01234567890",
                           "currency": "USD",
                           "account_id": "72970a7c-7921-431c-b95f-3438724ba16f"
                         }
                       ],
                       "pagination": {
                         "total_entries": 1,
                         "total_pages": 1,
                         "current_page": 1,
                         "per_page": 25,
                         "previous_page": -1,
                         "next_page": -1,
                         "order": "created_at",
                         "order_asc_desc": "asc"
                       }}';

        $entryPoint = new WithdrawalAccountsEntryPoint(new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'withdrawal_accounts/find',
                [
                    'account_id' => "72970a7c-7921-431c-b95f-3438724ba16f",
                    'page' => null,
                    'per_page' => null,
                    'order' => null,
                    'order_asc_desc' => null,
                ]
            )
        );

        $findWithdrawalAccountsCriteria = new FindWithdrawalAccountsCriteria();
        $findWithdrawalAccountsCriteria->setAccountId("72970a7c-7921-431c-b95f-3438724ba16f");
        $pagination = new Pagination();

        $accounts = $entryPoint->findWithdrawalAccounts($findWithdrawalAccountsCriteria, $pagination);

        $this->assertSame(1, count($accounts));

        $this->assertSame("0886ac00-6ab6-41a6-b0e1-8d3faf2e0de2", $accounts->getWithdrawalAccounts()[0]->getId());
        $this->assertSame("72970a7c-7921-431c-b95f-3438724ba16f", $accounts->getWithdrawalAccounts()[0]->getAccountId());
        $this->assertSame("currencycloud", $accounts->getWithdrawalAccounts()[0]->getAccountName());
        $this->assertSame("The Currency Cloud", $accounts->getWithdrawalAccounts()[0]->getAccountHolderName());
        $this->assertSame("123456789", $accounts->getWithdrawalAccounts()[0]->getRoutingCode());
        $this->assertSame("01234567890", $accounts->getWithdrawalAccounts()[0]->getAccountNumber());
        $this->assertSame("USD", $accounts->getWithdrawalAccounts()[0]->getCurrency());

        $this->assertSame(1, $accounts->getPagination()->getTotalEntries());
        $this->assertSame(1, $accounts->getPagination()->getTotalPages());
        $this->assertSame(1, $accounts->getPagination()->getCurrentPage());
        $this->assertSame(25, $accounts->getPagination()->getPerPage());
        $this->assertSame(-1, $accounts->getPagination()->getPreviousPage());
        $this->assertSame(-1, $accounts->getPagination()->getNextPage());
        $this->assertSame("created_at", $accounts->getPagination()->getOrder());
        $this->assertSame("asc", $accounts->getPagination()->getOrderAscDesc());
    }

    /**
     * @test
     */
    public function testCanFindWithdrawalAccount2()
    {
        $data = '{"withdrawal_accounts": [
                         {
                           "id": "0886ac00-6ab6-41a6-b0e1-8d3faf2e0de2",
                           "account_name": "currencycloud",
                           "account_holder_name": "The Currency Cloud",
                           "account_holder_dob": null,
                           "routing_code": "123456789",
                           "account_number": "01234567890",
                           "currency": "USD",
                           "account_id": "72970a7c-7921-431c-b95f-3438724ba16f"
                         },
                        {
                          "id": "0886ac00-6ab6-41a6-b0e1-8d3faf2e0de3",
                          "account_name": "currencycloud2",
                          "account_holder_name": "The Currency Cloud 2",
                          "account_holder_dob": "1990-07-20",
                          "routing_code": "223456789",
                          "account_number": "01234567892",
                          "currency": "GBP",
                          "account_id": "72970a7c-7921-431c-b95f-3438724ba16e"
                        }
                       ],
                       "pagination": {
                         "total_entries": 2,
                         "total_pages": 1,
                         "current_page": 1,
                         "per_page": 25,
                         "previous_page": -1,
                         "next_page": -1,
                         "order": "created_at",
                         "order_asc_desc": "asc"
                       }}';

        $entryPoint = new WithdrawalAccountsEntryPoint(new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'withdrawal_accounts/find',
                [
                    'account_id' => null,
                    'page' => null,
                    'per_page' => null,
                    'order' => null,
                    'order_asc_desc' => null,
                ]
            )
        );

        $findWithdrawalAccountsCriteria = new FindWithdrawalAccountsCriteria();
        $pagination = new Pagination();

        $accounts = $entryPoint->findWithdrawalAccounts($findWithdrawalAccountsCriteria, $pagination);

        $this->assertSame(2, count($accounts));

        $this->assertSame("0886ac00-6ab6-41a6-b0e1-8d3faf2e0de2", $accounts->getWithdrawalAccounts()[0]->getId());
        $this->assertSame("72970a7c-7921-431c-b95f-3438724ba16f", $accounts->getWithdrawalAccounts()[0]->getAccountId());
        $this->assertSame("currencycloud", $accounts->getWithdrawalAccounts()[0]->getAccountName());
        $this->assertSame("The Currency Cloud", $accounts->getWithdrawalAccounts()[0]->getAccountHolderName());
        $this->assertSame("123456789", $accounts->getWithdrawalAccounts()[0]->getRoutingCode());
        $this->assertSame("01234567890", $accounts->getWithdrawalAccounts()[0]->getAccountNumber());
        $this->assertSame("USD", $accounts->getWithdrawalAccounts()[0]->getCurrency());

        $this->assertSame("0886ac00-6ab6-41a6-b0e1-8d3faf2e0de3", $accounts->getWithdrawalAccounts()[1]->getId());
        $this->assertSame("72970a7c-7921-431c-b95f-3438724ba16e", $accounts->getWithdrawalAccounts()[1]->getAccountId());
        $this->assertSame("currencycloud2", $accounts->getWithdrawalAccounts()[1]->getAccountName());
        $this->assertSame("The Currency Cloud 2", $accounts->getWithdrawalAccounts()[1]->getAccountHolderName());
        $this->assertSame("223456789", $accounts->getWithdrawalAccounts()[1]->getRoutingCode());
        $this->assertSame("01234567892", $accounts->getWithdrawalAccounts()[1]->getAccountNumber());
        $this->assertSame("GBP", $accounts->getWithdrawalAccounts()[1]->getCurrency());
        $this->assertSame("1990-07-20", $accounts->getWithdrawalAccounts()[1]->getAccountHolderDob()->format("Y-m-d"));

        $this->assertSame(2, $accounts->getPagination()->getTotalEntries());
        $this->assertSame(1, $accounts->getPagination()->getTotalPages());
        $this->assertSame(1, $accounts->getPagination()->getCurrentPage());
        $this->assertSame(25, $accounts->getPagination()->getPerPage());
        $this->assertSame(-1, $accounts->getPagination()->getPreviousPage());
        $this->assertSame(-1, $accounts->getPagination()->getNextPage());
        $this->assertSame("created_at", $accounts->getPagination()->getOrder());
        $this->assertSame("asc", $accounts->getPagination()->getOrderAscDesc());
    }

    /**
     * @test
     */
    public function testCanPullFunds()
    {
        $data = '{
               "id": "e2e6b7aa-c9e8-4625-96a6-b97d4baab758",
                "withdrawal_account_id": "0886ac00-6ab6-41a6-b0e1-8d3faf2e0de2",
                "reference": "PullFunds1",
                "amount": "100.00",
                "created_at": "2020-06-29T08:02:31+00:00"
             }';

        $entryPoint = new WithdrawalAccountsEntryPoint(new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'POST',
                'withdrawal_accounts/0886ac00-6ab6-41a6-b0e1-8d3faf2e0de2/pull_funds',
                [],
                [
                    'reference' => "PullFunds1",
                    'amount' => "100.00",
                ]
            )
        );


        $funds = $entryPoint->pullFunds("0886ac00-6ab6-41a6-b0e1-8d3faf2e0de2", "PullFunds1","100.00");


        $this->assertSame("e2e6b7aa-c9e8-4625-96a6-b97d4baab758", $funds->getId());
        $this->assertSame("0886ac00-6ab6-41a6-b0e1-8d3faf2e0de2", $funds->getWithdrawalAccountId());
        $this->assertSame("PullFunds1", $funds->getReference());
        $this->assertSame("100.00", $funds->getAmount());
        $this->assertSame("2020-06-29T08:02:31+00:00", $funds->getCreatedAt()->format(DateTime::RFC3339));


    }



}