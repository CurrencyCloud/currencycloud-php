<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\WithdrawalAccountFunds;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\WithdrawalAccount;
use CurrencyCloud\Model\WithdrawalAccounts;
use CurrencyCloud\Criteria\FindWithdrawalAccountsCriteria;
use DateTime;

class WithdrawalAccountsEntryPoint extends AbstractEntityEntryPoint
{
    public function findWithdrawalAccounts(
        FindWithdrawalAccountsCriteria $findWithdrawalAccountsCriteria,
        Pagination $pagination)
    {
        if (null === $findWithdrawalAccountsCriteria) {
            $findWithdrawalAccountsCriteria = new FindWithdrawalAccountsCriteria();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        return $this->doFind('withdrawal_accounts/find', $findWithdrawalAccountsCriteria, $pagination, function ($findWithdrawalAccountsCriteria) {
            return $this->convertFindWithdrawalAccountsCriteriaToRequest($findWithdrawalAccountsCriteria);
        }, function ($response) {
            return $this->convertResponseToWithdrawalAccount($response);
        }, function (array $entities, Pagination $pagination) {
            return new WithdrawalAccounts($entities, $pagination);
        }, 'withdrawal_accounts');
    }

    /**
     * @param string $withdrawalAccountId
     * @param string $reference
     * @param string $amount
     *
     * @return WithdrawalAccountFunds
     */
    public function pullFunds(
         $withdrawalAccountId,
         $reference,
        $amount
    ) {
        $response = $this->request('POST',
            sprintf('withdrawal_accounts/%s/pull_funds', $withdrawalAccountId),
            [],
            [
                'reference' => $reference,
                'amount' => $amount
            ]);

        return $this->convertResponseToWithdrawalAccountFunds($response);
    }


    protected function convertFindWithdrawalAccountsCriteriaToRequest(FindWithdrawalAccountsCriteria $findWithdrawalAccountsCriteria){
        $common = [
            'account_id' => $findWithdrawalAccountsCriteria->getAccountId()
        ];
        return $common;
    }

    protected function convertResponseToWithdrawalAccount($response) {
        $withdrawalAccount = new WithdrawalAccount();

        $this->setIdProperty($withdrawalAccount, $response->id, 'id');
        $withdrawalAccount->setAccountId($response->account_id);
        $withdrawalAccount->setAccountName($response->account_name);
        $withdrawalAccount->setAccountHolderName($response->account_holder_name);
        $withdrawalAccount->setAccountHolderDob(null !== $response->account_holder_dob ? new DateTime($response->account_holder_dob) : null);
        $withdrawalAccount->setRoutingCode($response->routing_code);
        $withdrawalAccount->setAccountNumber($response->account_number);
        $withdrawalAccount->setCurrency($response->currency);

        return $withdrawalAccount;
    }

    protected function convertResponseToWithdrawalAccountFunds($response) {
        $withdrawalAccountFunds = new WithdrawalAccountFunds();

        $this->setIdProperty($withdrawalAccountFunds, $response->id, 'id');
        $withdrawalAccountFunds->setWithdrawalAccountId($response->withdrawal_account_id);
        $withdrawalAccountFunds->setReference($response->reference);
        $withdrawalAccountFunds->setAmount($response->amount);
        $withdrawalAccountFunds->setCreatedAt(null !== $response->created_at ? new DateTime($response->created_at) : null);

        return $withdrawalAccountFunds;
    }

}