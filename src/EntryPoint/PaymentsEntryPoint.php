<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\FindPaymentsCriteria;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\Payer;
use CurrencyCloud\Model\Payment;
use CurrencyCloud\Model\Payments;
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
            'unique_request_id' => $payment->getUniqueRequestId()
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
            'payment_date' => (null === $paymentDate) ? $paymentDate : $paymentDate->format(DateTime::RFC3339),
            'payment_type' => $payment->getPaymentType()
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
            ->setFailureReturnedAmount($response->failure_returned_amount);

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
     *
     * @return Payment
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        return $this->doRetrieve(sprintf('payments/%s', $id), function (stdClass $response) {
            return $this->createPaymentFromResponse($response);
        }, $onBehalfOf);
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
}
