<?php
namespace CurrencyCloud\Criteria;

use DateTime;

class PaymentReportCriteria
{
    /*
     * @var string|null
     */
    private $onBehalfOf;
    /*
     * @var string|null
     */
    private $description;
    /*
     * @var string|null
     */
    private $currency;
    /*
     * @var string|null
     */
    private $amountFrom;
    /*
     * @var string|null
     */
    private $amountTo;
    /*
     * @var string|null
     */
    private $status;
    /*
     * @var DateTime
     */
    private $paymentDateFrom;
    /*
     * @var DateTime
     */
    private $paymentDateTo;
    /*
     * @var DateTime
     */
    private $transferedAtFrom;
    /*
     * @var DateTime
     */
    private $transferedAtTo;
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
    private $updatedAtFrom;
    /*
     * @var DateTime
     */
    private $updatedAtTo;
    /*
     * @var string|null
     */
    private $beneficiaryId;
    /*
     * @var string|null
     */
    private $conversionId;
    /*
     * @var string|null
     */
    private $withDeleted;
    /*
     * @var string|null
     */
    private $paymentGroupId;
    /*
     * @var string|null
     */
    private $uniqueRequestId;
    /*
     * @var string|null
     */
    private $scope;

    /**
     * @return string
     */
    public function getOnBehalfOf()
    {
        return $this->onBehalfOf;
    }

    /**
     * @param string $onBehalfOf
     * @return $this
     */
    public function setOnBehalfOf($onBehalfOf)
    {
        $this->onBehalfOf = $onBehalfOf;
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
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmountFrom()
    {
        return $this->amountFrom;
    }

    /**
     * @param string $amountFrom
     * @return $this
     */
    public function setAmountFrom($amountFrom)
    {
        $this->amountFrom = $amountFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmountTo()
    {
        return $this->amountTo;
    }

    /**
     * @param string $amountTo
     * @return $this
     */
    public function setAmountTo($amountTo)
    {
        $this->amountTo = $amountTo;
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
     * @return DateTime|null
     */
    public function getPaymentDateFrom()
    {
        return $this->paymentDateFrom;
    }

    /**
     * @param DateTime $paymentDateFrom
     * @return $this
     */
    public function setPaymentDateFrom($paymentDateFrom)
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
     * @param DateTime $paymentDateTo
     * @return $this
     */
    public function setPaymentDateTo($paymentDateTo)
    {
        $this->paymentDateTo = $paymentDateTo;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getTransferedAtFrom()
    {
        return $this->transferedAtFrom;
    }

    /**
     * @param DateTime $transferedAtFrom
     * @return $this
     */
    public function setTransferedAtFrom($transferedAtFrom)
    {
        $this->transferedAtFrom = $transferedAtFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getTransferedAtTo()
    {
        return $this->transferedAtTo;
    }

    /**
     * @param DateTime $transferedAtTo
     * @return $this
     */
    public function setTransferedAtTo($transferedAtTo)
    {
        $this->transferedAtTo = $transferedAtTo;
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
     * @return DateTime|null
     */
    public function getUpdatedAtFrom()
    {
        return $this->updatedAtFrom;
    }

    /**
     * @param mixed $updatedAtFrom
     * @return $this
     */
    public function setUpdatedAtFrom($updatedAtFrom)
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
     * @param mixed $updatedAtTo
     * @return $this
     */
    public function setUpdatedAtTo($updatedAtTo)
    {
        $this->updatedAtTo = $updatedAtTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeneficiaryId()
    {
        return $this->beneficiaryId;
    }

    /**
     * @param string $beneficiaryId
     * @return $this
     */
    public function setBeneficiaryId($beneficiaryId)
    {
        $this->beneficiaryId = $beneficiaryId;
        return $this;
    }

    /**
     * @return string
     */
    public function getConversionId()
    {
        return $this->conversionId;
    }

    /**
     * @param string $conversionId
     * @return $this
     */
    public function setConversionId($conversionId)
    {
        $this->conversionId = $conversionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getWithDeleted()
    {
        return $this->withDeleted;
    }

    /**
     * @param string $withDeleted
     * @return $this
     */
    public function setWithDeleted($withDeleted)
    {
        $this->withDeleted = $withDeleted;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentGroupId()
    {
        return $this->paymentGroupId;
    }

    /**
     * @param string $paymentGroupId
     * @return $this
     */
    public function setPaymentGroupId($paymentGroupId)
    {
        $this->paymentGroupId = $paymentGroupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueRequestId()
    {
        return $this->uniqueRequestId;
    }

    /**
     * @param string $uniqueRequestId
     * @return $this
     */
    public function setUniqueRequestId($uniqueRequestId)
    {
        $this->uniqueRequestId = $uniqueRequestId;
        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }
    
}