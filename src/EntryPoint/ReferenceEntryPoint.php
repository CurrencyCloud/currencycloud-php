<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\BeneficiaryRequiredDetail;
use CurrencyCloud\Model\ConversionDates;
use CurrencyCloud\Model\Currency;
use CurrencyCloud\Model\InvalidConversionDate;
use CurrencyCloud\Model\InvalidPaymentDate;
use CurrencyCloud\Model\PaymentDates;
use CurrencyCloud\Model\SettlementAccount;

class ReferenceEntryPoint extends AbstractEntryPoint
{

    //@todo move to factory methods things from here
    /**
     * @return Currency[]
     */
    public function availableCurrencies()
    {
        $response = $this->request('GET', 'reference/currencies');
        $ret = [];
        foreach ($response->currencies as $currency) {
            $ret[] = new Currency(
                $currency->code,
                $currency->decimal_places,
                $currency->name
            );
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
            $ret[] = new BeneficiaryRequiredDetail((array) $detail);
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
        $invalidDates = [];

        foreach ($response->invalid_conversion_dates as $date => $description) {
            $invalidDates[] = new InvalidConversionDate($date, $description);
        }

        return new ConversionDates(
            $invalidDates,
            $response->first_conversion_date,
            $response->default_conversion_date
        );
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
        $invalidDates = [];

        foreach ($response->invalid_payment_dates as $date => $description) {
            $invalidDates[] = new InvalidPaymentDate($date, $description);
        }

        return new PaymentDates(
            $invalidDates,
            $response->first_payment_date
        );;
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
            $ret[] = new SettlementAccount(
                $settlementAccount->bank_account_holder_name,
                (is_array($settlementAccount->beneficiary_address)) ?
                    $settlementAccount->beneficiary_address : [],
                $settlementAccount->beneficiary_country,
                $settlementAccount->bank_name,
                (is_array($settlementAccount->bank_address)) ?
                    $settlementAccount->bank_address : [],
                $settlementAccount->bank_country,
                $settlementAccount->currency,
                $settlementAccount->bic_swift,
                $settlementAccount->iban,
                $settlementAccount->account_number,
                $settlementAccount->routing_code_type_1,
                $settlementAccount->routing_code_value_1,
                $settlementAccount->routing_code_type_2,
                $settlementAccount->routing_code_value_2
            );
        }
        return $ret;
    }
}
