<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Balances extends PaginatedData
{

    /**
     * @var Balance[]
     */
    private $balances;

    /**
     * @param Balance[] $balances
     * @param Pagination $pagination
     */
    public function __construct(array $balances, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->balances = $balances;
    }

    /**
     * @return Balance[]
     */
    public function getBalances()
    {
        return $this->balances;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->balances);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->balances);
    }
}
