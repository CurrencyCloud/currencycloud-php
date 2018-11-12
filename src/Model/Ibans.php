<?php
namespace CurrencyCloud\Model;

use ArrayIterator;
use CurrencyCloud\Model\PaginatedData;
use CurrencyCloud\Model\Pagination;

class Ibans extends PaginatedData {

    /**
     * @var Iban[]
     */
    private $ibans;

    /**
     * Ibans constructor.
     * @param Iban[] $ibans
     * @param Pagination $pagination
     */
    function __construct(array $ibans, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->ibans = $ibans;
    }

    /**
     * @return Iban[]
     */
    public function getIbans()
    {
        return $this->ibans;
    }

    /**
     * @param Iban[] $ibans
     */
    public function setIbans($ibans)
    {
        $this->ibans = $ibans;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->ibans);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->ibans);
    }
}