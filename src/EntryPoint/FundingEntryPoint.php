<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\FundingAccount;
use CurrencyCloud\Model\FundingAccounts;
use CurrencyCloud\Model\FundingTransaction;
use CurrencyCloud\Model\SenderInformation;
use CurrencyCloud\Model\Pagination;
use DateTime;
use stdClass;

class FundingEntryPoint extends AbstractEntryPoint
{

    /**
     * @param Pagination $pagination
     * @param string $currency
     * @param string $accountId
     * @param string $paymentType
     * @param null|string $onBehalfOf
     * @return FundingAccounts
     */
    public function findFundingAccounts($pagination,
                                        $currency,
                                        $accountId = null,
                                        $paymentType = null,
                                        $onBehalfOf = null)
    {
        if (empty($pagination)) {
            $pagination = new Pagination();
        }
        $response = $this->request(
            'GET',
            'funding_accounts/find',
            array_merge(
                [
                    'currency' => $currency,
                    'account_id' => $accountId,
                    'payment_type' => $paymentType,
                    'on_behalf_of' => $onBehalfOf
                ],
                $this->convertPaginationToRequest($pagination)
            )
        );

        return $this->createFundingAccountsFromResponse($response);
    }

    /**
     * @param stdClass $response
     * @return FundingAccounts
     */
    protected function createFundingAccountsFromResponse($response){
        return new FundingAccounts(
            $this->createFundingAccountArrayFromResponse($response),
            $this->createPaginationFromResponse($response)
        );
    }

    /**
     * @param stdClass $response
     * @return array
     */
    protected function createFundingAccountArrayFromResponse($response){
        $fundingAccounts = [];
        if(empty($response->funding_accounts)){
            return $fundingAccounts;
        }
        foreach ($response->funding_accounts as $key => $value) {
            array_push($fundingAccounts, new FundingAccount(
                $value->id,
                $value->account_id,
                $value->account_number,
                $value->account_number_type,
                $value->account_holder_name,
                $value->bank_name,
                $value->bank_address,
                $value->bank_country,
                $value->currency,
                $value->payment_type,
                $value->routing_code,
                $value->routing_code_type,
                !empty($value->created_at) ? new DateTime($value->created_at) : null,
                !empty($value->updated_at) ? new DateTime($value->updated_at) : null
            ));
        }

        return $fundingAccounts;
    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     *
     * @return FundingTransaction
     */
    public function retrieveFundingTransaction($id, $onBehalfOf = null)
    {
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
     * @param stdClass $response
     *
     * @return FundingTransaction
     */
    protected function createFundingTransactionFromResponse(stdClass $response)
    {
        $sender = null;
        if (isset($response->sender)) {
            $sender = $this->createSenderInformationFromResponse($response->sender);
        }

        return new FundingTransaction(
            $response->id,
            $response->amount,
            $response->currency,
            $response->rail,
            $response->additional_information,
            $response->receiving_account_routing_code,
            new DateTime($response->value_date),
            $response->receiving_account_number,
            $response->receiving_account_iban,
            new DateTime($response->created_at),
            new DateTime($response->updated_at),
            new DateTime($response->completed_at),
            $sender
        );
    }

    /**
     * @param stdClass $response
     *
     * @return SenderInformation
     */
    protected function createSenderInformationFromResponse(stdClass $response)
    {
        return new SenderInformation(
            $response->sender_account_number,
            $response->sender_address,
            $response->sender_bic,
            $response->sender_country,
            $response->sender_iban,
            $response->sender_id,
            $response->sender_name,
            $response->sender_routing_code
        );
    }

}
