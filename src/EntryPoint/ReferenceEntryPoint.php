<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\BeneficiaryRequiredDetail;
use CurrencyCloud\Model\ConversionDates;
use CurrencyCloud\Model\Currency;
use CurrencyCloud\Model\PaymentDates;
use CurrencyCloud\Model\SettlementAccount;

class ReferenceEntryPoint extends AbstractEntryPoint
{

    /**
     * @return Currency[]
     */
    public function availableCurrencies()
    {
        return [];
    }

    /**
     * @param string $currency
     * @param string $bankAccountCountry
     * @param string $beneficiaryCountry
     * @return BeneficiaryRequiredDetail[]
     */
    public function beneficiaryRequiredDetails(
        $currency = 'GBP',
        $bankAccountCountry = 'GB',
        $beneficiaryCountry = 'GB'
    ) {
        return [];
    }

    /**
     * @param string $conversionPair
     * @return ConversionDates
     */
    public function conversionDates($conversionPair)
    {
        return null;
    }

    /**
     * @param string $currency
     * @param null|string $startDate
     * @return PaymentDates
     */
    public function paymentDates($currency, $startDate = null)
    {
        return null;
    }

    /**
     * @param string $currency
     * @return SettlementAccount[]
     */
    public function settlementAccounts($currency = 'GBP')
    {
        return null;
    }

}
