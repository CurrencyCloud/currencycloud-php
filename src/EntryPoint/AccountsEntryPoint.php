<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\Accounts;
use stdClass;

class AccountsEntryPoint extends AbstractEntryPoint
{

    /**
     * @param string $accountName
     * @param string $legalEntityType
     * @param string|null $yourReference
     * @param string|null $status
     * @param string|null $street
     * @param string|null $city
     * @param string|null $stateOrProvince
     * @param string|null $postalCode
     * @param string|null $country
     * @param string|null $spreadTable
     * @param string|null $identificationType
     * @param string|null $identificationValue
     * @return Account
     */
    public function create(
        $accountName,
        $legalEntityType,
        $yourReference = null,
        $status = null,
        $street = null,
        $city = null,
        $stateOrProvince = null,
        $postalCode = null,
        $country = null,
        $spreadTable = null,
        $identificationType = null,
        $identificationValue = null
    ) {
        $response = $this->request('POST', 'accounts/create', [], [
            'account_name' => $accountName,
            'legal_entity_type' => $legalEntityType,
            'your_reference' => $yourReference,
            'status' => $status,
            'street' => $street,
            'city' => $city,
            'state_or_province' => $stateOrProvince,
            'postal_code' => $postalCode,
            'country' => $country,
            'spread_table' => $spreadTable,
            'identification_type' => $identificationType,
            'identification_value' => $identificationValue
        ]);

        return $this->createAccountFromResponse($response);
    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     * @return Account
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        $response = $this->request('GET', sprintf('accounts/%s', $id), [
            'on_behalf_of' => $onBehalfOf
        ]);

        return $this->createAccountFromResponse($response);
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
     * @return Account
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
        $response = $this->request('POST', sprintf('accounts/%s', $id), [], [
            'account_name' => $accountName,
            'legal_entity_type' => $legalEntityType,
            'your_reference' => $yourReference,
            'status' => $status,
            'street' => $street,
            'city' => $city,
            'state_or_province' => $stateOrProvince,
            'postal_code' => $postalCode,
            'country' => $country,
            'spread_table' => $spreadTable,
            'identification_type' => $identificationType,
            'identification_value' => $identificationValue
        ]);

        return $this->createAccountFromResponse($response);
    }

    /**
     * @param string|null $accountName
     * @param string|null $brand
     * @param string|null $yourReference
     * @param string|null $status
     * @param string|null $street
     * @param string|null $city
     * @param string|null $stateOrProvince
     * @param string|null $postalCode
     * @param string|null $country
     * @param string|null $spreadTable
     * @param int|null $page
     * @param int|null $perPage
     * @param string|null $order
     * @param string|null $orderAscDesc
     * @return Accounts
     */
    public function find(
        $accountName = null,
        $brand = null,
        $yourReference = null,
        $status = null,
        $street = null,
        $city = null,
        $stateOrProvince = null,
        $postalCode = null,
        $country = null,
        $spreadTable = null,
        $page = null,
        $perPage = null,
        $order = null,
        $orderAscDesc = null
    ) {
        $response = $this->request('GET', 'accounts/find', [
            'account_name' => $accountName,
            'brand' => $brand,
            'your_reference' => $yourReference,
            'status' => $status,
            'street' => $street,
            'city' => $city,
            'state_or_province' => $stateOrProvince,
            'postal_code' => $postalCode,
            'country' => $country,
            'spread_Table' => $spreadTable,
            'page' => $page,
            'per_page' => $perPage,
            'order' => $order,
            'order_asc_desc' => $orderAscDesc
        ]);
        $accounts = [];
        foreach ($response->accounts as $data) {
            $accounts[] = $this->createAccountFromResponse($data);
        }
        return new Accounts($accounts, $this->createPaginatedDataFromResponse($response));
    }

    /**
     * @return Account
     */
    public function current()
    {
        $response = $this->request('GET', 'accounts/current');

        return $this->createAccountFromResponse($response);
    }

    /**
     * @param stdClass $data
     * @return Account
     */
    protected function createAccountFromResponse(stdClass $data)
    {
        return new Account(
            $data->id,
            $data->legal_entity_type,
            $data->account_name,
            $data->brand,
            $data->your_reference,
            $data->status,
            $data->street,
            $data->city,
            $data->state_or_province,
            $data->country,
            $data->postal_code,
            $data->spread_table,
            $data->created_at,
            $data->updated_at,
            $data->identification_type,
            $data->identification_value,
            $data->short_reference
        );
    }
}
