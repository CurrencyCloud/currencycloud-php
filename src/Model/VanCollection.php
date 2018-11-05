<?php
namespace CurrencyCloud\Model;

use ArrayIterator;

class VanCollection extends PaginatedData {

    /**
     * @var Van[]
     */
    private $vans;

    /**
     * @param Van[] $vans
     * @param Pagination $pagination
     */
    public function __construct(array $vans, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->vans = $vans;
    }

    /**
     * @return Van[]
     */
    public function getVans()
    {
        return $this->vans;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->vans);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->vans);
    }
}