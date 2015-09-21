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
     * @param Account[] $accounts
     * @param Pagination $pagination
     */
    public function __construct(array $accounts, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->accounts = $accounts;
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
