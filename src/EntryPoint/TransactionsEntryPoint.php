<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\Transaction;
use CurrencyCloud\Model\Transactions;
use CurrencyCloud\Model\TransactionSender;
use DateTime;
use stdClass;

class TransactionsEntryPoint extends AbstractEntryPoint
{
    const DATE_FORMAT = 'Y-m-d';

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     *
     * @return Transaction
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'GET',
            sprintf('transactions/%s', $id),
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );
        return $this->createTransactionFromResponse($response);
    }

    /**
     * @param Transaction|null $transaction
     * @param null|string $amountFrom
     * @param null|string $amountTo
     * @param DateTime|null $settlesAtFrom
     * @param DateTime|null $settlesAtTo
     * @param DateTime|null $createdAtFrom
     * @param DateTime|null $createdAtTo
     * @param DateTime|null $updatedAtFrom
     * @param DateTime|null $updatedAtTo
     * @param null|string $onBehalfOf
     * @param Pagination|null $pagination
     * @param DateTime|null $completedAtFrom
     * @param DateTime|null $completedAtTo
     * @param String|null $scope
     *
     * @return Transactions
     */
    public function find(
        Transaction $transaction = null,
        $amountFrom = null,
        $amountTo = null,
        DateTime $settlesAtFrom = null,
        DateTime $settlesAtTo = null,
        DateTime $createdAtFrom = null,
        DateTime $createdAtTo = null,
        DateTime $updatedAtFrom = null,
        DateTime $updatedAtTo = null,
        $onBehalfOf = null,
        Pagination $pagination = null,
        DateTime $completedAtFrom = null,
        DateTime $completedAtTo = null,
        $scope = null
    ) {
        if (null === $transaction) {
            $transaction = new Transaction();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }

        $response = $this->request(
            'GET',
            'transactions/find',
            $this->convertTransactionToRequest($transaction) + $this->convertPaginationToRequest($pagination) + [
                'amount_from' => $amountFrom,
                'amount_to' => $amountTo,
                'settles_at_from' => (null === $settlesAtFrom) ? null : $settlesAtFrom->format(self::DATE_FORMAT),
                'settles_at_to' => (null === $settlesAtTo) ? null : $settlesAtTo->format(self::DATE_FORMAT),
                'created_at_from' => (null === $createdAtFrom) ? null : $createdAtFrom->format(self::DATE_FORMAT),
                'created_at_to' => (null === $createdAtTo) ? null : $createdAtTo->format(self::DATE_FORMAT),
                'updated_at_from' => (null === $updatedAtFrom) ? null : $updatedAtFrom->format(self::DATE_FORMAT),
                'updated_at_to' => (null === $updatedAtTo) ? null : $updatedAtTo->format(self::DATE_FORMAT),
                'completed_at_from' => (null === $completedAtFrom) ? null : $completedAtFrom->format(self::DATE_FORMAT),
                'completed_at_to' => (null === $completedAtTo) ? null : $completedAtTo->format(self::DATE_FORMAT),
                'on_behalf_of' => $onBehalfOf,
                'scope' => $scope
            ]
        );
        $accounts = [];
        foreach ($response->transactions as $data) {
            $accounts[] = $this->createTransactionFromResponse($data);
        }
        return new Transactions($accounts, $this->createPaginationFromResponse($response));
    }

    /**
     * @param Transaction $transaction
     *
     * @return array
     */
    public function convertTransactionToRequest(Transaction $transaction)
    {
        return [
            'currency' => $transaction->getCurrency(),
            'amount' => $transaction->getAmount(),
            'action' => $transaction->getAction(),
            'related_entity_type' => $transaction->getRelatedEntityType(),
            'related_entity_id' => $transaction->getRelatedEntityId(),
            'related_entity_short_reference' => $transaction->getRelatedEntityShortReference(),
            'status' => $transaction->getStatus(),
            'type' => $transaction->getType(),
            'reason' => $transaction->getReason()
        ];
    }

    /**
     * @param stdClass $response
     *
     * @return Transaction
     */
    protected function createTransactionFromResponse(stdClass $response)
    {
        $transaction = (new Transaction())->setBalanceId($response->balance_id)
            ->setAccountId($response->account_id)
            ->setCurrency($response->currency)
            ->setAmount($response->amount)
            ->setBalanceAmount($response->balance_amount)
            ->setType($response->type)
            ->setAction($response->action)
            ->setRelatedEntityType($response->related_entity_type)
            ->setRelatedEntityId($response->related_entity_id)
            ->setRelatedEntityShortReference($response->related_entity_short_reference)
            ->setStatus($response->status)
            ->setReason($response->reason)
            ->setSettlesAt((null === $response->settles_at) ? null : new DateTime($response->settles_at))
            ->setCreatedAt((null === $response->created_at) ? null : new DateTime($response->created_at))
            ->setCompletedAt((null === $response->created_at) ? null : new DateTime($response->created_at))
            ->setUpdatedAt((null === $response->updated_at) ? null : new DateTime($response->updated_at));

        $this->setIdProperty($transaction, $response->id);

        return $transaction;
    }

    /**
     * @param string $id
     * @param string $onBehalfOf
     * @return TransactionSender
     */
    public function retrieveSender($id, $onBehalfOf = null){
        $response = $this->request(
            'GET',
            sprintf('transactions/sender/%s', $id),
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createTransactionSenderFromResponse($response);
    }

    /**
     * @param stdClass
     * @return TransactionSender
     */
    protected function createTransactionSenderFromResponse($response){
        return new TransactionSender(
            $response->id,
            $response->amount,
            $response->currency,
            $response->additional_information,
            !empty($response->value_date) ? new DateTime($response->value_date) : null,
            $response->sender,
            $response->receiving_account_number,
            $response->receiving_account_iban,
            !empty($response->created_at) ? new DateTime($response->created_at) : null,
            !empty($response->updated_at) ? new DateTime($response->updated_at) : null
        );
    }
}
