<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Balance;
use CurrencyCloud\Model\Balances;
use DateTime;
use stdClass;

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
            $balances[] = $this->createBalanceFromResponse($data);
        }
        return new Balances($balances, $this->createPaginatedDataFromResponse($response));
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

        return $this->createBalanceFromResponse($response);
    }

    /**
     * @param stdClass $data
     * @return Balance
     */
    protected function createBalanceFromResponse(stdClass $data)
    {
        return new Balance(
            $data->id,
            $data->account_id,
            $data->currency,
            $data->amount,
            $data->created_at,
            $data->updated_at
        );
    }
}
