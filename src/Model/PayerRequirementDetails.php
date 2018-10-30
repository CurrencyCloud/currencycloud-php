<?php
namespace CurrencyCloud\Model;

class PayerRequirementDetails {

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


}