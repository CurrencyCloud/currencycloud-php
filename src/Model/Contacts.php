<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Contacts extends PaginatedData
{

    /**
     * @var Contact[]
     */
    private $contacts;

    /**
     * @param Contact[] $contacts
     * @param Pagination $pagination
     */
    public function __construct(array $contacts, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->contacts = $contacts;
    }

    /**
     * @return Contact[]
     */
    public function getAccounts()
    {
        return $this->contacts;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->contacts);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->contacts);
    }
}
