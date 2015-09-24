<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\Accounts;
use CurrencyCloud\Model\Pagination;

class AccountsEntryPoint extends AbstractEntryPoint
{

    /**
     * @param Account $account
     * @return Account
     */
    public function create(Account $account) {
        $response = $this->request('POST', 'accounts/create', [], Account::convertToRequest($account));

        return Account::createFromResponse($response);
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

        return Account::createFromResponse($response);
    }

    /**
     * @@param Account $account
     * @return Account
     */
    public function update(Account $account) {
        $response = $this->request('POST', sprintf(
            'accounts/%s',
            $account->getId()
        ), [], Account::convertToRequest($account));

        return Account::createFromResponse($response);
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
            $accounts[] = Account::createFromResponse($data);
        }
        return new Accounts($accounts, Pagination::createFromResponse($response->pagination));
    }

    /**
     * @return Account
     */
    public function current()
    {
        $response = $this->request('GET', 'accounts/current');

        return Account::createFromResponse($response);
    }
}
