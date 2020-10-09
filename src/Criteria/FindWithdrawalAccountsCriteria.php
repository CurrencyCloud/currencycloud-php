<?php
namespace CurrencyCloud\Criteria;

class FindWithdrawalAccountsCriteria {


    /**
     * @var string
     */
    private $accountId;

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

}