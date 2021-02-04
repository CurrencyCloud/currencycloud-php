<?php
namespace CurrencyCloud\Model;

use stdClass;

class ReportSearchParams {

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
    /*
     * @var string|null
     */
    private $onBehalfOf;
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

    /**
     * ReportSearchParams constructor.
     * @param stdClass $data
     */
    public function __construct($data)
    {
        $this->shortReference = $this->getValue($data,'short_reference');
        $this->description = $this->getValue($data, 'description');
        $this->accountId = $this->getValue($data, 'account_id');
        $this->contactId = $this->getValue($data,'contact_id');
        $this->createdAtFrom = $this->getValue($data, 'created_at_from');
        $this->createdAtTo = $this->getValue($data, 'created_at_to');
        $this->expirationDateFrom = $this->getValue($data, 'expiration_date_from');
        $this->expirationDateTo = $this->getValue($data, 'expiration_date_to');
        $this->status = $this->getValue($data, 'status');
        $this->reportType = $this->getValue($data, 'report_type');
        $this->onBehalfOf = $this->getValue($data, 'on_behalf_of');
        $this->buyCurrency = $this->getValue($data, 'buy_currency');
        $this->sellCurrency = $this->getValue($data, 'sell_currency');
        $this->clientBuyAmountFrom = $this->getValue($data, 'client_buy_amount_from');
        $this->clientBuyAmountTo = $this->getValue($data, 'client_buy_amount_to');
        $this->clientSellAmountFrom = $this->getValue($data, 'client_sell_amount_from');
        $this->clientSellAmountTo = $this->getValue($data, 'client_sell_amount_to');
        $this->partnerBuyAmountFrom = $this->getValue($data, 'partner_buy_amount_from');
        $this->partnerBuyAmountTo = $this->getValue($data, 'partner_buy_amount_to');
        $this->partnerSellAmountFrom = $this->getValue($data, 'partner_sell_amount_from');
        $this->partnerSellAmountTo = $this->getValue($data, 'partner_sell_amount_to');
        $this->clientStatus = $this->getValue($data, 'client_status');
        $this->conversionDateFrom = $this->getValue($data, 'conversion_date_from');
        $this->conversionDateTo = $this->getValue($data, 'conversion_date_to');
        $this->settlementDateFrom = $this->getValue($data, 'settlement_date_from');
        $this->settlementDateTo = $this->getValue($data, 'settlement_date_to');
        $this->updatedAtFrom = $this->getValue($data, 'updated_at_from');
        $this->updatedAtTo = $this->getValue($data, 'updated_at_to');
        $this->uniqueRequestId = $this->getValue($data, 'unique_request_id');
        $this->scope = $this->getValue($data, 'scope');
        $this->currency = $this->getValue($data, 'currency');
        $this->amountFrom = $this->getValue($data, 'amount_from');
        $this->amountTo = $this->getValue($data, 'amount_to');
        $this->paymentDateFrom = $this->getValue($data, 'payment_date_from');
        $this->paymentDateTo = $this->getValue($data, 'payment_date_to');
        $this->transferedAtFrom = $this->getValue($data, 'transfered_at_from');
        $this->transferedAtTo = $this->getValue($data, 'transfered_at_to');
        $this->beneficiaryId = $this->getValue($data, 'beneficiary_id');
        $this->conversionId = $this->getValue($data, 'conversion_id');
        $this->withDeleted = $this->getValue($data, 'with_deleted');
        $this->paymentGroupId = $this->getValue($data, 'payment_group_id');
    }

    /**
     * @param stdClass $data
     * @param string $name
     * @return string|null
     */
    protected function getValue($data, $name){
        return !empty($data->$name) ? $data->$name : null;
    }

    /**
     * @return null|string
     */
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return null|string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return null|string
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @return null|string
     */
    public function getCreatedAtFrom()
    {
        return $this->createdAtFrom;
    }

    /**
     * @return null|string
     */
    public function getCreatedAtTo()
    {
        return $this->createdAtTo;
    }

