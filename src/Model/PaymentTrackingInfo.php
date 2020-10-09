<?php

namespace CurrencyCloud\Model;

use CurrencyCloud\Model\PaymentTrackingInfo\PaymentEvent;
use DateTime;

class PaymentTrackingInfo
{

    /**
     * @var string
     */
    private $uetr;

    /**
     * @var PaymentTrackingInfo\TransactionStatus
     */
    private $transactionStatus;

    /**
     * @var DateTime
     */
    private $initiationTime;

    /**
     * @var DateTime
     */
    private $completionTime;

    /**
     * @var DateTime
     */
    private $lastUpdateTime;

    /**
     * @var PaymentTrackingInfo\PaymentEvent[]
     */
    private $paymentEvents;

    /**
     * @return string
     */
    public function getUetr()
    {
        return $this->uetr;
    }

    /**
     * @param string $uetr
     */
    public function setUetr(string $uetr)
    {
        $this->uetr = $uetr;
    }

    /**
     * @return PaymentTrackingInfo\TransactionStatus
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * @param PaymentTrackingInfo\TransactionStatus $transactionStatus
     */
    public function setTransactionStatus(PaymentTrackingInfo\TransactionStatus $transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;
    }

    /**
     * @return DateTime
     */
    public function getInitiationTime()
    {
        return $this->initiationTime;
    }

    /**
     * @param DateTime $initiationTime
     */
    public function setInitiationTime(DateTime $initiationTime = null)
    {
        $this->initiationTime = $initiationTime;
    }

    /**
     * @return DateTime
     */
    public function getCompletionTime()
    {
        return $this->completionTime;
    }

    /**
     * @param DateTime $completionTime
     */
    public function setCompletionTime(DateTime $completionTime = null)
    {
        $this->completionTime = $completionTime;
    }

    /**
     * @return DateTime
     */
    public function getLastUpdateTime()
    {
        return $this->lastUpdateTime;
    }

    /**
     * @param DateTime $lastUpdateTime
     */
    public function setLastUpdateTime(DateTime $lastUpdateTime = null)
    {
        $this->lastUpdateTime = $lastUpdateTime;
    }

    /**
     * @return PaymentEvent[]
     */
    public function getPaymentEvents()
    {
        return $this->paymentEvents;
    }

    /**
     * @param PaymentEvent[] $paymentEvents
     */
    public function setPaymentEvents(array $paymentEvents)
    {
        $this->paymentEvents = $paymentEvents;
    }


}

namespace CurrencyCloud\Model\PaymentTrackingInfo;

use DateTime;

class TransactionStatus
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $reason;

    /**
     * TransactionStatus constructor.
     * @param string $status
     * @param string $reason
     */
    public function __construct(string $status, string $reason)
    {
        $this->status = $status;
        $this->reason = $reason;
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

}

class PaymentEvent
{

    /**
     * @var string
     */
    private $trackerEventType;
    /**
     * @var bool
     */
    private $valid;
    /**
     * @var TransactionStatus
     */
    private $transactionStatus;
    /**
     * @var DateTime
     */
    private $fundsAvailable;
    /**
     * @var string
     */
    private $forwardedToAgent;
    /**
     * @var string
     */
    private $from;
    /**
     * @var string
     */
    private $to;
    /**
     * @var string
     */
    private $originator;
    /**
     * @var SerialParties
     */
    private $serialParties;
    /**
     * @var DateTime
     */
    private $senderAcknowledgementReceipt;
    /**
     * @var Amount
     */
    private $instructedAmount;
    /**
     * @var Amount
     */
    private $confirmedAmount;
    /**
     * @var Amount
     */
    private $interbankSettlementAmount;
    /**
     * @var DateTime
     */
    private $interbankSettlementDate;
    /**
     * @var Amount
     */
    private $chargeAmount;
    /**
     * @var string
     */
    private $chargeType;
    /**
     * @var ForeignExchangeDetails
     */
    private $foreignExchangeDetails;
    /**
     * @var DateTime
     */
    private $lastUpdateTime;


