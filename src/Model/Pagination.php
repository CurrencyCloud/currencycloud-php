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
     *
     * @return $this
     */
    public static function create($totalEntries, $totalPages, $currentPage, $perPage, $previousPage, $nextPage, $order, $orderAscDesc)
    {
        return (new Pagination())
            ->setTotalEntries($totalEntries)
            ->setTotalPages($totalPages)
            ->setCurrentPage($currentPage)
            ->setPerPage($perPage)
            ->setPreviousPage($previousPage)
            ->setNextPage($nextPage)
            ->setOrder($order)
            ->setOrderAscDesc($orderAscDesc);
    }

    /**
     * @return int
     */
    public function getTotalEntries()
    {
        return $this->totalEntries;
    }

    /**
     * @param int $totalEntries
     *
     * @return $this
     */
    public function setTotalEntries($totalEntries)
    {
        $this->totalEntries = $totalEntries;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @param int $totalPages
     *
     * @return $this
     */
    public function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     *
     * @return $this
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = (null === $currentPage) ? null : (int) $currentPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     *
     * @return $this
     */
    public function setPerPage($perPage)
    {
        $this->perPage = (null === $perPage) ? null : (int) $perPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getPreviousPage()
    {
        return $this->previousPage;
    }

    /**
     * @param int $previousPage
     *
     * @return $this
     */
    public function setPreviousPage($previousPage)
    {
        $this->previousPage = $previousPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getNextPage()
    {
        return $this->nextPage;
    }

    /**
     * @param int $nextPage
     *
     * @return $this
     */
    public function setNextPage($nextPage)
    {
        $this->nextPage = $nextPage;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $order
     *
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = (null === $order) ? null : (string) $order;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderAscDesc()
    {
        return $this->orderAscDesc;
    }

    /**
     * @param string $orderAscDesc
     *
     * @return $this
     */
    public function setOrderAscDesc($orderAscDesc)
    {
        $this->orderAscDesc = (null === $orderAscDesc) ? null : (string) $orderAscDesc;
        return $this;
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
