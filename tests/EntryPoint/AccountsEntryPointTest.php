<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\AccountsEntryPoint;
use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\AccountPaymentChargesSetting;
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

    /**
     * @test
     */
    public function canGetPaymentChargesSettings()
    {

        $data = '{
        "payment_charges_settings": [
        {
            "charge_settings_id": "090baf7e-5chh-4bfd-9b7l-ad3f8a310123",
            "account_id": "3e12053j-ae22-40b1-cc4e-cc0230c009a5",
            "charge_type": "ours",
            "enabled": false,
            "default": false
        },
        {
            "charge_settings_id": "12345678-24b5-4af3-b88f-3aa27de4c6ba",
            "account_id": "3e12053j-ae22-40b1-cc4e-cc0230c009a5",
            "charge_type": "shared",
            "enabled": true,
            "default": true
        }
        ]
        }';

        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
                json_decode($data),
                'GET',
                'accounts/3e12053j-ae22-40b1-cc4e-cc0230c009a5/payment_charges_settings'
            )
        );

        $settings = $entryPoint->getPaymentChargesSettings('3e12053j-ae22-40b1-cc4e-cc0230c009a5');

        $this->assertSame(2, sizeof($settings));

        $setting1 = $settings[0];
        $this->assertSame('090baf7e-5chh-4bfd-9b7l-ad3f8a310123', $setting1->getChargeSettingsId());
        $this->assertSame('3e12053j-ae22-40b1-cc4e-cc0230c009a5', $setting1->getAccountId());
        $this->assertSame('ours', $setting1->getChargeType());
        $this->assertFalse($setting1->isEnabled());
        $this->assertFalse($setting1->isDefault());

        $setting2 = $settings[1];
        $this->assertSame('12345678-24b5-4af3-b88f-3aa27de4c6ba', $setting2->getChargeSettingsId());
        $this->assertSame('3e12053j-ae22-40b1-cc4e-cc0230c009a5', $setting2->getAccountId());
        $this->assertSame('shared', $setting2->getChargeType());
        $this->assertTrue($setting2->isEnabled());
        $this->assertTrue($setting2->isDefault());




    }

    /**
     * @test
     */
    public function canUpdatePaymentChargesSettings()
    {

        $data = '{        
            "charge_settings_id": "090baf7e-5chh-4bfd-9b7l-ad3f8a310123",
            "account_id": "3e12053j-ae22-40b1-cc4e-cc0230c009a5",
            "charge_type": "ours",
            "enabled": true,
            "default": false
        }';

        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'accounts/3e12053j-ae22-40b1-cc4e-cc0230c009a5/payment_charges_settings/090baf7e-5chh-4bfd-9b7l-ad3f8a310123',
            [],
            [ 'enabled' => 'true', 'default' => 'false']
        )
        );


        $setting = new AccountPaymentChargesSetting("090baf7e-5chh-4bfd-9b7l-ad3f8a310123",
            "3e12053j-ae22-40b1-cc4e-cc0230c009a5", "ours", true, false);

        $updated = $entryPoint->updatePaymentChargesSettings($setting);
        $this->assertSame('090baf7e-5chh-4bfd-9b7l-ad3f8a310123', $updated->getChargeSettingsId());
        $this->assertSame('3e12053j-ae22-40b1-cc4e-cc0230c009a5', $updated->getAccountId());
        $this->assertSame('ours', $updated->getChargeType());
        $this->assertTrue($updated->isEnabled());
        $this->assertFalse($updated->isDefault());
    }
}
