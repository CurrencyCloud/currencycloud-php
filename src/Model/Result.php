<?php

namespace CurrencyCloud\Model;

class Result
{

    /**
     * @var bool
     */
    private $accepted;

    /**
     * @var string
     */
    private $reason;

    /**
     * @param bool $accepted
     * @param string $reason
     */
    public function __construct($accepted, $reason)
    {
        $this->accepted = $accepted;
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return bool
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

}