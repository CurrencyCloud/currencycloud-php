<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\AccountsEntryPoint;
use CurrencyCloud\EntryPoint\BalancesEntryPoint;
use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class BalancesEntryPointTest extends BaseCurrencyCloudTestCase
{

    protected $out = [
        'balances' => [
            [
                'id' => '18230F1D-648A-406A-AD1F-A09CBC02E9E9',
                'account_id' => 'BA52CF0A-3D43-4B66-8E4A-461CBE3CD500',
                'currency' => 'USD',
                'amount' => '1000.00',
                'created_at' => '2014-01-12T12:24:19+00:00',
                'updated_at' => '2014-01-12T12:24:19+00:00',
            ]
        ],
        'pagination' => [
            'total_entries' => 1,
            'total_pages' => 1,
            'current_page' => 1,
            'previous_page' => -1,
            'next_page' => -1,
            'per_page' => 25,
            'order' => 'id',
            'order_asc_desc' => 'asc'
        ]
    ];

    /**
     * @test
     */
    public function canFind()
    {
        $entryPoint = new BalancesEntryPoint($this->getMockedClient(
            json_decode(json_encode($this->out)),
            'GET',
            'balances/find',
            [
                'on_behalf_of' => null,
                'amount_from' => null,
                'amount_to' => null,
                'as_at_date' => null
            ] + $this->getDummyPaginationRequest()
        ));

        $ret = $entryPoint->find();

        $this->validateObjectStrictName($ret->getBalances()[0], $this->out['balances'][0]);
    }

    /**
     * @test
     */
    public function canFindWithNonNull()
    {
        $date = new DateTime();
        $entryPoint = new BalancesEntryPoint($this->getMockedClient(
            json_decode(json_encode($this->out)),
            'GET',
            'balances/find',
            [
                'on_behalf_of' => 't',
                'amount_from' => '22',
                'amount_to' => '33',
                'as_at_date' => $date->format(DateTime::RFC3339)
            ] + $this->getDummyPaginationRequest()
        ));

        $ret = $entryPoint->find('22', '33', $date, null, 't');

        $this->validateObjectStrictName($ret->getBalances()[0], $this->out['balances'][0]);
    }
}
