<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Account;

class AccountsEntryPoint extends AbstractEntryPoint
{

    /**
     * @param string $accountName
     * @param string $legalEntityType
     * @param string $yourReference
     * @param string $status
     * @param string $street
     * @param string $city
     * @param string $stateOrProvince
     * @param string $postalCode
     * @param string $country
     * @param string $spreadTable
     * @param string $identificationType
     * @param string $identificationValue
     */
    public function create(
        $accountName,
        $legalEntityType,
        $yourReference,
        $status,
        $street,
        $city,
        $stateOrProvince,
        $postalCode,
        $country,
        $spreadTable,
        $identificationType,
        $identificationValue
    ) {

    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     */
    public function retrieve($id, $onBehalfOf = null)
    {

    }

    /**
     * @param string $id
     * @param string $accountName
     * @param string $legalEntityType
     * @param string $yourReference
     * @param string $status
     * @param string $street
     * @param string $city
     * @param string $stateOrProvince
     * @param string $postalCode
     * @param string $country
     * @param string $spreadTable
     * @param string $identificationType
     * @param string $identificationValue
     */
    public function update(
        $id,
        $accountName,
        $legalEntityType,
        $yourReference,
        $status,
        $street,
        $city,
        $stateOrProvince,
        $postalCode,
        $country,
        $spreadTable,
        $identificationType,
        $identificationValue
    ) {

    }

    /**
     * @param string $accountName
     * @param string $brand
     * @param string $yourReference
     * @param string $status
     * @param string $street
     * @param string $city
     * @param string $stateOrProvince
     * @param string $postalCode
     * @param string $country
     * @param string $spreadTable
     * @param int $page
     * @param int $perPage
     * @param string $order
     * @param string $orderAscDesc
     */
    public function find(
        $accountName,
        $brand,
        $yourReference,
        $status,
        $street,
        $city,
        $stateOrProvince,
        $postalCode,
        $country,
        $spreadTable,
        $page,
        $perPage,
        $order,
        $orderAscDesc
    ) {

    }

    /**
     * @return Account
     */
    public function current()
    {
        return null;
    }
}
