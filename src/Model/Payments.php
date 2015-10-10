<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Payments extends PaginatedData
{

    /**
     * @var Payment[]
     */
    private $payments;

    /**
     * @param Payment[] $payments
     * @param Pagination $pagination
     */
    public function __construct(array $payments, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->payments = $payments;
    }

    /**
     * @return Payment[]
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->payments);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->payments);
    }
}
