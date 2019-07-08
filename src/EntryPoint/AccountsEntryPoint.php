<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\Accounts;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\AccountPaymentChargesSetting;
use DateTime;
use stdClass;

class AccountsEntryPoint extends AbstractEntityEntryPoint
{

    /**
     * @param Account $account
     *
     * @return Account
     */
    public function create(Account $account)
    {
        return $this->doCreate('accounts/create', $account, function ($account) {
            return $this->convertAccountToRequest($account);
        }, function (stdClass $response) {
            return $this->createAccountFromResponse($response);
        });
    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     *
     * @return Account
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        return $this->doRetrieve(sprintf('accounts/%s', $id), function (stdClass $response) {
            return $this->createAccountFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param Account $account
     *
     * @return Account
     */
    public function update(Account $account)
    {
        return $this->doUpdate(sprintf('accounts/%s', $account->getId()), $account, function ($account) {
            return $this->convertAccountToRequest($account);
        }, function (stdClass $response) {
            return $this->createAccountFromResponse($response);
        });
    }

    /**
     * @param Account|null $account
     * @param Pagination|null $pagination
     *
     * @return Accounts
     */
    public function find(
        Account $account = null,
        Pagination $pagination = null
    ) {
        if (null === $account) {
            $account = new Account();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        return $this->doFind('accounts/find', $account, $pagination, function ($account) {
            return $this->convertAccountToRequest($account, true);
        }, function (stdClass $response) {
            return $this->createAccountFromResponse($response);
        }, function ($items, $pagination) {
            return new Accounts($items, $pagination);
        }, 'accounts');
    }

    /**
     * @return Account
     */
    public function current()
    {
        return $this->doRetrieve('accounts/current', function (stdClass $response) {
            return $this->createAccountFromResponse($response);
        });
    }

    /**
     * @param Account $account
     * @param bool $convertForSearch
     *
     * @return array
     */
    public function convertAccountToRequest(Account $account, $convertForSearch = false)
    {
        $common = [
            'legal_entity_type' => $account->getLegalEntityType(),
            'account_name' => $account->getAccountName(),
            'your_reference' => $account->getYourReference(),
            'status' => $account->getStatus(),
            'street' => $account->getStreet(),
            'city' => $account->getCity(),
            'state_or_province' => $account->getStateOrProvince(),
            'postal_code' => $account->getPostalCode(),
            'country' => $account->getCountry(),
            'brand' => $account->getBrand()
        ];

        if ($convertForSearch) {
            return $common;
        }

        return $common + [
            'spread_table' => $account->getSpreadTable(),
            'identification_type' => $account->getIdentificationType(),
            'identification_value' => $account->getIdentificationValue()
        ];
    }

    /**
     * @param stdClass $response
     *
     * @return Account
     */
    public function createAccountFromResponse(stdClass $response)
    {
        $account =
            (new Account())->setAccountName($response->account_name)
                ->setLegalEntityType($response->legal_entity_type)
                ->setBrand($response->brand)
                ->setYourReference($response->your_reference)
                ->setStatus($response->status)
                ->setStreet($response->street)
                ->setCity($response->city)
                ->setStateOrProvince($response->state_or_province)
                ->setCountry($response->country)
                ->setPostalCode($response->postal_code)
                ->setSpreadTable($response->spread_table)
                ->setCreatedAt(new DateTime($response->created_at))
                ->setUpdatedAt(new DateTime($response->updated_at))
                ->setIdentificationType($response->identification_type)
                ->setIdentificationValue($response->identification_value)
                ->setShortReference($response->short_reference);

        $this->setIdProperty($account, $response->id);
        return $account;
    }


    /**
     * @param string $accountId
     *
     * @return array
     */
    public function getPaymentChargesSettings($accountId)
    {
        $response = $this->request('GET',
            sprintf('accounts/%s/payment_charges_settings', $accountId));

        $paymentSettings = [];
        foreach ($response->payment_charges_settings as $setting) {
            $paymentSettings[] = new AccountPaymentChargesSetting($setting->charge_settings_id, $setting->account_id,
                $setting->charge_type, $setting->enabled, $setting->default);
        }
        return $paymentSettings;
    }

    /**
     * @param AccountPaymentChargesSetting $paymentSettings
     *
     * @return AccountPaymentChargesSetting
     */
    public function updatePaymentChargesSettings(AccountPaymentChargesSetting $paymentSettings)
    {
        $response = $this->request('POST',
            sprintf('accounts/%s/payment_charges_settings/%s', $paymentSettings->getAccountId(), $paymentSettings->getChargeSettingsId()),
            [],
            [
                'enabled' => $paymentSettings->isEnabled() ? 'true' : 'false',
                'default' => $paymentSettings->isDefault() ? 'true' : 'false'
            ]);

        return new AccountPaymentChargesSetting($response->charge_settings_id, $response->account_id,
            $response->charge_type, $response->enabled, $response->default);
    }
}
