<?php

namespace CurrencyCloud\Model;

class Pagination
{
    /**
     * @var int
     */
    private $totalEntries;
    /**
     * @var int
     */
    private $totalPages;
    /**
     * @var int
     */
    private $currentPage;
    /**
     * @var int
     */
    private $perPage;
    /**
     * @var int
     */
    private $previousPage;
    /**
     * @var int
     */
    private $nextPage;
    /**
     * @var string
     */
    private $order;
    /**
     * @var string
     */
    private $orderAscDesc;

    /**
     * @param int $totalEntries
     * @param int $totalPages
     * @param int $currentPage
     * @param int $perPage
     * @param int $previousPage
     * @param int $nextPage
     * @param string $order
     * @param string $orderAscDesc
     */
    public function __construct(
        $totalEntries,
        $totalPages,
        $currentPage,
        $perPage,
        $previousPage,
        $nextPage,
        $order,
        $orderAscDesc
    ) {

        $this->totalEntries = (int) $totalEntries;
        $this->totalPages = (int) $totalPages;
        $this->currentPage = (int) $currentPage;
        $this->perPage = (int) $perPage;
        $this->previousPage = (int) $previousPage;
        $this->nextPage = (int) $nextPage;
        $this->order = (string) $order;
        $this->orderAscDesc = (string) $orderAscDesc;
    }

    /**
     * @return int
     */
    public function getTotalEntries()
    {
        return $this->totalEntries;
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getPreviousPage()
    {
        return $this->previousPage;
    }

    /**
     * @return int
     */
    public function getNextPage()
    {
        return $this->nextPage;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getOrderAscDesc()
    {
        return $this->orderAscDesc;
    }

    /**
     * @return bool
     */
    public function hasNextPage()
    {
        return -1 !== $this->nextPage;
    }

    /**
     * @return bool
     */
    public function hasPreviousPage()
    {
        return -1 !== $this->previousPage;
    }
}
