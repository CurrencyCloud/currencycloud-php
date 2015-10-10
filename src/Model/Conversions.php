<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Conversions extends PaginatedData
{

    /**
     * @var Conversion[]
     */
    private $conversions;

    /**
     * @param Conversion[] $conversions
     * @param Pagination $pagination
     */
    public function __construct(array $conversions, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->conversions = $conversions;
    }

    /**
     * @return Conversion[]
     */
    public function getConversions()
    {
        return $this->conversions;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->conversions);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->conversions);
    }
}
