<?php
namespace CurrencyCloud\Model;

use DateTime;

class Report implements EntityInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $shortReference;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \stdClass
     */
    private $searchParams;

    /**
     * @var string
     */
    private $reportType;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $failureReason;

    /**
     * @var string
     */
    private $expirationDate;

    /**
     * @var string
     */
    private $reportUrl;

    /**
     * @var string
     */
    private $accountId;

    /**
     * @var string
     */
    private $contactId;

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @return string
     */
    public function getId(){
        return $this->id;
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
        $this->shortReference = (string) $shortReference;
        return $this;
    }

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
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getSearchParams()
    {
        return $this->searchParams;
    }

    /**
     * @param \stdClass $searchParams
     * @return $this
     *
     */
    public function setSearchParams($searchParams)
    {
        $this->searchParams = $searchParams;
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
        $this->reportType = (string) $reportType;
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
     *
     */
    public function setStatus($status)
    {
        $this->status = (string) $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getFailureReason()
    {
        return $this->failureReason;
    }

    /**
     * @param string $failureReason
     * @return $this
     */
    public function setFailureReason($failureReason)
    {
        $this->failureReason = (string) $failureReason;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param string $expirationDate
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = (string) $expirationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getReportUrl()
    {
        return $this->reportUrl;
    }

    /**
     * @param string $reportUrl
     * @return $this
     */
    public function setReportUrl($reportUrl)
    {
        $this->reportUrl = (string) $reportUrl;
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
        $this->accountId = (string) $accountId;
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
        $this->contactId = (string) $contactId;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }



}