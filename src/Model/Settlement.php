<?php

namespace CurrencyCloud\Model;

use DateTime;

class Settlement implements EntityInterface
{

    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $shortReference;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $status;
    /**
     * @var array
     */
    private $conversionIds;
    /**
     * @var SettlementEntry[]
     */
    private $entries;
    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var DateTime
     */
    private $updatedAt;
    /**
     * @var DateTime
     */
    private $releasedAt;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortReference()
    {
        return $this->shortReference;
    }

    /**
     * @param string $shortReference
     *
     * @return $this
     */
    public function setShortReference($shortReference)
    {
        $this->shortReference = $shortReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array
     */
    public function getConversionIds()
    {
        return $this->conversionIds;
    }

    /**
     * @param array $conversionIds
     *
     * @return $this
     */
    public function setConversionIds(array $conversionIds)
    {
        $this->conversionIds = $conversionIds;
        return $this;
    }

    /**
     * @return array
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param SettlementEntry[] $entries
     *
     * @return $this
     */
    public function setEntries(array $entries)
    {
        $this->entries = $entries;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getReleasedAt()
    {
        return $this->releasedAt;
    }

    /**
     * @param DateTime $releasedAt
     *
     * @return $this
     */
    public function setReleasedAt(DateTime $releasedAt = null)
    {
        $this->releasedAt = $releasedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
