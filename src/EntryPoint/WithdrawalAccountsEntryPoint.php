<?php

namespace CurrencyCloud\EntryPoint;

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
            $report = new FindWithdrawalAccountsCriteria();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        return $this->doFind('withdrawal_accounts/find', $findWithdrawalAccountsCriteria, $pagination, function ($findReportsCriteria) {
            return $this->convertFindWithdrawalAccountsCriteriaToRequest($findReportsCriteria);
        }, function ($response) {
            return $this->convertResponseToWithdrawalAccount($response);
        }, function (array $entities, Pagination $pagination) {
            return new WithdrawalAccounts($entities, $pagination);
        }, 'withdrawal_accounts');

        /**
         * @param FindIbansCriteria $findIbansCriteria
         * @return array
         */
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
}