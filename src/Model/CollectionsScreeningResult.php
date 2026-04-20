<?php

namespace CurrencyCloud\Model;

class CollectionsScreeningResult
{
    /**
     * @var string
     */
    private $reason;
    /**
     * @var bool
     */
    private $accepted;

    /**
     * @param string $reason
     * @param bool $accepted
     */
    public function __construct($reason, $accepted)
    {
        $this->reason = $reason;
        $this->accepted = $accepted;
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
