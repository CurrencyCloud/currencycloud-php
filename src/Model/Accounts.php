<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Accounts extends PaginatedData
{

    /**
     * @var Account[]
     */
    private $accounts;

    /**
     * @param Account[] $transactions
     * @param Pagination $pagination
     */
    public function __construct(array $transactions, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->accounts = $transactions;
    }

    /**
     * @return Account[]
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->accounts);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->accounts);
    }
}
