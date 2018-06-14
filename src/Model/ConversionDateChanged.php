<?php

namespace CurrencyCloud\Model;

use DateTime;

class ConversionDateChanged
{


    /**
     * @var string
     */
    private $conversion_id;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;


    /**
     * @var DateTime
     */
    private $new_conversion_date;


    /**
     * @var DateTime
     */
    private $new_settlement_date;


    /**
     * @var DateTime
     */
    private $old_conversion_date;

    /**
     * @return string
     */
    public function getConversionId()
    {
        return $this->conversion_id;
    }

    /**
     * @param string $conversion_id
     * @return ConversionDateChanged
     */
    public function setConversionId($conversion_id)
    {
        $this->conversion_id = $conversion_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     * @return ConversionDateChanged
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
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
     * @return ConversionDateChanged
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getNewConversionDate()
    {
        return $this->new_conversion_date;
    }

    /**
     * @param DateTime $new_conversion_date
     * @return ConversionDateChanged
     */
    public function setNewConversionDate($new_conversion_date)
    {
        $this->new_conversion_date = $new_conversion_date;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getNewSettlementDate()
    {
        return $this->new_settlement_date;
    }

    /**
     * @param DateTime $new_settlement_date
     * @return ConversionDateChanged
     */
    public function setNewSettlementDate($new_settlement_date)
    {
        $this->new_settlement_date = $new_settlement_date;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getOldConversionDate()
    {
        return $this->old_conversion_date;
    }

    /**
     * @param DateTime $old_conversion_date
     * @return ConversionDateChanged
     */
    public function setOldConversionDate($old_conversion_date)
    {
        $this->old_conversion_date = $old_conversion_date;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getOldSettlementDate()
    {
        return $this->old_settlement_date;
    }

    /**
     * @param DateTime $old_settlement_date
     * @return ConversionDateChanged
     */
    public function setOldSettlementDate($old_settlement_date)
    {
        $this->old_settlement_date = $old_settlement_date;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEventDateTime()
    {
        return $this->event_date_time;
    }

    /**
     * @param DateTime $event_date_time
     * @return ConversionDateChanged
     */
    public function setEventDateTime($event_date_time)
    {
        $this->event_date_time = $event_date_time;
        return $this;
    }


    /**
     * @var DateTime
     */
    private $old_settlement_date;


    /**
     * @var DateTime
     */
    private $event_date_time;


}
