<?php

namespace CurrencyCloud\Model;

use ArrayIterator;

class Beneficiaries extends PaginatedData
{

    /**
     * @var Beneficiary[]
     */
    private $beneficiaries;

    /**
     * @param Beneficiary[] $beneficiaries
     * @param Pagination $pagination
     */
    public function __construct(array $beneficiaries, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->beneficiaries = $beneficiaries;
    }

    /**
     * @return Beneficiary[]
     */
    public function getBeneficiaries()
    {
        return $this->beneficiaries;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->beneficiaries);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->beneficiaries);
    }
}
