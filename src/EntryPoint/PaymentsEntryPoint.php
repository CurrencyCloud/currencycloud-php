<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\FindPaymentsCriteria;
use CurrencyCloud\Model\Authorisation;
use CurrencyCloud\Model\Authorisations;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\Payer;
use CurrencyCloud\Model\Payment;
use CurrencyCloud\Model\PaymentConfirmation;
use CurrencyCloud\Model\PaymentDeliveryDate;
use CurrencyCloud\Model\Payments;
use CurrencyCloud\Model\PaymentSubmission;
use CurrencyCloud\Model\PaymentSubmissionInfo;
use CurrencyCloud\Model\PurposeCode;
use CurrencyCloud\Model\QuotePaymentFee;
use CurrencyCloud\Model\PaymentTrackingInfo;
use DateTime;
use stdClass;

class PaymentsEntryPoint extends AbstractEntityEntryPoint
{

    /**
     * @param Payment $payment
     * @param Payer|null $payer
     * @param null|string $onBehalfOf
     *
     * @return Payment
     * @throws \Exception
     */
    public function create(Payment $payment, Payer $payer = null, $onBehalfOf = null)
    {
        if (null === $payer) {
            $payer = new Payer();
        }

        return $this->doCreate('payments/create', $payment, function ($payment) use ($payer) {
            return $this->convertPaymentToRequest($payment) + $this->convertPayerToRequest($payer);
        }, function (stdClass $response) {
            return $this->createPaymentFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param Payment $payment
     * @param bool $convertForFind
     *
     * @return array
     */
    protected function convertPaymentToRequest(Payment $payment, $convertForFind = false)
    {
        $common = [
            'currency' => $payment->getCurrency(),
            'amount' => $payment->getAmount(),
            'reason' => $payment->getReason(),
            'beneficiary_id' => $payment->getBeneficiaryId(),
            'conversion_id' => $payment->getConversionId(),
            'unique_request_id' => $payment->getUniqueRequestId(),
            'charge_type' => $payment->getChargeType(),
            'fee_currency' => $payment->getFeeCurrency(),
            'fee_amount' => $payment->getFeeAmount(),
            'invoice_number' => $payment->getInvoiceNumber(),
            'invoice_date' => $payment->getInvoiceDate(),
        ];
        if ($convertForFind) {
            return $common + [
                'short_reference' => $payment->getShortReference(),
                'status' => $payment->getStatus()
            ];
        }
        $paymentDate = $payment->getPaymentDate();
        return $common + [
            'reference' => $payment->getReference(),
            'payment_date' => (null === $paymentDate) ? $paymentDate : $paymentDate->format('Y-m-d'),
            'payment_type' => $payment->getPaymentType(),
            'purpose_code' => $payment->getPurposeCode()
            ];
    }

    /**
     * @param Payer $payer
     *
     * @return array
     */
    protected function convertPayerToRequest(Payer $payer)
    {
        $payerDateOfBirth = $payer->getDateOfBirth();
        return [
            'payer_entity_type' => $payer->getLegalEntityType(),
            'payer_company_name' => $payer->getCompanyName(),
            'payer_first_name' => $payer->getFirstName(),
            'payer_last_name' => $payer->getLastName(),
            'payer_city' => $payer->getCity(),
            'payer_address' => (null === $payer->getAddress()) ? null : implode(' ', $payer->getAddress()),
            'payer_postcode' => $payer->getPostcode(),
            'payer_state_or_province' => $payer->getStateOrProvince(),
            'payer_country' => $payer->getCountry(),
            'payer_date_of_birth' => (null === $payerDateOfBirth) ? $payerDateOfBirth : $payerDateOfBirth->format(
                'Y-m-d'
            ),
            'payer_identification_type' => $payer->getIdentificationType(),
            'payer_identification_value' => $payer->getIdentificationValue()
        ];
    }

    /**
     * @param stdClass $response
     *
     * @return Payment
     */
    private function createPaymentFromResponse(stdClass $response)
    {
        $payment = new Payment();
        $payment->setShortReference($response->short_reference)
            ->setBeneficiaryId($response->beneficiary_id)
            ->setConversionId($response->conversion_id)
            ->setAmount($response->amount)
            ->setCurrency($response->currency)
            ->setStatus($response->status)
            ->setPaymentType($response->payment_type)
            ->setReference($response->reference)
            ->setReason($response->reason)
            ->setPaymentDate(new DateTime($response->payment_date))
            ->setTransferredAt(new DateTime($response->transferred_at))
            ->setAuthorisationStepsRequired($response->authorisation_steps_required)
            ->setCreatorContactId($response->creator_contact_id)
            ->setLastUpdaterContactId($response->last_updater_contact_id)
            ->setFailureReason($response->failure_reason)
            ->setPayerId($response->payer_id)
            ->setPayerDetailsSource($response->payer_details_source)
            ->setCreatedAt(new DateTime($response->created_at))
            ->setUpdatedAt(new DateTime($response->updated_at))
            ->setUniqueRequestId($response->unique_request_id)
            ->setFailureReturnedAmount($response->failure_returned_amount)
            ->setPurposeCode($response->purpose_code)
            ->setChargeType($response->charge_type)
            ->setFeeAmount($response->fee_amount)
            ->setFeeCurrency($response->fee_currency)
            ->setInvoiceNumber($response->invoice_number)
            ->setInvoiceDate($response->invoice_date);

        $this->setIdProperty($payment, $response->id);
        return $payment;
    }

    /**
     * @param Payment $payment
     * @param null $onBehalfOf
     *
     * @return Payment
     */
    public function delete(Payment $payment, $onBehalfOf = null)
    {
        return $this->doDelete(sprintf('payments/%s/delete', $payment->getId()), $payment, function (stdClass $response) {
            return $this->createPaymentFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     * @param null|string $withDeleted
     * @param null|string $purposeCode
     *
     * @return Payment
     */
    public function retrieve($id, $onBehalfOf = null, $withDeleted = null, $purposeCode = null)
    {
        $response = $this->request(
            'GET',
            sprintf('payments/%s', $id),
            [
                'on_behalf_of' => $onBehalfOf,
                'with_deleted' => $withDeleted,
                'purpose_code' => $purposeCode
            ]);

        return $this->createPaymentFromResponse($response);
    }

    /**
     * @param Payment $payment
     * @param Payer|null $payer
     * @param null|string $onBehalfOf
     *
     * @return Payment
     */
    public function update(Payment $payment, Payer $payer = null, $onBehalfOf = null)
    {
        if (null === $payer) {
            $payer = new Payer();
        }
        return $this->doUpdate(sprintf('payments/%s', $payment->getId()), $payment, function ($payment, $onBehalfOf) use ($payer) {
            return $this->convertPaymentToRequest($payment) + $this->convertPayerToRequest($payer) + [
                'on_behalf_of' => $onBehalfOf
            ];
        }, function (stdClass $response) {
            return $this->createPaymentFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param Payment|null $payment
     * @param FindPaymentsCriteria $criteria
     * @param Pagination|null $pagination
     * @param null|string $onBehalfOf
     *
     * @return Payments
     */
    public function find(
        Payment $payment = null,
        FindPaymentsCriteria $criteria = null,
        Pagination $pagination = null,
        $onBehalfOf = null
    ) {
        if (null === $payment) {
            $payment = new Payment();
        }
        if (null === $criteria) {
            $criteria = new FindPaymentsCriteria();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        return $this->doFind('payments/find', $payment, $pagination, function ($payment, $onBehalfOf) use ($criteria) {
            return $this->convertPaymentToRequest($payment, true)
            + $this->convertFindPaymentsCriteriaToRequest($criteria) + [
                'on_behalf_of' => $onBehalfOf
            ];
        }, function (stdClass $response) {
            return $this->createPaymentFromResponse($response);
        }, function ($items, $pagination) {
            return new Payments($items, $pagination);
        }, 'payments', $onBehalfOf);
    }

    /**
     * @param FindPaymentsCriteria $criteria
     *
     * @return array
     */
    private function convertFindPaymentsCriteriaToRequest(FindPaymentsCriteria $criteria = null)
    {
        $createdAtFrom = $criteria->getCreatedAtFrom();
        $createdAtTo = $criteria->getCreatedAtTo();
        $updatedAtFrom = $criteria->getUpdatedAtFrom();
        $updatedAtTo = $criteria->getUpdatedAtTo();
        $paymentDateFrom = $criteria->getPaymentDateFrom();
        $paymentDateTo = $criteria->getPaymentDateTo();
        $transferredAtFrom = $criteria->getTransferredAtFrom();
        $transferredAtTo = $criteria->getTransferredAtTo();
        return [
            'created_at_from' => (null === $createdAtFrom) ? null : $createdAtFrom->format(DateTime::RFC3339),
            'created_at_to' => (null === $createdAtTo) ? null : $createdAtTo->format(DateTime::RFC3339),
            'updated_at_from' => (null === $updatedAtFrom) ? null : $updatedAtFrom->format(DateTime::RFC3339),
            'updated_at_to' => (null === $updatedAtTo) ? null : $updatedAtTo->format(DateTime::RFC3339),
            'payment_date_from' => (null === $paymentDateFrom) ? null : $paymentDateFrom->format(DateTime::RFC3339),
            'payment_date_to' => (null === $paymentDateTo) ? null : $paymentDateTo->format(DateTime::RFC3339),
            'transferred_at_from' => (null === $transferredAtFrom) ? null : $transferredAtFrom->format(DateTime::RFC3339),
            'transferred_at_to' => (null === $transferredAtTo) ? null : $transferredAtTo->format(DateTime::RFC3339),
            'amount_from' => $criteria->getAmountFrom(),
            'amount_to' => $criteria->getAmountTo()
        ];
    }

    /**
     * @param string[] $paymentIds
     * @return Authorisations
     */
    public function authorise($paymentIds){
        $response = $this->request(
            'POST',
            'payments/authorise',
            [],
            [
                'payment_ids' => $paymentIds
            ]
        );

        return $this->createAuthorisationsFromResponse($response);
    }

    /**
     * @param stdClass $object
     * @return Authorisation
     */
    protected function createAuthorisationFromObject($object){
        return new Authorisation(
            $object->payment_id,
            $object->payment_status,
            $object->updated,
            $object->error,
            $object->auth_steps_taken,
            $object->auth_steps_required,
            $object->short_reference
        );
    }

    /**
     * @param stdClass $response
     * @return Authorisations
     */
    protected function createAuthorisationsFromResponse($response){
        $authorisations = [];
        foreach($response->authorisations as $key => $value){
            array_push($authorisations, $this->createAuthorisationFromObject($value));
        }

        return new Authorisations($authorisations);
    }

    /**
     * @param string $id
     * @param string|null $onBehalfOf
     * @return PaymentSubmission
     */
    public function retrieveSubmission($id, $onBehalfOf = null){
        $response = $this->request('GET', sprintf('payments/%s/submission', $id), ['on_behalf_of' => $onBehalfOf]);

        return $this->createPaymentSubmissionFromResponse($response);
    }

    /**
     * @param stdClass $response
     * @return PaymentSubmission
     */
    protected function createPaymentSubmissionFromResponse($response){
        $paymentSubmission = new PaymentSubmission(
            $response->status,
            $response->mt103,
            $response->submission_ref
        );

        return $paymentSubmission;
    }

    /**
     * @param string $id
     * @param string|null $onBehalfOf
     * @return PaymentSubmissionInfo
     */
    public function retrieveSubmissionInfo($id, $onBehalfOf = null){
        $response = $this->request('GET', sprintf('payments/%s/submission_info', $id), ['on_behalf_of' => $onBehalfOf]);

        return $this->createSubmissionInfoFromResponse($response);
    }

    /**
     * @param stdClass $response
     * @return PaymentSubmissionInfo
     */
    protected function createSubmissionInfoFromResponse($response){
        $paymentSubmission = new PaymentSubmissionInfo(
            $response->status,
            $response->message,
            $response->format,
            $response->submission_ref
        );

        return $paymentSubmission;
    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     *
     * @return PaymentConfirmation
     */
    public function retrieveConfirmation($id, $onBehalfOf = null)
    {
        return $this->doRetrieve(sprintf('payments/%s/confirmation', $id), function (stdClass $response) {
            return $this->createPaymentConfirmationFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param stdClass $response
     * @return PaymentConfirmation
     */
    protected function createPaymentConfirmationFromResponse($response){
        $paymentConfirmation = new PaymentConfirmation(
            $response->id,
            $response->payment_id,
            $response->account_id,
            $response->short_reference,
            $response->status,
            $response->confirmation_url,
            !empty($response->created_at) ? new DateTime($response->created_at) : null,
            !empty($response->updatet_at) ? new DateTime($response->updated_at) : null,
            !empty($response->expires_at) ? new DateTime($response->expires_at) : null
        );
        return $paymentConfirmation;
    }


    /**
     * @param DateTime $paymentDate
     * @param string $paymentType
     * @param string $currency
     * @param string $bankCountry
     *
     * @return PaymentDeliveryDate
     */
    public function paymentDeliveryDate($paymentDate, $paymentType, $currency, $bankCountry){
        $response = $this->request('GET',
            'payments/payment_delivery_date',
            ['payment_date' => $paymentDate->format('Y-m-d'),
                'payment_type' => $paymentType,
                'currency' => $currency,
                'bank_country' => $bankCountry]);

        return new PaymentDeliveryDate(new DateTime($response->payment_date),new DateTime($response->payment_delivery_date),
            new DateTime($response->payment_cutoff_time),$response->payment_type,$response->currency,$response->bank_country);
    }

    /**
     * @param string $paymentCurrency
     * @param string $paymentDestinationCountry
     * @param string $paymentType
     * @param string $chargeType
     * @param string $accountId
     *
     * @return QuotePaymentFee
     */
    public function getQuotePaymentFee($paymentCurrency, $paymentDestinationCountry, $paymentType, $chargeType=null,
                                       $accountId=null){
        $response = $this->request('GET',
            'payments/quote_payment_fee',
            ['payment_currency' => $paymentCurrency,
                'payment_destination_country' => $paymentDestinationCountry,
                'payment_type' => $paymentType,
                'charge_type' => $chargeType,
                'account_id' => $accountId]);

        return new QuotePaymentFee($response->account_id, $response->payment_currency, $response->payment_destination_country,
            $response->payment_type, $response->charge_type, $response->fee_amount, $response->fee_currency);
    }

    /**
     * @param string $id
     *
     * @return PaymentTrackingInfo
     */
    public function getTrackingInfo($id)
    {
        $response = $this->request('GET',
            sprintf('payments/%s/tracking_info', $id));

        return $this->createTrackingInfoFromResponse($response);
    }

    /**
     * @param stdClass $response
     *
     * @return PaymentTrackingInfo
     */
    private function createTrackingInfoFromResponse(stdClass $response)
    {
        $trackingInfo = new PaymentTrackingInfo();
        $trackingInfo->setUetr($response->uetr);
        $trackingInfo->setTransactionStatus(
            new PaymentTrackingInfo\TransactionStatus($response->transaction_status->status,
                $response->transaction_status->reason));
        $trackingInfo->setCompletionTime(null !== $response->completion_time ?
            new DateTime($response->completion_time) : null);
        $trackingInfo->setInitiationTime(null !== $response->initiation_time ?
            new DateTime($response->initiation_time) : null);
        $trackingInfo->setLastUpdateTime(null !== $response->last_update_time ?
            new DateTime($response->last_update_time) : null);

        $paymentEvents = [];
        foreach ($response->payment_events as $paymentEvent) {
            $paymentEvents[] = $this->createTrackingInfoPaymentEventFromResponse($paymentEvent);
        }
        $trackingInfo->setPaymentEvents($paymentEvents);
        return $trackingInfo;
    }

    /**
     * @param stdClass $paymentEventResponse
     *
     * @return PaymentTrackingInfo\PaymentEvent
     */
    private function createTrackingInfoPaymentEventFromResponse(stdClass $paymentEventResponse)
    {
        $paymentEvent = new PaymentTrackingInfo\PaymentEvent();
        $paymentEvent->setForwardedToAgent($paymentEventResponse->forwarded_to_agent);
        $paymentEvent->setFrom($paymentEventResponse->from);
        $paymentEvent->setFundsAvailable($paymentEventResponse->funds_available);
        $paymentEvent->setOriginator($paymentEventResponse->originator);
        $paymentEvent->setTo($paymentEventResponse->to);
        $paymentEvent->setTrackerEventType($paymentEventResponse->tracker_event_type);
        $paymentEvent->setTransactionStatus(null !== $paymentEventResponse->transaction_status ?
            new PaymentTrackingInfo\TransactionStatus($paymentEventResponse->transaction_status->status,
                $paymentEventResponse->transaction_status->reason) : null);
        $paymentEvent->setValid($paymentEventResponse->valid);
        $paymentEvent->setSerialParties(null !== $paymentEventResponse->serial_parties ?
            new PaymentTrackingInfo\SerialParties($paymentEventResponse->serial_parties->debtor,
                $paymentEventResponse->serial_parties->debtor_agent,
                $paymentEventResponse->serial_parties->intermediary_agent1,
                $paymentEventResponse->serial_parties->instructing_reimbursement_agent,
                $paymentEventResponse->serial_parties->creditor_agent,
                $paymentEventResponse->serial_parties->creditor) : null);
        $paymentEvent->setSenderAcknowledgementReceipt(null !== $paymentEventResponse->sender_acknowledgement_receipt ?
            new DateTime($paymentEventResponse->sender_acknowledgement_receipt) : null);
        $paymentEvent->setInstructedAmount(null !== $paymentEventResponse->instructed_amount ?
            new PaymentTrackingInfo\Amount($paymentEventResponse->instructed_amount->currency, $paymentEventResponse->instructed_amount->amount) : null);
        $paymentEvent->setConfirmedAmount(null !== $paymentEventResponse->confirmed_amount ?
            new PaymentTrackingInfo\Amount($paymentEventResponse->confirmed_amount->currency, $paymentEventResponse->confirmed_amount->amount) : null);
        $paymentEvent->setInterbankSettlementAmount(null !== $paymentEventResponse->interbank_settlement_amount ?
            new PaymentTrackingInfo\Amount($paymentEventResponse->interbank_settlement_amount->currency, $paymentEventResponse->interbank_settlement_amount->amount) : null);
        $paymentEvent->setInterbankSettlementDate(null !== $paymentEventResponse->interbank_settlement_date ?
            new DateTime($paymentEventResponse->interbank_settlement_date) : null);
        $paymentEvent->setChargeAmount(null !== $paymentEventResponse->charge_amount ?
            new PaymentTrackingInfo\Amount($paymentEventResponse->charge_amount->currency, $paymentEventResponse->charge_amount->amount) : null);
        $paymentEvent->setChargeType($paymentEventResponse->charge_type);
        $paymentEvent->setForeignExchangeDetails(null !== $paymentEventResponse->foreign_exchange_details ?
            new PaymentTrackingInfo\ForeignExchangeDetails($paymentEventResponse->foreign_exchange_details->source_currency,
                $paymentEventResponse->foreign_exchange_details->target_currency,
                $paymentEventResponse->foreign_exchange_details->rate) : null);
        $paymentEvent->setLastUpdateTime(null !== $paymentEventResponse->last_update_time ?
            new DateTime($paymentEventResponse->last_update_time) : null);

        return $paymentEvent;
    }
}
