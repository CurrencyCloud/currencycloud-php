<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Accounts extends PaginatedData
{
    /**
     * @var array
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
     * @return array
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
