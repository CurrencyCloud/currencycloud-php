<?php
namespace CurrencyCloud\Criteria;

use DateTime;

class FindReportsCriteria
{
    /*
     * @var string|null
     */
    private $shortReference;
    /*
     * @var string|null
     */
    private $description;
    /*
     * @var string|null
     */
    private $accountId;
    /*
     * @var string|null
     */
    private $contactId;
    /*
     * @var DateTime
     */
    private $createdAtFrom;
    /*
     * @var DateTime
     */
    private $createdAtTo;
    /*
     * @var DateTime
     */
    private $expirationDateFrom;
    /*
     * @var DateTime
     */
    private $expirationDateTo;
    /*
     * @var string|null
     */
    private $status;
    /*
     * @var string|null
     */
    private $reportType;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     *
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @param string $shortReference
     * @return $this
     */
    public function setShortReference($shortReference)
    {
        $this->shortReference = $shortReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * @return string
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @param string $contactId
     * @return $this
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAtFrom()
    {
        return $this->createdAtFrom;
    }

    /**
     * @param mixed $createdAtFrom
     * @return $this
     */
    public function setCreatedAtFrom($createdAtFrom)
    {
        $this->createdAtFrom = $createdAtFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAtTo()
    {
        return $this->createdAtTo;
    }

    /**
     * @param mixed $createdAtTo
     * @return $this
     */
    public function setCreatedAtTo($createdAtTo)
    {
        $this->createdAtTo = $createdAtTo;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpirationDateFrom()
    {
        return $this->expirationDateFrom;
    }

    /**
     * @param DateTime $expirationDateFrom
     * @return $this
     */
    public function setExpirationDateFrom($expirationDateFrom)
    {
        $this->expirationDateFrom = $expirationDateFrom;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpirationDateTo()
    {
        return $this->expirationDateTo;
    }

    /**
     * @param DateTime $expirationDateTo
     * @return $this
     */
    public function setExpirationDateTo($expirationDateTo)
    {
        $this->expirationDateTo = $expirationDateTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getReportType()
    {
        return $this->reportType;
    }

    /**
     * @param string $reportType
     * @return $this
     */
    public function setReportType($reportType)
    {
        $this->reportType = $reportType;
        return $this;
    }

}