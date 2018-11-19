<?php
namespace CurrencyCloud\Model;

use DateTime;

class Transfer implements EntityInterface {

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

    private $sourceAccountId;
    /**
     * @var string
     */

    private $destinationAccountId;
    /**
     * @var string
     */

    private $currency;
    /**
     * @var string
     */

    private $amount;
    /**
     * @var string
     */

    private $status;
    /**
     * @var string
     */

    private $reason;

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
    private $completedAt;

    /**
     * @var string
     */
    private $creatorAccountId;

    /**
     * @var string
     */
    private $creatorContactId;

    /**
     * Transfer constructor.
     * @param string $id
     * @param string $shortReference
     * @param string $sourceAccountId
     * @param string $destinationAccountId
     * @param string $currency
     * @param string $amount
     * @param string $status
     * @param string $reason
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     * @param DateTime $completedAt
     * @param string $creatorAccountId
     * @param string $creatorContactId
     */
    public function __construct($id, $shortReference, $sourceAccountId, $destinationAccountId, $currency, $amount, $status, $reason, $createdAt, $updatedAt, $completedAt, $creatorAccountId, $creatorContactId)
    {
        $this->id = $id;
        $this->shortReference = $shortReference;
        $this->sourceAccountId = $sourceAccountId;
        $this->destinationAccountId = $destinationAccountId;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->status = $status;
        $this->reason = $reason;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->completedAt = $completedAt;
        $this->creatorAccountId = $creatorAccountId;
        $this->creatorContactId = $creatorContactId;
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
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @return string
     */
    public function getSourceAccountId()
    {
        return $this->sourceAccountId;
    }

    /**
     * @return string
     */
    public function getDestinationAccountId()
    {
        return $this->destinationAccountId;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
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
    public function getReason()
    {
        return $this->reason;
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
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * @return string
     */
    public function getCreatorAccountId()
    {
        return $this->creatorAccountId;
    }

    /**
     * @return string
     */
    public function getCreatorContactId()
    {
        return $this->creatorContactId;
    }

}