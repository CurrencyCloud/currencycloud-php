<?php

namespace CurrencyCloud\Model;

use DateTime;

class CancelledConversion
{

    /**
     * @var string
     */
    private $account_id;
    /**
     * @var string
     */
    private $contact_id;
    /**
     * @var string
     */
    private $event_account_id;
    /**
     * @var string
     */
    private $event_contact_id;
    /**
     * @var string
     */
    private $conversion_id;

    /**
     * @var string
     */
    private $event_type;
    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $notes;

    /**
     * @var DateTime
     */
    private $event_date_time;


    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * @param string $account_id
     * @return CancelledConversion
     */
    public function setAccountId($account_id)
    {
        $this->account_id = $account_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getContactId()
    {
        return $this->contact_id;
    }

    /**
     * @param string $contact_id
     * @return CancelledConversion
     */
    public function setContactId($contact_id)
    {
        $this->contact_id = $contact_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEventAccountId()
    {
        return $this->event_account_id;
    }

    /**
     * @param string $event_account_id
     * @return CancelledConversion
     */
    public function setEventAccountId($event_account_id)
    {
        $this->event_account_id = $event_account_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEventContactId()
    {
        return $this->event_contact_id;
    }

    /**
     * @param string $event_contact_id
     * @return CancelledConversion
     */
    public function setEventContactId($event_contact_id)
    {
        $this->event_contact_id = $event_contact_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getConversionId()
    {
        return $this->conversion_id;
    }

    /**
     * @param string $conversion_id
     * @return CancelledConversion
     */
    public function setConversionId($conversion_id)
    {
        $this->conversion_id = $conversion_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEventType()
    {
        return $this->event_type;
    }

    /**
     * @param string $event_type
     * @return CancelledConversion
     */
    public function setEventType($event_type)
    {
        $this->event_type = $event_type;
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
     * @return CancelledConversion
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
     * @return CancelledConversion
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     * @return CancelledConversion
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
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
     * @return CancelledConversion
     */
    public function setEventDateTime($event_date_time)
    {
        $this->event_date_time = $event_date_time;
        return $this;
    }

}
