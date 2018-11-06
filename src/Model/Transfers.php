<?php
namespace CurrencyCloud\Model;

use ArrayIterator;

class Transfers extends PaginatedData {

    /**
     * @var Transfer[]
     */
    private $transfers;

    /**
     * @param Transfer[] $transfers
     * @param Pagination $pagination
     */
    public function __construct(array $transfers, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->transfers = $transfers;
    }

    /**
     * @return Transfer[]
     */
    public function getBeneficiaries()
    {
        return $this->transfers;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->transfers);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->transfers);
    }
}