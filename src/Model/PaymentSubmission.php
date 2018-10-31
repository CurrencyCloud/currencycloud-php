<?php
namespace CurrencyCloud\Model;

class PaymentSubmission {

    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $mt103;
    /**
     * @var string
     */
    private $submission_ref;

    /**
     * PaymentSubmission constructor.
     * @param string $status
     * @param string $mt103
     * @param string $submission_ref
     */
    public function __construct($status, $mt103, $submission_ref)
    {
        $this->status = $status;
        $this->mt103 = $mt103;
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
    public function getMt103()
    {
        return $this->mt103;
    }

    /**
     * @return string
     */
    public function getSubmissionRef()
    {
        return $this->submission_ref;
    }

}