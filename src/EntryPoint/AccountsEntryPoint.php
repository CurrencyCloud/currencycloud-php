<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\Accounts;
use CurrencyCloud\Model\Pagination;
use stdClass;

class AccountsEntryPoint extends AbstractEntryPoint
{

    /**
     * @param Account $account
     * @return Account
     */
    public function persist(Account $account)
    {
        if (null === $account->getId()) {
            return $this->create($account);
        }
        return $this->update($account);
    }

    /**
     * @param Account $account
     * @return Account
     */
    public function create(Account $account) {
        $response = $this->request('POST', 'accounts/create', [], $this->convertAccountToRequest($account));

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
     * @@param Account $account
     * @return Account
     */
    public function update(Account $account) {
        $response = $this->request('POST', sprintf(
            'accounts/%s',
            $account->getId()
        ), [], $this->convertAccountToRequest($account));

        return $this->createAccountFromResponse($response);
    }

    /**
     * @param Account|null $account
     * @param Pagination|null $pagination
     * @return Accounts
     */
    public function find(
        Account $account = null,
        Pagination $pagination = null
    ) {
        if (null === $account) {
            $account = Account::create();
        }
        if (null === $pagination) {
            $pagination = Pagination::create();
        }
        $response = $this->request(
            'GET',
            'accounts/find',
            $this->convertAccountToRequest($account, true) + $this->convertPaginationToRequest($pagination)
        );
        $accounts = [];
        foreach ($response->accounts as $data) {
            $accounts[] = $this->createAccountFromResponse($data);
        }
        return new Accounts($accounts, $this->createPaginationFromResponse($response));
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
     * @param Account $account
     * @param bool $convertForSearch
     * @return array
     */
    public function convertAccountToRequest(Account $account, $convertForSearch = false)
    {
        $common = [
            'account_name' => $account->getAccountName(),
            'your_reference' => $account->getYourReference(),
            'status' => $account->getStatus(),
            'street' => $account->getStreet(),
            'city' => $account->getCity(),
            'state_or_province' => $account->getStateOrProvince(),
            'postal_code' => $account->getPostalCode(),
            'country' => $account->getCountry()
        ];

        if ($convertForSearch) {
            return $common + [
                'brand' => $account->getBrand()
            ];
        }

        return $common + [
            'id' => $account->getId(),
            'spread_table' => $account->getSpreadTable(),
            'identification_type' => $account->getIdentificationType(),
            'identification_value' => $account->getIdentificationValue()
        ];
    }


    /**
     * @param stdClass $response
     * @return Account
     */
    public function createAccountFromResponse(stdClass $response)
    {
        $account = new Account(
            $response->account_name,
            $response->legal_entity_type,
            $response->brand,
            $response->your_reference,
            $response->status,
            $response->street,
            $response->city,
            $response->state_or_province,
            $response->country,
            $response->postal_code,
            $response->spread_table,
            $response->created_at,
            $response->updated_at,
            $response->identification_type,
            $response->identification_value,
            $response->short_reference
        );
        $this->setIdProperty($account, $response->id);
        return $account;
    }
}
