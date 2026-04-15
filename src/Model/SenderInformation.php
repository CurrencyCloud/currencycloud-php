<?php

namespace CurrencyCloud\Model;

class SenderInformation
{
    /**
     * @var string
     */
    private $accountNumber;
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $bic;
    /**
     * @var string
     */
    private $country;
    /**
     * @var string
     */
    private $iban;
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $routingCode;

    /**
     * @param string $accountNumber
     * @param string $address
     * @param string $bic
     * @param string $country
     * @param string $iban
     * @param string $id
     * @param string $name
     * @param string $routingCode
     */
    public function __construct(
        $accountNumber,
        $address,
        $bic,
        $country,
        $iban,
        $id,
        $name,
        $routingCode
    ) {
        $this->accountNumber = $accountNumber;
        $this->address = $address;
        $this->bic = $bic;
        $this->country = $country;
        $this->iban = $iban;
        $this->id = $id;
        $this->name = $name;
        $this->routingCode = $routingCode;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRoutingCode()
    {
        return $this->routingCode;
    }
}
