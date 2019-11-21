<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\BankDetails;
use CurrencyCloud\Model\BeneficiaryRequiredDetail;
use CurrencyCloud\Model\ConversionDates;
use CurrencyCloud\Model\Currency;
use CurrencyCloud\Model\InvalidConversionDate;
use CurrencyCloud\Model\InvalidPaymentDate;
use CurrencyCloud\Model\PayerDetails;
use CurrencyCloud\Model\PayerRequirementDetails;
use CurrencyCloud\Model\PaymentDates;
use CurrencyCloud\Model\PaymentFeeRule;
use CurrencyCloud\Model\PurposeCode;
use CurrencyCloud\Model\RequiredFieldEntry;
use CurrencyCloud\Model\SettlementAccount;
use DateTime;

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
                $currency->code, $currency->decimal_places, $currency->name, $currency->online_trading, $currency->can_buy, $currency->can_sell
            );
        }
        return $ret;
    }

    /**
     * @param string|null $currency
     * @param string|null $bankAccountCountry
     * @param string|null $beneficiaryCountry
     *
     * @return BeneficiaryRequiredDetail[]
     */
    public function beneficiaryRequiredDetails(
        $currency = null,
        $bankAccountCountry = null,
        $beneficiaryCountry = null
    ) {
        $response = $this->request(
            'GET',
            'reference/beneficiary_required_details',
            [
                'currency' => $currency,
                'bank_account_country' => $bankAccountCountry,
                'beneficiary_country' => $beneficiaryCountry
            ]
        );
        $ret = [];
        foreach ($response->details as $detail) {
            $ret[] = new BeneficiaryRequiredDetail((array) $detail);
        }
        return $ret;
    }

    /**
     * @param string $conversionPair
     * @param DateTime|null $startDate
     *
     * @return ConversionDates
     */
    public function conversionDates($conversionPair, DateTime $startDate = null)
    {
        $response = $this->request(
            'GET',
            'reference/conversion_dates',
            [
                'conversion_pair' => $conversionPair,
                'start_date' => (null === $startDate) ? null  : $startDate->format(DateTime::ISO8601)
            ]
        );
        $invalidDates = [];

        foreach ($response->invalid_conversion_dates as $date => $description) {
            $invalidDates[] = new InvalidConversionDate(new DateTime($date), $description);
        }

        return new ConversionDates(
            $invalidDates,
            new DateTime($response->first_conversion_date),
            new DateTime($response->default_conversion_date)
        );
    }

    /**
     * @param string $currency
     * @param DateTime|null $startDate
     *
     * @return PaymentDates
     */
    public function paymentDates($currency, DateTime $startDate = null)
    {
        $response = $this->request(
            'GET',
            'reference/payment_dates',
            [
                'currency' => $currency,
                'start_date' => (null === $startDate) ? null  : $startDate->format(DateTime::ISO8601)
            ]
        );
        $invalidDates = [];

        foreach ($response->invalid_payment_dates as $date => $description) {
            $invalidDates[] = new InvalidPaymentDate(new DateTime($date), $description);
        }

        return new PaymentDates(
            $invalidDates, new DateTime($response->first_payment_date)
        );;
    }

    /**
     * @param string|null $currency
     *
     * @return SettlementAccount[]
     */
    public function settlementAccounts($currency = null)
    {
        $response = $this->request(
            'GET',
            'reference/settlement_accounts',
            [
                'currency' => $currency
            ]
        );
        $ret = [];
        foreach ($response->settlement_accounts as $settlementAccount) {
            $ret[] = new SettlementAccount(
                $settlementAccount->bank_account_holder_name,
                $settlementAccount->beneficiary_address,
                $settlementAccount->beneficiary_country,
                $settlementAccount->bank_name,
                (is_array($settlementAccount->bank_address)) ? $settlementAccount->bank_address : [],
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

    public function paymentPurposeCodes($currency, $entity_type = null, $bank_account_country = null) {
        $response = $this->request(
            'GET',
            'reference/payment_purpose_codes',
            [
                'currency' => $currency,
                'entity_type' => $entity_type,
                'currency' => $bank_account_country
            ]
        );

        $ret = [];
        foreach ($response->purpose_codes as $purpose_code) {
            $ret[] = new PurposeCode(
                $purpose_code->currency,
                $purpose_code->entity_type,
                $purpose_code->purpose_code,
                $purpose_code->purpose_description
            );
        }
        return $ret;
    }

    /**
     * @param $payerCountry
     * @param $payerEntityType
     * @param $paymentType
     */
    public function payerRequiredDetails($payerCountry, $payerEntityType = null, $paymentType = null){
        $response = $this->request('GET',
            'reference/payer_required_details',
            [
                'payer_country' => $payerCountry,
                'payer_entity_type' => $payerEntityType,
                'payment_type' => $paymentType
            ],
            [],
            []
        );

        return $this->convertResponseToPaymentRequiredDetails($response);
    }

    /**
     * @param string $identifierType
     * @param string $identifierValue
     *
     * @return BankDetails
     */
    public function bankDetails(
        $identifierType,
        $identifierValue
    ) {
        $response = $this->request(
            'GET',
            'reference/bank_details',
            [
                'identifier_type' => $identifierType,
                'identifier_value' => $identifierValue
            ]
        );

        return new BankDetails($response->identifier_value, $response->identifier_type, $response->account_number,
            $response->bic_swift, $response->bank_name, $response->bank_branch,$response->bank_address,
            $response->bank_city, $response->bank_state, $response->bank_post_code, $response->bank_country,
            $response->bank_country_ISO, $response->currency);
    }

    /**
     * @param string $accountId
     * @param string $paymentType
     * @param string $chargeType
     *
     * @return PaymentFeeRule[]
     */
    public function paymentFeeRules(
        $accountId = null,
        $paymentType = null,
        $chargeType = null
    ) {
        $response = $this->request(
            'GET',
            'reference/payment_fee_rules',
            [
                'account_id' => $accountId,
                'payment_type' => $paymentType,
                'charge_type' => $chargeType
            ]
        );

        $ret = [];
        foreach ($response->payment_fee_rules as $payment_fee_rule) {
            $ret[] = new PaymentFeeRule(
                $payment_fee_rule->payment_type,
                $payment_fee_rule->charge_type,
                $payment_fee_rule->fee_amount,
                $payment_fee_rule->fee_currency
            );
        }
        return $ret;
    }

    /**
     * @param $response
     * @return PayerRequirementDetails
     */
    protected function convertResponseToPaymentRequiredDetails($response){
        $payerDetails = [];
        foreach($response->details as $key => $value){
            array_push($payerDetails,
                new PayerDetails(
                    $value->payer_entity_type,
                    $value->payment_type,
                     !empty($value->payer_identification_type) ? $value->payer_identification_type : null,
                    $this->convertRequiredFieldsArrayToRequiredFieldEntry($value->required_fields)
                ));
        }

        return new PayerRequirementDetails($payerDetails);
    }

    /**
     * @param $requiredFields
     * @return RequiredFieldEntry[]
     */
    protected function convertRequiredFieldsArrayToRequiredFieldEntry($requiredFields){
        $result = [];
        foreach($requiredFields as $key => $value){
            array_push($result, new RequiredFieldEntry($value->name, $value->validation_rule));
        }
        return $result;
    }
}