    /**
     * @return null|string
     */
    public function getExpirationDateFrom()
    {
        return $this->expirationDateFrom;
    }

    /**
     * @return null|string
     */
    public function getExpirationDateTo()
    {
        return $this->expirationDateTo;
    }

    /**
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return null|string
     */
    public function getReportType()
    {
        return $this->reportType;
    }

    /**
     * @return null|string
     */
    public function getOnBehalfOf()
    {
        return $this->onBehalfOf;
    }

    /**
     * @return null|string
     */
    public function getBuyCurrency()
    {
        return $this->buyCurrency;
    }

    /**
     * @return null|string
     */
    public function getSellCurrency()
    {
        return $this->sellCurrency;
    }

    /**
     * @return null|string
     */
    public function getClientBuyAmountFrom()
    {
        return $this->clientBuyAmountFrom;
    }

    /**
     * @return null|string
     */
    public function getClientBuyAmountTo()
    {
        return $this->clientBuyAmountTo;
    }

    /**
     * @return null|string
     */
    public function getClientSellAmountFrom()
    {
        return $this->clientSellAmountFrom;
    }

    /**
     * @return null|string
     */
    public function getClientSellAmountTo()
    {
        return $this->clientSellAmountTo;
    }

    /**
     * @return null|string
     */
    public function getPartnerBuyAmountFrom()
    {
        return $this->partnerBuyAmountFrom;
    }

    /**
     * @return null|string
     */
    public function getPartnerBuyAmountTo()
    {
        return $this->partnerBuyAmountTo;
    }

    /**
     * @return null|string
     */
    public function getPartnerSellAmountFrom()
    {
        return $this->partnerSellAmountFrom;
    }

    /**
     * @return null|string
     */
    public function getPartnerSellAmountTo()
    {
        return $this->partnerSellAmountTo;
    }

    /**
     * @return null|string
     */
    public function getClientStatus()
    {
        return $this->clientStatus;
    }

    /**
     * @return null|string
     */
    public function getConversionDateFrom()
    {
        return $this->conversionDateFrom;
    }

    /**
     * @return null|string
     */
    public function getConversionDateTo()
    {
        return $this->conversionDateTo;
    }

    /**
     * @return null|string
     */
    public function getSettlementDateFrom()
    {
        return $this->settlementDateFrom;
    }

    /**
     * @return null|string
     */
    public function getSettlementDateTo()
    {
        return $this->settlementDateTo;
    }

    /**
     * @return null|string
     */
    public function getUpdatedAtFrom()
    {
        return $this->updatedAtFrom;
    }

    /**
     * @return null|string
     */
    public function getUpdatedAtTo()
    {
        return $this->updatedAtTo;
    }

    /**
     * @return null|string
     */
    public function getUniqueRequestId()
    {
        return $this->uniqueRequestId;
    }

    /**
     * @return null|string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @return null|string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return null|string
     */
    public function getAmountFrom()
    {
        return $this->amountFrom;
    }

    /**
     * @return null|string
     */
    public function getAmountTo()
    {
        return $this->amountTo;
    }

    /**
     * @return null|string
     */
    public function getPaymentDateFrom()
    {
        return $this->paymentDateFrom;
    }

    /**
     * @return null|string
     */
    public function getPaymentDateTo()
    {
        return $this->paymentDateTo;
    }

    /**
     * @return null|string
     */
    public function getTransferedAtFrom()
    {
        return $this->transferedAtFrom;
    }

    /**
     * @return null|string
     */
    public function getTransferedAtTo()
    {
        return $this->transferedAtTo;
    }

    /**
     * @return null|string
     */
    public function getBeneficiaryId()
    {
        return $this->beneficiaryId;
    }

    /**
     * @return null|string
     */
    public function getConversionId()
    {
        return $this->conversionId;
    }

    /**
     * @return null|string
     */
    public function getWithDeleted()
    {
        return $this->withDeleted;
    }

    /**
     * @return null|string
     */
    public function getPaymentGroupId()
    {
        return $this->paymentGroupId;
    }
}