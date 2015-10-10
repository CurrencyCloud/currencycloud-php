<?php

namespace CurrencyCloud\Criteria;

use DateTime;

class FindSettlementsCriteria
{

    /**
     * @var DateTime|null
     */
    private $createdAtFrom;
    /**
     * @var DateTime|null
     */
    private $createdAtTo;
    /**
     * @var DateTime|null
     */
    private $updatedAtFrom;
    /**
     * @var DateTime|null
     */
    private $updatedAtTo;
    /**
     * @var DateTime|null
     */
    private $releasedAtFrom;
    /**
     * @var DateTime|null
     */
    private $releasedAtTo;

    /**
     * @return DateTime|null
     */
    public function getCreatedAtFrom()
    {
        return $this->createdAtFrom;
    }

    /**
     * @param DateTime $createdAtFrom
     *
     * @return $this
     */
    public function setCreatedAtFrom(DateTime $createdAtFrom)
    {
        $this->createdAtFrom = $createdAtFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAtTo()
    {
        return $this->createdAtTo;
    }

    /**
     * @param DateTime $createdAtTo
     *
     * @return $this
     */
    public function setCreatedAtTo(DateTime $createdAtTo)
    {
        $this->createdAtTo = $createdAtTo;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAtFrom()
    {
        return $this->updatedAtFrom;
    }

    /**
     * @param DateTime $updatedAtFrom
     *
     * @return $this
     */
    public function setUpdatedAtFrom(DateTime $updatedAtFrom)
    {
        $this->updatedAtFrom = $updatedAtFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAtTo()
    {
        return $this->updatedAtTo;
    }

    /**
     * @param DateTime $updatedAtTo
     *
     * @return $this
     */
    public function setUpdatedAtTo(DateTime $updatedAtTo)
    {
        $this->updatedAtTo = $updatedAtTo;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getReleasedAtFrom()
    {
        return $this->releasedAtFrom;
    }

    /**
     * @param DateTime $releasedAtFrom
     *
     * @return $this
     */
    public function setReleasedAtFrom(DateTime$releasedAtFrom)
    {
        $this->releasedAtFrom = $releasedAtFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getReleasedAtTo()
    {
        return $this->releasedAtTo;
    }

    /**
     * @param DateTime $releasedAtTo
     *
     * @return $this
     */
    public function setReleasedAtTo(DateTime$releasedAtTo)
    {
        $this->releasedAtTo = $releasedAtTo;
        return $this;
    }
}
