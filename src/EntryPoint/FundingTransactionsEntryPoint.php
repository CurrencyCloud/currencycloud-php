<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\FundingTransaction;
use CurrencyCloud\Model\FundingTransactionSender;
use DateTime;
use stdClass;

class FundingTransactionsEntryPoint extends AbstractEntryPoint
{
    /**
     * @param string $id
     * @param string $onBehalfOf
     * @return FundingTransaction
     */
    public function retrieveFundingTransaction($id, $onBehalfOf = null){
        $response = $this->request(
            'GET',
            sprintf('funding_transactions/%s', $id),
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createFundingTransactionFromResponse($response);
    }

    /**
     * @param stdClass
     * @return FundingTransaction
     */
    protected function createFundingTransactionFromResponse($response){
        return new FundingTransaction(
            $response->id,
            $response->amount,
            $response->currency,
            $response->rail,
            $response->additional_information,
            $response->receiving_account_routing_code,
            !empty($response->value_date) ? new DateTime($response->value_date) : null,
            $response->receiving_account_number,
            $response->receiving_account_iban,
            !empty($response->created_at) ? new DateTime($response->created_at) : null,
            !empty($response->updated_at) ? new DateTime($response->updated_at) : null,
            !empty($response->completed_at) ? new DateTime($response->completed_at) : null,
            $this->createFundingTransactionSenderFromResponse($response->sender)
        );
    }

    /**
     * @param stdClass
     * @return FundingTransactionSender
     */
    protected function createFundingTransactionSenderFromResponse($response){
        return new FundingTransactionSender(
            $response->sender_id,
            $response->sender_address,
            $response->sender_country,
            $response->sender_name,
            $response->sender_bic,
            $response->sender_iban,
            $response->sender_account_number,
            $response->sender_routing_code
        );
    }
}
