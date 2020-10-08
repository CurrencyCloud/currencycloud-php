<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class WithdrawalAccounts extends PaginatedData
{

    /**
     * @var WithdrawalAccount[]
     */
    private $withdrawalAccounts;

    /**
     * @param WithdrawalAccount[] $withdrawalAccounts
     * @param Pagination $pagination
     */
    public function __construct(array $withdrawalAccounts, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->withdrawalAccounts = $withdrawalAccounts;
    }

    /**
     * @return WithdrawalAccount[]
     */
    public function getWithdrawalAccounts()
    {
        return $this->withdrawalAccounts;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->withdrawalAccounts);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->withdrawalAccounts);
    }
}
