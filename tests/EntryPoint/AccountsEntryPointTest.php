<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\AccountsEntryPoint;
use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\AccountPaymentChargesSetting;
use CurrencyCloud\Model\AccountComplianceSetting;
use CurrencyCloud\Model\AccountCreateRequest;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

use DateTime;

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
        'short_reference' => '110104-00004',
        'terms_and_conditions_accepted' => null,
        'api_trading' => 'true',
        'online_trading' => 'true',
        'phone_trading' => 'true',
        'identification_expiration' => '2014-02-13',
        'identification_issuer' => 'US',
        'legal_entity_sub_type' => 'limited_liability_company'
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
        'on_behalf_of' => null,
        'terms_and_conditions_accepted' => null,
        'api_trading' => null,
        'online_trading' => null,
        'phone_trading' => null,
        'identification_expiration' => null,
        'identification_issuer' => null,
        'legal_entity_sub_type' => null
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
            'on_behalf_of' => null,
            'terms_and_conditions_accepted' => 'false',
            'api_trading' => 'true',
            'online_trading' => 'true',
            'phone_trading' => 'false',
            'identification_expiration' => '2014-02-15',
            'identification_issuer' => 'US',
            'legal_entity_sub_type' => 'limited_liability_company'
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
                ->setShortReference('N')
                ->setTermsAndConditionsAccepted(false)
                ->setApiTrading(true)
                ->setOnlineTrading(true)
                ->setPhoneTrading(false)
                ->setIdentificationExpiration(new DateTime("2014-02-15"))
                ->setIdentificationIssuer("US")
                ->setLegalEntitySubType("limited_liability_company");

        $account = $entryPoint->create($account);

        $this->validateObjectStrictName($account, $this->out);
    }


    /**
     * @test
     */
    public function canCreatewithAccountCreateRequest()
    {
        $in = [
            "legal_entity_type" => "A",
            "account_name" => "B",
            "legal_entity_sub_type" => "C",
            "your_reference" => "D",
            "status" => "E",
            "street" => "F",
            "city" => "G",
            "state_or_province" => "H",
            "postal_code" => "I",
            "country" => "J",
            "brand" => "K",
            "spread_table" => "L",
            "identification_type" => "M",
            "identification_value" => "N",
            "identification_expiration" => "2014-01-20",
            "identification_issuer" => "O",
            "terms_and_conditions_accepted" => "true",
            "api_trading" => "true",
            "online_trading" => "true",
            "phone_trading" => "true",
            "industry_type" => "P",
            "business_website_url" => "Q",
            "country_of_citizenship" => "R",
            "date_of_incorporation" => "2014-02-20",
            "trading_address_street" => "S",
            "trading_address_city" => "T",
            "trading_address_state" => "U",
            "trading_address_postalcode" => "V",
            "trading_address_country" => "W",
            "tax_identification" => "X",
            "national_identification" => "Y",
            "customer_risk" => "Z",
            "expected_monthly_activity_volume" => "10",
            "expected_monthly_activity_value" => "10",
            "expected_transaction_currencies" => ["GBP"],
            "expected_transaction_countries" => ["GB"],
            'on_behalf_of' => null,
        ];

        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode(json_encode($this->out)),
                'POST',
                'accounts/create',
                [],
                $in
            )
        );

        $req = AccountCreateRequest::create('B', 'A')
            ->setLegalEntitySubType('C')
            ->setYourReference('D')
            ->setStatus('E')
            ->setStreet('F')
            ->setCity('G')
            ->setStateOrProvince('H')
            ->setPostalCode('I')
            ->setCountry('J')
            ->setBrand('K')
            ->setSpreadTable('L')
            ->setIdentificationType('M')
            ->setIdentificationValue('N')
            ->setIdentificationExpiration(new DateTime("2014-01-20"))
            ->setIdentificationIssuer('O')
            ->setTermsAndConditionsAccepted(true)
            ->setApiTrading(true)
            ->setOnlineTrading(true)
            ->setPhoneTrading(true)
            ->setIndustryType("P")
            ->setBusinessWebsiteUrl("Q")
            ->setCountryOfCitizenship("R")
            ->setDateOfIncorporation(new DateTime("2014-02-20"))
            ->setTradingAddressStreet("S")
            ->setTradingAddressCity("T")
            ->setTradingAddressState("U")
            ->setTradingAddressPostalcode("V")
            ->setTradingAddressCountry("W")
            ->setTaxIdentification("X")
            ->setNationalIdentification("Y")
            ->setCustomerRisk("Z")
            ->setExpectedMonthlyActivityVolume("10")
            ->setExpectedMonthlyActivityValue("10")
            ->setExpectedTransactionCurrencies(["GBP"])
            ->setExpectedTransactionCountries(["GB"]);

        $account = $entryPoint->create($req);

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
        unset($in['terms_and_conditions_accepted']);
        unset($in['api_trading']);
        unset($in['online_trading']);
        unset($in['phone_trading']);
        unset($in['identification_expiration']);
        unset($in['identification_issuer']);
        unset($in['legal_entity_sub_type']);

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
            'POST',
            'accounts/find',
            [],
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

    /**
     * @test
     */
    public function canGetComplianceSettings()
    {
        $data = '{
          "account_id": "3e12053j-ae22-40b1-cc4e-cc0230c009a5",
          "industry_type": "some-type",
          "country_of_incorporation": "US",
          "date_of_incorporation": "2020-01-30",
          "business_website_url": "https://currencycloud.com",
          "expected_transaction_countries": ["US", "GB"],
          "expected_transaction_currencies": ["GBP"],
          "expected_monthly_activity_volume": 10,
          "expected_monthly_activity_value": "30.00",
          "tax_identification": "some-tax-id",
          "national_identification": "some-national-id",
          "country_of_citizenship": "US",
          "trading_address_street": "some-street",
          "trading_address_city": "some-city",
          "trading_address_state": "NY",
          "trading_address_postalcode": "90210",
          "trading_address_country": "US",
          "customer_risk": "LOW"
        }';

        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(),
            $this->getMockedClient(
                json_decode($data),
                'GET',
                'accounts/3e12053j-ae22-40b1-cc4e-cc0230c009a5/compliance_settings'
            )
        );

        $actual = $entryPoint->getComplianceSettings('3e12053j-ae22-40b1-cc4e-cc0230c009a5');

        $this->assertSame('3e12053j-ae22-40b1-cc4e-cc0230c009a5', $actual->getAccountId());
        $this->assertSame('some-type', $actual->getIndustryType());
        $this->assertSame('US', $actual->getCountryOfIncorporation());
        $this->assertSame((new DateTime("2020-01-30"))->getTimestamp(), $actual->getDateOfIncorporation()->getTimestamp());
        $this->assertSame("https://currencycloud.com", $actual->getBusinessWebsiteUrl());
        $this->assertSame(["US", "GB"], $actual->getExpectedTransactionCountries());
        $this->assertSame(["GBP"], $actual->getExpectedTransactionCurrencies());
        $this->assertSame("10", $actual->getExpectedMonthlyActivityVolume());
        $this->assertSame("30.00", $actual->getExpectedMonthlyActivityValue());
        $this->assertSame("some-tax-id", $actual->getTaxIdentification());
        $this->assertSame("some-national-id", $actual->getNationalIdentification());
        $this->assertSame("US", $actual->getCountryOfCitizenship());
        $this->assertSame("some-street", $actual->getTradingAddressStreet());
        $this->assertSame("some-city", $actual->getTradingAddressCity());
        $this->assertSame("NY", $actual->getTradingAddressState());
        $this->assertSame("90210", $actual->getTradingAddressPostalcode());
        $this->assertSame("US", $actual->getTradingAddressCountry());
        $this->assertSame("LOW", $actual->getCustomerRisk());
    }

    /**
     * @test
     */
    public function canUpdateComplianceSettings()
    {
        $out = '{
            "account_id": "3e12053j-ae22-40b1-cc4e-cc0230c009a5",
            "industry_type": "some-type",
            "country_of_incorporation": "US",
            "date_of_incorporation": "2020-01-30",
            "business_website_url": "https://currencycloud.com",
            "expected_transaction_countries": ["US", "GB"],
            "expected_transaction_currencies": ["GBP"],
            "expected_monthly_activity_volume": 10,
            "expected_monthly_activity_value": "30.00",
            "tax_identification": "some-tax-id",
            "national_identification": "some-national-id",
            "country_of_citizenship": "US",
            "trading_address_street": "some-street",
            "trading_address_city": "some-city",
            "trading_address_state": "NY",
            "trading_address_postalcode": "90210",
            "trading_address_country": "US",
            "customer_risk": "LOW"
        }';

        $in = [
            "industry_type" => "some-type",
            "country_of_incorporation" => "US",
            "date_of_incorporation" => "2020-01-30",
            "business_website_url" => "https://currencycloud.com",
            "expected_transaction_countries" => ["US", "GB"],
            "expected_transaction_currencies" => ["GBP"],
            "expected_monthly_activity_volume" => "10",
            "expected_monthly_activity_value" => "30.00",
            "tax_identification" => "some-tax-id",
            "national_identification" => "some-national-id",
            "country_of_citizenship" => "US",
            "trading_address_street" => "some-street",
            "trading_address_city" => "some-city",
            "trading_address_state" => "NY",
            "trading_address_postalcode" => "90210",
            "trading_address_country" => "US",
            "customer_risk" => "LOW"
        ];

        $decoded_out = json_decode($out);
        $array_out = (array) $decoded_out;

        $entryPoint = new AccountsEntryPoint(
            new SimpleEntityManager(),
            $this->getMockedClient(
                $decoded_out,
                'POST',
                'accounts/3e12053j-ae22-40b1-cc4e-cc0230c009a5/compliance_settings',
                [],
                $in
            )
        );

        $setting = (new AccountComplianceSetting())
            ->setAccountId("3e12053j-ae22-40b1-cc4e-cc0230c009a5")
            ->setIndustryType("some-type")
            ->setCountryOfIncorporation("US")
            ->setDateOfIncorporation(new DateTime("2020-01-30"))
            ->setBusinessWebsiteUrl("https://currencycloud.com")
            ->setExpectedTransactionCountries(["US", "GB"])
            ->setExpectedTransactionCurrencies(["GBP"])
            ->setExpectedMonthlyActivityVolume(10)
            ->setExpectedMonthlyActivityValue("30.00")
            ->setTaxIdentification("some-tax-id")
            ->setNationalIdentification("some-national-id")
            ->setCountryOfCitizenship("US")
            ->setTradingAddressStreet("some-street")
            ->setTradingAddressCity("some-city")
            ->setTradingAddressState("NY")
            ->setTradingAddressPostalcode("90210")
            ->setTradingAddressCountry("US")
            ->setCustomerRisk("LOW");

        $updated = $entryPoint->updateComplianceSettings($setting);

        $this->validateObjectStrictName($updated, $array_out);
    }

    /**
     * @test
     */
    public function termAndConditionsAcceptedTrue()
    {
        $this->testTermsAndConditionsAccepted(true);
    }
    /**
     * @test
     */
    public function termAndConditionsAcceptedFalse()
    {
        $this->testTermsAndConditionsAccepted(false);
    }
    /**
     * @test
     */
    public function termAndConditionsAcceptedNull()
    {
        $this->testTermsAndConditionsAccepted(null);
    }

    private function testTermsAndConditionsAccepted($isTermsAndConditionsAccepted) {
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
            'on_behalf_of' => null,
            'terms_and_conditions_accepted' => (null === $isTermsAndConditionsAccepted) ? null :
            ($isTermsAndConditionsAccepted ? 'true' : 'false'),
            'api_trading' => 'true',
            'online_trading' => 'true',
            'phone_trading' => 'true',
            'identification_expiration' => null,
            'identification_issuer' => null,
            'legal_entity_sub_type' => null
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
                ->setShortReference('N')
                ->setTermsAndConditionsAccepted($isTermsAndConditionsAccepted)
                ->setApiTrading(true)
                ->setOnlineTrading(true)
                ->setPhoneTrading(true);

        $account = $entryPoint->create($account);

        $this->validateObjectStrictName($account, $this->out);
    }

}
