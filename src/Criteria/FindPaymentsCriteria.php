<?php

namespace CurrencyCloud\Criteria;

use DateTime;

class FindPaymentsCriteria
{

    /**
     * @var DateTime|null
     */
    private $createdAtFrom;
    /**
     * @var DateTime|null
     */
    private $createdAtTo;
    /**
     * @var DateTime|null
     */
    private $updatedAtFrom;
    /**
     * @var DateTime|null
     */
    private $updatedAtTo;
    /**
     * @var DateTime|null
     */
    private $paymentDateFrom;
    /**
     * @var DateTime|null
     */
    private $paymentDateTo;
    /**
     * @var DateTime|null
     */
    private $transferredAtFrom;
    /**
     * @var DateTime|null
     */
    private $transferredAtTo;
    /**
     * @var string|null
     */
    private $amountFrom;
    /**
     * @var string|null
     */
    private $amountTo;

    /**
     * @return DateTime|null
     */
    public function getCreatedAtFrom()
    {
        return $this->createdAtFrom;
    }

    /**
     * @param DateTime $createdAtFrom
     *
     * @return $this
     */
    public function setCreatedAtFrom(DateTime $createdAtFrom)
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
     * @param DateTime $createdAtTo
     *
     * @return $this
     */
    public function setCreatedAtTo(DateTime $createdAtTo)
    {
        $this->createdAtTo = $createdAtTo;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAtFrom()
    {
        return $this->updatedAtFrom;
    }

    /**
     * @param DateTime $updatedAtFrom
     *
     * @return $this
     */
    public function setUpdatedAtFrom(DateTime $updatedAtFrom)
    {
        $this->updatedAtFrom = $updatedAtFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAtTo()
    {
        return $this->updatedAtTo;
    }

    /**
     * @param DateTime $updatedAtTo
     *
     * @return $this
     */
    public function setUpdatedAtTo(DateTime $updatedAtTo)
    {
        $this->updatedAtTo = $updatedAtTo;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getPaymentDateFrom()
    {
        return $this->paymentDateFrom;
    }

    /**
     * @param DateTime|null $paymentDateFrom
     *
     * @return $this
     */
    public function setPaymentDateFrom(DateTime $paymentDateFrom)
    {
        $this->paymentDateFrom = $paymentDateFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getPaymentDateTo()
    {
        return $this->paymentDateTo;
    }

    /**
     * @param DateTime|null $paymentDateTo
     *
     * @return $this
     */
    public function setPaymentDateTo(DateTime $paymentDateTo)
    {
        $this->paymentDateTo = $paymentDateTo;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getTransferredAtFrom()
    {
        return $this->transferredAtFrom;
    }

    /**
     * @param DateTime|null $transferredAtFrom
     *
     * @return $this
     */
    public function setTransferredAtFrom(DateTime $transferredAtFrom)
    {
        $this->transferredAtFrom = $transferredAtFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getTransferredAtTo()
    {
        return $this->transferredAtTo;
    }

    /**
     * @param DateTime|null $transferredAtTo
     *
     * @return $this
     */
    public function setTransferredAtTo(DateTime $transferredAtTo)
    {
        $this->transferredAtTo = $transferredAtTo;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAmountFrom()
    {
        return $this->amountFrom;
    }

    /**
     * @param null|string $amountFrom
     *
     * @return $this
     */
    public function setAmountFrom($amountFrom)
    {
        $this->amountFrom = $amountFrom;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAmountTo()
    {
        return $this->amountTo;
    }

    /**
     * @param null|string $amountTo
     *
     * @return $this
     */
    public function setAmountTo($amountTo)
    {
        $this->amountTo = $amountTo;
        return $this;
    }
}