    /**
     * @return string
     */
    public function getTrackerEventType()
    {
        return $this->trackerEventType;
    }

    /**
     * @param string $trackerEventType
     */
    public function setTrackerEventType(string $trackerEventType = null)
    {
        $this->trackerEventType = $trackerEventType;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid = null)
    {
        $this->valid = $valid;
    }

    /**
     * @return TransactionStatus
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * @param TransactionStatus $transactionStatus
     */
    public function setTransactionStatus(TransactionStatus $transactionStatus = null)
    {
        $this->transactionStatus = $transactionStatus;
    }

    /**
     * @return DateTime
     */
    public function getFundsAvailable()
    {
        return $this->fundsAvailable;
    }

    /**
     * @param DateTime $fundsAvailable
     */
    public function setFundsAvailable($fundsAvailable = null)
    {
        $this->fundsAvailable = $fundsAvailable;
    }

    /**
     * @return string
     */
    public function getForwardedToAgent()
    {
        return $this->forwardedToAgent;
    }

    /**
     * @param string $forwardedToAgent
     */
    public function setForwardedToAgent(string $forwardedToAgent = null)
    {
        $this->forwardedToAgent = $forwardedToAgent;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string $from
     */
    public function setFrom(string $from = null)
    {
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $to
     */
    public function setTo(string $to = null)
    {
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getOriginator()
    {
        return $this->originator;
    }

    /**
     * @param string $originator
     */
    public function setOriginator(string $originator = null)
    {
        $this->originator = $originator;
    }

    /**
     * @return SerialParties
     */
    public function getSerialParties()
    {
        return $this->serialParties;
    }

    /**
     * @param SerialParties $serialParties
     */
    public function setSerialParties(SerialParties $serialParties = null)
    {
        $this->serialParties = $serialParties;
    }

    /**
     * @return DateTime
     */
    public function getSenderAcknowledgementReceipt()
    {
        return $this->senderAcknowledgementReceipt;
    }

    /**
     * @param DateTime $senderAcknowledgementReceipt
     */
    public function setSenderAcknowledgementReceipt($senderAcknowledgementReceipt = null)
    {
        $this->senderAcknowledgementReceipt = $senderAcknowledgementReceipt;
    }

    /**
     * @return Amount
     */
    public function getInstructedAmount()
    {
        return $this->instructedAmount;
    }

    /**
     * @param Amount $instructedAmount
     */
    public function setInstructedAmount(Amount $instructedAmount = null)
    {
        $this->instructedAmount = $instructedAmount;
    }

    /**
     * @return Amount
     */
    public function getConfirmedAmount()
    {
        return $this->confirmedAmount;
    }

    /**
     * @param Amount $confirmedAmount
     */
    public function setConfirmedAmount(Amount $confirmedAmount = null)
    {
        $this->confirmedAmount = $confirmedAmount;
    }

    /**
     * @return Amount
     */
    public function getInterbankSettlementAmount()
    {
        return $this->interbankSettlementAmount;
    }

    /**
     * @param Amount $interbankSettlementAmount
     */
    public function setInterbankSettlementAmount(Amount $interbankSettlementAmount = null)
    {
        $this->interbankSettlementAmount = $interbankSettlementAmount;
    }

    /**
     * @return DateTime
     */
    public function getInterbankSettlementDate()
    {
        return $this->interbankSettlementDate;
    }

    /**
     * @param DateTime $interbankSettlementDate
     */
    public function setInterbankSettlementDate(DateTime $interbankSettlementDate = null)
    {
        $this->interbankSettlementDate = $interbankSettlementDate;
    }

    /**
     * @return Amount
     */
    public function getChargeAmount()
    {
        return $this->chargeAmount;
    }

    /**
     * @param Amount $chargeAmount
     */
    public function setChargeAmount(Amount $chargeAmount = null)
    {
        $this->chargeAmount = $chargeAmount;
    }

    /**
     * @return string
     */
    public function getChargeType()
    {
        return $this->chargeType;
    }

    /**
     * @param string $chargeType
     */
    public function setChargeType(string $chargeType = null)
    {
        $this->chargeType = $chargeType;
    }

    /**
     * @return ForeignExchangeDetails
     */
    public function getForeignExchangeDetails()
    {
        return $this->foreignExchangeDetails;
    }

    /**
     * @param ForeignExchangeDetails $foreignExchangeDetails
     */
    public function setForeignExchangeDetails(ForeignExchangeDetails $foreignExchangeDetails = null)
    {
        $this->foreignExchangeDetails = $foreignExchangeDetails;
    }

    /**
     * @return DateTime
     */
    public function getLastUpdateTime()
    {
        return $this->lastUpdateTime;
    }

    /**
     * @param DateTime $lastUpdateTime
     */
    public function setLastUpdateTime(DateTime $lastUpdateTime = null)
    {
        $this->lastUpdateTime = $lastUpdateTime;
    }



}


class SerialParties
{
    /**
     * @var string
     */
    private $debtor;
    /**
     * @var string
     */
    private $debtorAgent;
    /**
     * @var string
     */
    private $intermediaryAgent1;
    /**
     * @var string
     */
    private $instructingReimbursementAgent;
    /**
     * @var string
     */
    private $creditorAgent;
    /**
     * @var string
     */
    private $creditor;

    /**
     * SerialParties constructor.
     * @param string $debtor
     * @param string $debtorAgent
     * @param string $intermediaryAgent1
     * @param string $instructingReimbursementAgent
     * @param string $creditorAgent
     * @param string $creditor
     */
    public function __construct(string $debtor = null, string $debtorAgent = null, string $intermediaryAgent1 = null,
                                string $instructingReimbursementAgent = null, string $creditorAgent = null,
                                string $creditor = null)
    {
        $this->debtor = $debtor;
        $this->debtorAgent = $debtorAgent;
        $this->intermediaryAgent1 = $intermediaryAgent1;
        $this->instructingReimbursementAgent = $instructingReimbursementAgent;
        $this->creditorAgent = $creditorAgent;
        $this->creditor = $creditor;
    }

    /**
     * @return string
     */
    public function getDebtor()
    {
        return $this->debtor;
    }

    /**
     * @return string
     */
    public function getDebtorAgent()
    {
        return $this->debtorAgent;
    }

    /**
     * @return string
     */
    public function getIntermediaryAgent1()
    {
        return $this->intermediaryAgent1;
    }

    /**
     * @return string
     */
    public function getInstructingReimbursementAgent()
    {
        return $this->instructingReimbursementAgent;
    }

    /**
     * @return string
     */
    public function getCreditorAgent()
    {
        return $this->creditorAgent;
    }

    /**
     * @return string
     */
    public function getCreditor()
    {
        return $this->creditor;
    }

}

class Amount
{
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $amount;

    /**
     * Amount constructor.
     * @param string $currency
     * @param string $amount
     */
    public function __construct(string $currency, string $amount)
    {
        $this->currency = $currency;
        $this->amount = $amount;
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
}

class ForeignExchangeDetails
{
    /**
     * @var string
     */
    private $sourceCurrency;
    /**
     * @var string
     */
    private $targetCurrency;
    /**
     * @var string
     */
    private $rate;

    /**
     * ForeignExchangeDetails constructor.
     * @param string $sourceCurrency
     * @param string $targetCurrency
     * @param string $rate
     */
    public function __construct(string $sourceCurrency, string $targetCurrency, string $rate)
    {
        $this->sourceCurrency = $sourceCurrency;
        $this->targetCurrency = $targetCurrency;
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getSourceCurrency()
    {
        return $this->sourceCurrency;
    }

    /**
     * @return string
     */
    public function getTargetCurrency()
    {
        return $this->targetCurrency;
    }

    /**
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }



}