<?php
namespace CurrencyCloud\Model;

use DateTime;

class PaymentConfirmation {

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $paymentId;
    /**
     * @var string
     */
    private $accountId;
    /**
     * @var string
     */
    private $shortReference;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $confirmationUrl;
    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var DateTime
     */
    private $updatedAt;
    /**
     * @var DateTime
     */
    private $expiresAt;

    /**
     * PaymentConfirmation constructor.
     * @param string $id
     * @param string $paymentId
     * @param string $accountId
     * @param string $shortReference
     * @param string $status
     * @param string $confirmationUrl
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime $expiresAt
     */
    public function __construct($id, $paymentId, $accountId, $shortReference, $status, $confirmationUrl, DateTime $createdAt, DateTime $updatedAt, DateTime $expiresAt)
    {
        $this->id = $id;
        $this->paymentId = $paymentId;
        $this->accountId = $accountId;
        $this->shortReference = $shortReference;
        $this->status = $status;
        $this->confirmationUrl = $confirmationUrl;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->expiresAt = $expiresAt;
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
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getConfirmationUrl()
    {
        return $this->confirmationUrl;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

}