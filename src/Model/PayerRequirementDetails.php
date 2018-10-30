<?php
namespace CurrencyCloud\Model;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class PayerRequirementDetails implements Countable, IteratorAggregate {

    /**
     * @var PayerDetails[]
     */
    private $payerDetails;

    /**
     * PayerRequirementDetails constructor.
     * @param PayerDetails[] $payerDetails
     */
    public function __construct(array $payerDetails)
    {
        $this->payerDetails = $payerDetails;
    }


    /**
     * @return PayerDetails[]
     */
    public function getPayerDetails()
    {
        return $this->payerDetails;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->payerDetails);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->payerDetails);
    }
}