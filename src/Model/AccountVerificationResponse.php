<?php

namespace CurrencyCloud\Model;

class AccountVerificationResponse
{
    /**
     * @var string
     */
    private $answer;
    /**
     * @var string
     */
    private $actualName;
    /**
     * @var string
     */
    private $reasonCode;
    /**
     * @var string
     */
    private $reason;
    /**
     * @var string
     */
    private $reasonType;

    public function __construct($answer, $actualName, $reasonCode, $reason, $reasonType)
    {
        $this->answer = (string)$answer;
        $this->actualName = (string)$actualName;
        $this->reasonCode = (string)$reasonCode;
        $this->reason = (string)$reason;
        $this->reasonType = (string)$reasonType;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     *
     * @return $this
     */
    public function setAnswer($answer)
    {
        $this->answer = (string) $answer;
        return $this;
    }

    /**
     * @return string
     */
    public function getActualName()
    {
        return $this->actualName;
    }

    /**
     * @param string $actualName
     *
     * @return $this
     */
    public function setActualName($actualName)
    {
        $this->actualName = (string) $actualName;
        return $this;
    }

    /**
     * @return string
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * @param string $reasonCode
     *
     * @return $this
     */
    public function setReasonCode($reasonCode)
    {
        $this->reasonCode = (string) $reasonCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param string $reason
     *
     * @return $this
     */
    public function setReason($reason)
    {
        $this->reason = (string) $reason;
        return $this;
    }

   /**
     * @return string
     */
    public function getReasonType()
    {
        return $this->reasonType;
    }

    /**
     * @param string $reasonType
     *
     * @return $this
     */
    public function setReasonType($reasonType)
    {
        $this->reasonType = (string) $reasonType;
        return $this;
    }

}