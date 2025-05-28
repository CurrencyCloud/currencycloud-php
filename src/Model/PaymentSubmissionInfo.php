<?php
namespace CurrencyCloud\Model;

class PaymentSubmissionInfo {

    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $message;
    /**
     * @var string
     */

     private $format;
     /**
      * @var string
      */
    private $submission_ref;

    /**
     * PaymentSubmission constructor.
     * @param string $status
     * @param string $message
     * @param string $format
     * @param string $submission_ref
     */
    public function __construct($status, $message, $format, $submission_ref)
    {
        $this->status = $status;
        $this->message = $message;
        $this->format = $format;
        $this->submission_ref = $submission_ref;
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getSubmissionRef()
    {
        return $this->submission_ref;
    }

}