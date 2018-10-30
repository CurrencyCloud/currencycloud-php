<?php
namespace CurrencyCloud\Model;


use stdClass;

class PayerDetails {

    /**
     * @var string
     */
    private $payerEntityType;
    /**
     * @var string
     */
    private $paymentType;
    /**
     * @var RequiredFieldEntry[]
     */
    private $requiredFields;
    /**
     * @var string
     */
    private $payerIdentificationType;

    /**
     * PayerDetails constructor.
     * @param string $payerEntityType
     * @param string $paymentType
     * @param RequiredFieldEntry[] $requiredFields
     */
    public function __construct($payerEntityType, $paymentType, $payerIdentificationType,array $requiredFields)
    {
        $this->payerEntityType = $payerEntityType;
        $this->paymentType = $paymentType;
        $this->requiredFields = $requiredFields;
        $this->payerIdentificationType = $payerIdentificationType;
    }

    /**
     * @return string
     */
    public function getPayerEntityType()
    {
        return $this->payerEntityType;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @return RequiredFieldEntry[]
     */
    public function getRequiredFields()
    {
        return $this->requiredFields;
    }

    /**
     * @return string
     */
    public function getPayerIdentificationType()
    {
        return $this->payerIdentificationType;
    }

}