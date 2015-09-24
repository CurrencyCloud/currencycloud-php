<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Balance;
use CurrencyCloud\Model\Balances;
use CurrencyCloud\Model\Pagination;
use DateTime;

class BalancesEntryPoint extends AbstractEntryPoint
{

    /**
     * @param null|double $amountFrom
     * @param null|double $amountTo
     * @param null|DateTime $asAtDate
     * @param null|int $order
     * @param null|int $page
     * @param null|int $perPage
     * @param null|string $orderAscDesc
     * @param null|string $onBehalfOf
     * @return Balances
     */
    public function find(
        $amountFrom = null,
        $amountTo = null,
        $asAtDate = null,
        $order = null,
        $page = null,
        $perPage = null,
        $orderAscDesc = null,
        $onBehalfOf = null
    ) {
        $response = $this->request('GET', 'balances/find', [
            'amount_from' => $amountFrom,
            'amount_to' => $amountTo,
            'as_at_date' => (null === $asAtDate) ? null : $asAtDate->format(DateTime::ISO8601),
            'order' => $order,
            'page' => $page,
            'per_page' => $perPage,
            'order_asc_desc' => $orderAscDesc,
            'on_behalf_of' => $onBehalfOf
        ]);
        $balances = [];
        foreach ($response->balances as $data) {
            $balances[] = Balance::createFromResponse($data);
        }
        return new Balances($balances, Pagination::createFromResponse($response->pagination));
    }

    /**
     * @param string $currency
     * @param null|string $onBehalfOf
     * @return Balance
     */
    public function retrieve($currency, $onBehalfOf = null)
    {
        $response = $this->request('GET', sprintf('balances/%s', $currency), [
            'on_behalf_of' => $onBehalfOf
        ]);

        return Balance::createFromResponse($response);
    }
}
