<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Balance;
use CurrencyCloud\Model\Balances;
use CurrencyCloud\Model\Pagination;
use DateTime;
use stdClass;

class BalancesEntryPoint extends AbstractEntryPoint
{

    /**
     * @param null|double $amountFrom
     * @param null|double $amountTo
     * @param null|DateTime $asAtDate
     * @param Pagination|null $pagination
     * @param null|string $onBehalfOf
     *
     * @return Balances
     */
    public function find(
        $amountFrom = null,
        $amountTo = null,
        $asAtDate = null,
        Pagination $pagination = null,
        $onBehalfOf = null
    ) {
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        $response = $this->request(
            'GET',
            'balances/find',
            [
                'amount_from' => $amountFrom,
                'amount_to' => $amountTo,
                'as_at_date' => (null === $asAtDate) ? null : $asAtDate->format(DateTime::RFC3339),
                'order' => $pagination->getOrder(),
                'page' => $pagination->getCurrentPage(),
                'per_page' => $pagination->getPerPage(),
                'order_asc_desc' => $pagination->getOrderAscDesc(),
                'on_behalf_of' => $onBehalfOf
            ]
        );
        $balances = [];
        foreach ($response->balances as $data) {
            $balances[] = $this->createBalanceFromResponse($data);
        }
        return new Balances($balances, $this->createPaginationFromResponse($response));
    }

    /**
     * @param string $currency
     * @param null|string $onBehalfOf
     *
     * @return Balance
     */
    public function retrieve($currency, $onBehalfOf = null)
    {
        $response = $this->request(
            'GET',
            sprintf('balances/%s', $currency),
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createBalanceFromResponse($response);
    }

    /**
     * @param stdClass $response
     *
     * @return Balance
     */
    public function createBalanceFromResponse(stdClass $response)
    {
        $balance = new Balance(
            $response->account_id,
            $response->currency,
            $response->amount,
            new DateTime($response->created_at),
            new DateTime($response->updated_at)
        );
        $this->setIdProperty($balance, $response->id);
        return $balance;
    }
}
