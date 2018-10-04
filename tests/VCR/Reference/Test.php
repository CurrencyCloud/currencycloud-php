<?php

namespace CurrencyCloud\Tests\VCR\Reference;

use CurrencyCloud\Model\BeneficiaryRequiredDetail;
use CurrencyCloud\Model\ConversionDates;
use CurrencyCloud\Model\Currency;
use CurrencyCloud\Model\SettlementAccount;


use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase
{
    /**
     * @vcr Reference/can_retrieve_beneficiary_required_details.yaml
     * @test
     */
    public function canRetrieveBeneficiaryRequiredDetails()
    {
        $requiredDetails = $this->getAuthenticatedClient()->reference()->beneficiaryRequiredDetails('GBP', 'GB', 'GB');
        $this->assertTrue($requiredDetails[0] instanceof BeneficiaryRequiredDetail);

    }

    /**
     * @vcr Reference/can_retrieve_conversion_dates.yaml
     * @test
     */
    public function canRetrieveConversionDates()
    {
        $conversionDates = $this->getAuthenticatedClient()->reference()->conversionDates('GBPUSD');
        $this->assertTrue($conversionDates instanceof ConversionDates);
    }

    /**
     * @vcr Reference/can_retrieve_currencies.yaml
     * @test
     */
    public function canRetrieveCurrencies()
    {
        $currencies = $this->getAuthenticatedClient()->reference()->availableCurrencies();
        $this->assertTrue($currencies[0] instanceof Currency);
    }

    /**
     * @vcr Reference/can_retrieve_settlement_accounts.yaml
     * @test
     */
    public function canRetrieveSettlementAccounts()
    {
        $settlementAccounts = $this->getAuthenticatedClient()->reference()->settlementAccounts('GBP');
        $this->assertTrue($settlementAccounts[0] instanceof SettlementAccount);
    }
}
