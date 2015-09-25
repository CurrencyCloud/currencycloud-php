<?php

namespace CurrencyCloud\Model;

use stdClass;

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
        $totalEntries = null,
        $totalPages = null,
        $currentPage = null,
        $perPage = null,
        $previousPage = null,
        $nextPage = null,
        $order = null,
        $orderAscDesc = null
    ) {

        $this->totalEntries = (null === $totalEntries) ? null : (int) $totalEntries;
        $this->totalPages = (null === $totalPages) ? null : (int) $totalPages;
        $this->currentPage = (null === $currentPage) ? null : (int) $currentPage;
        $this->perPage = (null === $perPage) ? null : (int) $perPage;
        $this->previousPage = (null === $previousPage) ? null : (int) $previousPage;
        $this->nextPage = (null === $nextPage) ? null : (int) $nextPage;
        $this->order = (null === $order) ? null : (string) $order;
        $this->orderAscDesc = (null === $orderAscDesc) ? null : (string) $orderAscDesc;
    }

    /**
     * @param stdClass $response
     * @return Pagination
     */
    public static function createFromResponse(stdClass $response)
    {
        $pagination = $response->pagination;
        return new Pagination(
            $pagination->total_entries,
            $pagination->total_pages,
            $pagination->current_page,
            $pagination->per_page,
            $pagination->previous_page,
            $pagination->next_page,
            $pagination->order,
            $pagination->order_asc_desc
        );
    }

    /**
     * @return Pagination
     */
    public static function create()
    {
       return new Pagination(); 
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

    /**
     * @param string $orderAscDesc
     * @return $this
     */
    public function setOrderAscDesc($orderAscDesc)
    {
        $this->orderAscDesc = (string) $orderAscDesc;
        return $this;
    }

    /**
     * @param string $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = (string) $order;
        return $this;
    }

    /**
     * @param int $perPage
     * @return $this
     */
    public function setPerPage($perPage)
    {
        $this->perPage = (int) $perPage;
        return $this;
    }

    /**
     * @param int $currentPage
     * @return $this
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = (int) $currentPage;
        return $this;
    }
}
