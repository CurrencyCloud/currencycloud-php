<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Transactions extends PaginatedData
{

    /**
     * @var Transaction[]
     */
    private $transactions;

    /**
     * @param Transaction[] $transactions
     * @param Pagination $pagination
     */
    public function __construct(array $transactions, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->transactions = $transactions;
    }

    /**
     * @return Transaction[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->transactions);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->transactions);
    }
}
