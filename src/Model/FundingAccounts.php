<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class FundingAccounts extends PaginatedData
{

    /**
     * @var FundingAccount[]
     */
    private $fundingAccounts;

    /**
     * @param FundingAccount[] $fundingAccounts
     * @param Pagination $pagination
     */
    public function __construct(array $fundingAccounts, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->fundingAccounts = $fundingAccounts;
    }

    /**
     * @return FundingAccount[]
     */
    public function getFundingAccounts()
    {
        return $this->fundingAccounts;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->fundingAccounts);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->fundingAccounts);
    }
}
