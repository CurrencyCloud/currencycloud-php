<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\DetailedRate;
use CurrencyCloud\Model\Rate;
use CurrencyCloud\Model\Rates;
use DateTime;
use stdClass;

class RatesEntryPoint extends AbstractEntryPoint
{

    /**
     * @param string|array $currencyPairs
     * @param bool $ignoreInvalidPairs
     * @param null|string $onBehalfOf
     * @return Rates
     */
    public function multiple($currencyPairs, $ignoreInvalidPairs = true, $onBehalfOf = null)
    {
        if (!is_array($currencyPairs)) {
            $currencyPairs = [$currencyPairs];
        }
        $response = $this->request('GET', 'rates/find', [
            'currency_pair' => implode(',', $currencyPairs),
            'ignore_invalid_pairs' => $ignoreInvalidPairs ? 'true' : 'false',
            'on_behalf_of' => $onBehalfOf
        ]);
        $pairs = [];
        foreach ($response->rates as $pair => $data) {
            $pairs[$pair] = $this->createRateFromResponse($data);
        }
        return new Rates($pairs, $response->unavailable);
    }

    /**
     * @param string $buyCurrency
     * @param string $sellCurrency
     * @param string $fixedSide
     * @param string $amount
     * @param DateTime|null $conversionDate
     * @param null|string $onBehalfOf
     * @return DetailedRate
     */
    public function detailed(
        $buyCurrency,
        $sellCurrency,
        $fixedSide,
        $amount,
        DateTime $conversionDate = null,
        $onBehalfOf = null
    ) {
        $response = $this->request('GET', 'rates/detailed', [
            'buy_currency' => $buyCurrency,
            'sell_currency' => $sellCurrency,
            'fixed_side' => $fixedSide,
            'amount' => $amount,
            'conversion_date' => (null === $conversionDate) ? null : $conversionDate->format(DateTime::ISO8601),
            'on_behalf_of' => $onBehalfOf
        ]);
        return $this->createDetailedRateFromResponse($response);
    }

    /**
     * @param array $data
     * @return Rate
     */
    private function createRateFromResponse(array $data)
    {
        return new Rate($data[0], $data[1]);
    }

    /**
     * @param stdClass $response
     * @return DetailedRate
     */
    protected function createDetailedRateFromResponse(stdClass $response)
    {
        return new DetailedRate(
            $response->settlement_cut_off_time,
            $response->currency_pair,
            $response->client_buy_currency,
            $response->client_sell_currency,
            $response->client_buy_amount,
            $response->client_sell_amount,
            $response->fixed_side,
            $response->mid_market_rate,
            $response->core_rate,
            $response->partner_rate,
            $response->client_rate,
            $response->deposit_required,
            $response->deposit_amount,
            $response->deposit_currency
        );
    }
}
