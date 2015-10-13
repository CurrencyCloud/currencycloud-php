<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\FindPaymentsCriteria;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\Payer;
use CurrencyCloud\Model\Payment;
use CurrencyCloud\Model\Payments;
use DateTime;
use stdClass;

class PaymentsEntryPoint extends AbstractEntryPoint
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

        $response = $this->request(
            'POST',
            'payments/create',
            [],
            $this->convertPaymentToRequest($payment) + $this->convertPayerToRequest($payer) + [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createPaymentFromResponse($response);
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
            'conversion_id' => $payment->getConversionId()
        ];
        if ($convertForFind) {
            return $common + [
                'short_reference' => $payment->getShortReference(),
                'status' => $payment->getStatus()
            ];
        }
        $paymentDate = $payment->getPaymentDate();
        return [
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
            'payer_address' => $payer->getAddress(),
            'payer_postcode' => $payer->getPostcode(),
            'payer_state_or_province' => $payer->getStateOrProvince(),
            'payer_country' => $payer->getCountry(),
            'payer_date_of_birth' => (null === $payerDateOfBirth) ? $payerDateOfBirth : $payerDateOfBirth->format(
                DateTime::RFC3339
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
            ->setLastUpdatedContactId($response->last_updated_contact_id)
            ->setFailureReason($response->failure_reason)
            ->setPayerId($response->payer_id)
            ->setCreatedAt(new DateTime($response->created_at))
            ->setUpdatedAt(new DateTime($response->updated_at));

        $this->setIdProperty($payment, $response->id);
        return $payment;
    }

    /**
     * @param string $id
     * @param null $onBehalfOf
     *
     * @return Payment
     */
    public function delete($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            sprintf('payments/%s/delete', $id),
            [],
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );
        return $this->createPaymentFromResponse($response);
    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     *
     * @return Payment
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'GET',
            sprintf('payments/%s', $id),
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createPaymentFromResponse($response);
    }

    /**
     * @param string $id
     * @param Payment $payment
     * @param Payer|null $payer
     * @param null|string $onBehalfOf
     *
     * @return Payment
     */
    public function update($id, Payment $payment, Payer $payer = null, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            sprintf(
                'payments/%s',
                $id
            ),
            [],
            $this->convertPaymentToRequest($payment) + $this->convertPayerToRequest($payer) + [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createPaymentFromResponse($response);
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
        FindPaymentsCriteria $criteria,
        Pagination $pagination = null,
        $onBehalfOf = null
    ) {
        if (null === $payment) {
            $payment = new Payment();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        $response = $this->request(
            'GET',
            'accounts/find',
            $this->convertPaymentToRequest($payment, true)
            + $this->convertPaginationToRequest($pagination)
            + $this->convertFindPaymentsCriteriaToRequest($criteria)
            + ['on_behalf_of' => $onBehalfOf]
        );
        $payments = [];
        foreach ($response->payments as $data) {
            $payments[] = $this->createPaymentFromResponse($data);
        }
        return new Payments($payments, $this->createPaginationFromResponse($response));
    }

    /**
     * @param FindPaymentsCriteria $criteria
     *
     * @return array
     */
    private function convertFindPaymentsCriteriaToRequest(FindPaymentsCriteria $criteria)
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
