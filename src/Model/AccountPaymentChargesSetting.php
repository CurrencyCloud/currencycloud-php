<?php

namespace CurrencyCloud\Model;


class AccountPaymentChargesSetting
{
    /**
    * @var string
    */
    private $chargeSettingsId;

    /**
    * @var string
    */
    private $accountId;

    /**
    * @var string
    */
    private $chargeType;

    /**
    * @var bool
    */
    private $enabled;

    /**
    * @var bool
    */
    private $default;

    /**
     * @param string $chargeSettingsId
     * @param string $accountId
     * @param string $chargeType
     * @param bool $enabled
     * @param bool $default
     */
    public function __construct(string $chargeSettingsId, string $accountId, string $chargeType, bool $enabled, bool $default)
    {
        $this->chargeSettingsId = $chargeSettingsId;
        $this->accountId = $accountId;
        $this->chargeType = $chargeType;
        $this->enabled = $enabled;
        $this->default = $default;
    }

    /**
     * @return string
     */
    public function getChargeSettingsId()
    {
        return $this->chargeSettingsId;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getChargeType()
    {
        return $this->chargeType;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }

}