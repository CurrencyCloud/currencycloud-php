<?php

namespace CurrencyCloud\Model;

use Countable;
use IteratorAggregate;

abstract class PaginatedData implements Countable, IteratorAggregate
{

    /**
     * @var Pagination
     */
    private $pagination;

    /**
     * @param Pagination $pagination
     */
    public function __construct(Pagination $pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @return Pagination
     */
    public function getPagination()
    {
        return $this->pagination;
    }
}
