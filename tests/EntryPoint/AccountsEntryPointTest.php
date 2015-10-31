<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\AccountsEntryPoint;
use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class AccountsEntryPointTest extends BaseCurrencyCloudTestCase
{

    protected $out = [
        'id' => 'B7DE235A-FF5D-4252-83C2-06A605267FEA',
        'legal_entity_type' => 'company',
        'account_name' => 'Company PLC',
        'brand' => 'currency_cloud',
        'your_reference' => '0012345564ABC',
        'status' => 'enabled',
        'street' => '1 London Road',
        'city' => 'London',
        'state_or_province' => '',
        'country' => 'GB',
        'postal_code' => 'AB12 CD1',
        'spread_table' => 'flat_0.5_percent',
        'created_at' => '2014-01-12T00:00:00+00:00',
        'updated_at' => '2014-01-12T00:00:00+00:00',
        'identification_type' => 'green_card',
        'identification_value' => '123',
        'short_reference' => '110104-00004'
    ];

    protected $in = [
        'legal_entity_type' => 'A',
        'account_name' => 'B',
        'brand' => null,
        'your_reference' => null,
        'status' => null,
        'street' => null,
        'city' => null,
        'state_or_province' => null,
        'country' => null,
        'postal_code' => null,
        'spread_table' => null,
        'identification_type' => null,
        'identification_value' => null,
        'on_behalf_of' => null
    ];

    /**
     * @test
     */
    public function nullableFieldsCanBeNull()
    {

        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode(json_encode($this->out)),
            'POST',
            'accounts/create',
            [],
            $this->in
        )
        );

        $account = Account::create('B', 'A');

        $entryPoint->create($account);
    }

    /**
     * @test
     */
    public function allFieldsCanBeSet()
    {
        $in = [
            'legal_entity_type' => 'A',
            'account_name' => 'B',
            'brand' => 'C',
            'your_reference' => 'D',
            'status' => 'E',
            'street' => 'F',
            'city' => 'G',
            'state_or_province' => 'H',
            'country' => 'I',
            'postal_code' => 'J',
            'spread_table' => 'K',
            'identification_type' => 'L',
            'identification_value' => 'M',
            'on_behalf_of' => null
        ];

        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode(json_encode($this->out)),
            'POST',
            'accounts/create',
            [],
            $in
        )
        );

        $account =
            Account::create('B', 'A')
                ->setBrand('C')
                ->setYourReference('D')
                ->setStatus('E')
                ->setStreet('F')
                ->setCity('G')
                ->setStateOrProvince('H')
                ->setCountry('I')
                ->setPostalCode('J')
                ->setSpreadTable('K')
                ->setIdentificationType('L')
                ->setIdentificationValue('M')
                ->setShortReference('N');

        $account = $entryPoint->create($account);

        $this->validateObjectStrictName($account, $this->out);
    }

    /**
     * @test
     */
    public function accountCanBeRetrievedWithOnBehalfOf()
    {

        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode(json_encode($this->out)),
            'GET',
            'accounts/1',
            ['on_behalf_of' => '2']
        )
        );

        $account = $entryPoint->retrieve('1', '2');

        $this->validateObjectStrictName($account, $this->out);
    }

    /**
     * @test
     */
    public function accountsCanBeFound()
    {
        $in = array_merge(
            $this->in,
            [
                'legal_entity_type' => null,
                'account_name' => null,
                'country' => '1',
                'page' => 2,
                'per_page' => 3,
                'order' => '4',
                'order_asc_desc' => '5'
            ]
        );
        unset($in['spread_table']);
        unset($in['identification_type']);
        unset($in['identification_value']);
        unset($in['on_behalf_of']);
        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode(
                json_encode(
                    [
                        'accounts' => [$this->out],
                        'pagination' => $this->getDummyPagination()
                    ]
                )
            ),
            'GET',
            'accounts/find',
            $in
        )
        );

        $entryPoint->find(
            (new Account())->setCountry('1'),
            (new Pagination())->setCurrentPage('2')
                ->setPerPage('3')
                ->setOrder('4')
                ->setOrderAscDesc('5')
        );
    }

    /**
     * @test
     */
    public function canCurrent()
    {
        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode(json_encode($this->out)),
            'GET',
            'accounts/current',
            ['on_behalf_of' => null]
        )
        );

        $account = $entryPoint->current();

        $this->validateObjectStrictName($account, $this->out);
    }

    /**
     * @test
     */
    public function canUpdate()
    {
        $account = new Account();
        $this->setIdProperty($account, 'abc');
        $changeSet = (new Account())->setCountry('test');

        $in = [
                  'country' => 'test',
                  'account_name' => null,
                  'legal_entity_type' => null
              ] + $this->in;
        unset($in['on_behalf_of']);

        $entryPoint = new AccountsEntryPoint(
            $this->getMockedEntityManager($account, $changeSet), $this->getMockedClient(
            json_decode(json_encode($this->out)),
            'POST',
            'accounts/abc',
            [],
            $in
        )
        );

        $account = $entryPoint->update($account);

        $this->validateObjectStrictName($account, $this->out);
    }
}
