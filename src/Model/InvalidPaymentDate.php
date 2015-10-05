<?php

namespace CurrencyCloud\Model;

use DateTime;

class InvalidPaymentDate
{

    /**
     * @var DateTime
     */
    private $date;
    /**
     * @var string
     */
    private $description;

    /**
     * @param DateTime $date
     * @param string $description
     */
    public function __construct(DateTime $date, $description)
    {
        $this->date = $date;
        $this->description = (string) $description;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
