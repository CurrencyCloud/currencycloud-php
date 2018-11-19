<?php
namespace CurrencyCloud\Criteria;

use DateTime;

class ConversionReportCriteria
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
    private $buyCurrency;
    /*
     * @var string|null
     */
    private $sellCurrency;
    /*
     * @var string|null
     */
    private $clientBuyAmountFrom;
    /*
     * @var string|null
     */
    private $clientBuyAmountTo;
    /*
     * @var string|null
     */
    private $clientSellAmountFrom;
    /*
     * @var string|null
     */
    private $clientSellAmountTo;
    /*
     * @var string|null
     */
    private $partnerBuyAmountFrom;
    /*
     * @var string|null
     */
    private $partnerBuyAmountTo;
    /*
     * @var string|null
     */
    private $partnerSellAmountFrom;
    /*
     * @var string|null
     */
    private $partnerSellAmountTo;
    /*
     * @var string|null
     */
    private $clientStatus;
    /*
     * @var string|null
     */
    private $partnerStatus;
    /*
     * @var DateTime
     */
    private $conversionDateFrom;
    /*
     * @var DateTime
     */
    private $conversionDateTo;
    /*
     * @var DateTime
     */
    private $settlementDateFrom;
    /*
     * @var DateTime
     */
    private $settlementDateTo;
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
    public function getBuyCurrency()
    {
        return $this->buyCurrency;
    }

    /**
     * @param string $buyCurrency
     * @return $this
     */
    public function setBuyCurrency($buyCurrency)
    {
        $this->buyCurrency = $buyCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getSellCurrency()
    {
        return $this->sellCurrency;
    }

    /**
     * @param string $sellCurrency
     * @return $this
     */
    public function setSellCurrency($sellCurrency)
    {
        $this->sellCurrency = $sellCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientBuyAmountFrom()
    {
        return $this->clientBuyAmountFrom;
    }

    /**
     * @param string $clientBuyAmountFrom
     * @return $this
     */
    public function setClientBuyAmountFrom($clientBuyAmountFrom)
    {
        $this->clientBuyAmountFrom = $clientBuyAmountFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientBuyAmountTo()
    {
        return $this->clientBuyAmountTo;
    }

    /**
     * @param string $clientBuyAmountTo
     * @return $this
     */
    public function setClientBuyAmountTo($clientBuyAmountTo)
    {
        $this->clientBuyAmountTo = $clientBuyAmountTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSellAmountFrom()
    {
        return $this->clientSellAmountFrom;
    }

    /**
     * @param string $clientSellAmountFrom
     * @return $this
     */
    public function setClientSellAmountFrom($clientSellAmountFrom)
    {
        $this->clientSellAmountFrom = $clientSellAmountFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSellAmountTo()
    {
        return $this->clientSellAmountTo;
    }

    /**
     * @param string $clientSellAmountTo
     * @return $this
     */
    public function setClientSellAmountTo($clientSellAmountTo)
    {
        $this->clientSellAmountTo = $clientSellAmountTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerBuyAmountFrom()
    {
        return $this->partnerBuyAmountFrom;
    }

    /**
     * @param string $partnerBuyAmountFrom
     * @return $this
     */
    public function setPartnerBuyAmountFrom($partnerBuyAmountFrom)
    {
        $this->partnerBuyAmountFrom = $partnerBuyAmountFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerBuyAmountTo()
    {
        return $this->partnerBuyAmountTo;
    }

    /**
     * @param string $partnerBuyAmountTo
     * @return $this
     */
    public function setPartnerBuyAmountTo($partnerBuyAmountTo)
    {
        $this->partnerBuyAmountTo = $partnerBuyAmountTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerSellAmountFrom()
    {
        return $this->partnerSellAmountFrom;
    }

    /**
     * @param string $partnerSellAmountFrom
     * @return $this
     */
    public function setPartnerSellAmountFrom($partnerSellAmountFrom)
    {
        $this->partnerSellAmountFrom = $partnerSellAmountFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerSellAmountTo()
    {
        return $this->partnerSellAmountTo;
    }

    /**
     * @param string $partnerSellAmountTo
     * @return $this
     */
    public function setPartnerSellAmountTo($partnerSellAmountTo)
    {
        $this->partnerSellAmountTo = $partnerSellAmountTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientStatus()
    {
        return $this->clientStatus;
    }

    /**
     * @param string $clientStatus
     * @return $this
     */
    public function setClientStatus($clientStatus)
    {
        $this->clientStatus = $clientStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerStatus()
    {
        return $this->partnerStatus;
    }

    /**
     * @param string $partnerStatus
     * @return $this
     */
    public function setPartnerStatus($partnerStatus)
    {
        $this->partnerStatus = $partnerStatus;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getConversionDateFrom()
    {
        return $this->conversionDateFrom;
    }

    /**
     * @param mixed $conversionDateFrom
     * @return $this
     */
    public function setConversionDateFrom($conversionDateFrom)
    {
        $this->conversionDateFrom = $conversionDateFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getConversionDateTo()
    {
        return $this->conversionDateTo;
    }

    /**
     * @param mixed $conversionDateTo
     * @return $this
     *
     */
    public function setConversionDateTo($conversionDateTo)
    {
        $this->conversionDateTo = $conversionDateTo;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getSettlementDateFrom()
    {
        return $this->settlementDateFrom;
    }

    /**
     * @param mixed $settlementDateFrom
     * @return $this
     */
    public function setSettlementDateFrom($settlementDateFrom)
    {
        $this->settlementDateFrom = $settlementDateFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getSettlementDateTo()
    {
        return $this->settlementDateTo;
    }

    /**
     * @param mixed $settlementDateTo
     * @return $this
     */
    public function setSettlementDateTo($settlementDateTo)
    {
        $this->settlementDateTo = $settlementDateTo;
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