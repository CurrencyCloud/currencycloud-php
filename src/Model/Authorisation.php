<?php
namespace CurrencyCloud\Model;

class Authorisation {

    /**
     * @var string
     */
    private $paymentId;
    /**
     * @var string
     */
    private $paymentStatus;
    /**
     * @var bool
     */
    private $updated;
    /**
     * @var string
     */
    private $error;
    /**
     * @var int
     */
    private $authSteptsTaken;
    /**
     * @var int
     */
    private $authSteptsRequired;
    /**
     * @var string
     */
    private $shortReference;

    /**
     * Authorisation constructor.
     * @param string $paymentId
     * @param string $paymentStatus
     * @param bool $updated
     * @param string $error
     * @param int $authSteptsTaken
     * @param int $authSteptsRequired
     * @param String $shortReference
     */
    public function __construct($paymentId, $paymentStatus, $updated, $error, $authSteptsTaken, $authSteptsRequired, $shortReference)
    {
        $this->paymentId = $paymentId;
        $this->paymentStatus = $paymentStatus;
        $this->updated = $updated;
        $this->error = $error;
        $this->authSteptsTaken = $authSteptsTaken;
        $this->authSteptsRequired = $authSteptsRequired;
        $this->shortReference = $shortReference;
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
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @return bool
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return int
     */
    public function getAuthSteptsTaken()
    {
        return $this->authSteptsTaken;
    }

    /**
     * @return int
     */
    public function getAuthSteptsRequired()
    {
        return $this->authSteptsRequired;
    }

    /**
     * @return String
     */
    public function getShortReference()
    {
        return $this->shortReference;
    }

}