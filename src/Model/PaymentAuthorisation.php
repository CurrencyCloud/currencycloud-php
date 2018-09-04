<?php

namespace CurrencyCloud\Model;

class PaymentAuthorisation
{

    /**
     * @var string
     */
    private $payment_id;

    /**
     * @return string
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @param string $payment_id
     * @return PaymentAuthorisation
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentStatus()
    {
        return $this->payment_status;
    }

    /**
     * @param string $payment_status
     * @return PaymentAuthorisation
     */
    public function setPaymentStatus($payment_status)
    {
        $this->payment_status = $payment_status;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUpdated()
    {
        return $this->updated;
    }

    /**
     * @param bool $updated
     * @return PaymentAuthorisation
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return PaymentAuthorisation
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthStepsTaken()
    {
        return $this->auth_steps_taken;
    }

    /**
     * @param int $auth_steps_taken
     * @return PaymentAuthorisation
     */
    public function setAuthStepsTaken($auth_steps_taken)
    {
        $this->auth_steps_taken = $auth_steps_taken;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthStepsRequired()
    {
        return $this->auth_steps_required;
    }

    /**
     * @param int $auth_steps_required
     * @return PaymentAuthorisation
     */
    public function setAuthStepsRequired($auth_steps_required)
    {
        $this->auth_steps_required = $auth_steps_required;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortReference()
    {
        return $this->short_reference;
    }

    /**
     * @param string $short_reference
     * @return PaymentAuthorisation
     */
    public function setShortReference($short_reference)
    {
        $this->short_reference = $short_reference;
        return $this;
    }

    /**
     * @var string
     */
    private $payment_status;

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
    private $auth_steps_taken;

    /**
     * @var int
     */
    private $auth_steps_required;

    /**
     * @var string
     */
    private $short_reference;

}
