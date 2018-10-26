<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Reports extends PaginatedData
{

    /**
     * @var Report[]
     */
    private $reports;

    /**
     * @param Report[] $reports
     * @param Pagination $pagination
     */
    public function __construct(array $reports, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->reports = $reports;
    }

    /**
     * @return Report[]
     */
    public function getReports()
    {
        return $this->reports;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->reports);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->reports);
    }
}
