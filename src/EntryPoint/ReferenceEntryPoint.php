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
        $response = $this->request('GET', 'reference/currencies');
        $ret = [];
        foreach ($response->currencies as $currency) {
            $ret[] = Currency::createFromResponse($currency);
        }
        return $ret;
    }

    /**
     * @param string|null $currency
     * @param string|null $bankAccountCountry
     * @param string|null $beneficiaryCountry
     * @return BeneficiaryRequiredDetail[]
     */
    public function beneficiaryRequiredDetails(
        $currency = null,
        $bankAccountCountry = null,
        $beneficiaryCountry = null
    ) {
        $response = $this->request('GET', 'reference/beneficiary_required_details', [
            'currency' => $currency,
            'bank_account_country' => $bankAccountCountry,
            'beneficiary_country' => $beneficiaryCountry
        ]);
        $ret = [];
        foreach ($response->details as $detail) {
            $ret[] = BeneficiaryRequiredDetail::createFromResponse($detail);
        }
        return $ret;
    }

    /**
     * @param string $conversionPair
     * @param string|null $startDate
     * @return ConversionDates
     */
    public function conversionDates($conversionPair, $startDate = null)
    {
        $response = $this->request('GET', 'reference/conversion_dates', [
            'conversion_pair' => $conversionPair,
            'start_date' => $startDate
        ]);
        return ConversionDates::createFromResponse($response);
    }

    /**
     * @param string $currency
     * @param string|null $startDate
     * @return PaymentDates
     */
    public function paymentDates($currency, $startDate = null)
    {
        $response = $this->request('GET', 'reference/payment_dates', [
            'currency' => $currency,
            'start_date' => $startDate
        ]);
        return PaymentDates::createFromResponse($response);
    }

    /**
     * @param string|null $currency
     * @return SettlementAccount[]
     */
    public function settlementAccounts($currency = null)
    {
        $response = $this->request('GET', 'reference/settlement_accounts', [
            'currency' => $currency
        ]);
        $ret = [];
        foreach ($response->settlement_accounts as $settlementAccount) {
            $ret[] = SettlementAccount::createFromResponse($settlementAccount);
        }
        return $ret;
    }
}
