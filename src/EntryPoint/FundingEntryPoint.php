<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\FundingAccount;
use CurrencyCloud\Model\FundingAccounts;
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
     * @return FundingAccounts
     */
    public function findFundingAccounts($pagination, $currency, $accountId = null, $paymentType = null)
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
                    'payment_type' => $paymentType
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

}
