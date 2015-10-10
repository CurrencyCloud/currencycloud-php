<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Settlements extends PaginatedData
{

    /**
     * @var Settlement[]
     */
    private $settlements;

    /**
     * @param Settlement[] $settlements
     * @param Pagination $pagination
     */
    public function __construct(array $settlements, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->settlements = $settlements;
    }

    /**
     * @return Settlement[]
     */
    public function getSettlements()
    {
        return $this->settlements;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->settlements);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->settlements);
    }
}
