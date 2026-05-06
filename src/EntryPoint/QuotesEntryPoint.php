<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\HeldRateQuote;
use DateTime;
use stdClass;

class QuotesEntryPoint extends AbstractEntryPoint
{

    /**
     * @param string $buyCurrency
     * @param string $sellCurrency
     * @param string $fixedSide
     * @param string $amount
     * @param string $holdPeriod
     * @param string|null $conversionDate
     * @param string|null $conversionDatePreference
     * @param string|null $onBehalfOf
     *
     * @return HeldRateQuote
     */
    public function create(
        $buyCurrency,
        $sellCurrency,
        $fixedSide,
        $amount,
        $holdPeriod,
        $conversionDate = null,
        $conversionDatePreference = null,
        $onBehalfOf = null
    )
    {
        $response = $this->request(
            'POST',
            'quotes/create',
            [],
            [
                'buy_currency' => $buyCurrency,
                'sell_currency' => $sellCurrency,
                'fixed_side' => $fixedSide,
                'amount' => $amount,
                'hold_period' => $holdPeriod,
                'conversion_date' => $conversionDate,
                'conversion_date_preference' => $conversionDatePreference,
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createHeldRateQuoteFromResponse($response);
    }

    /**
     * @param stdClass $response
     *
     * @return HeldRateQuote
     */
    private function createHeldRateQuoteFromResponse(stdClass $response)
    {
        $quote = new HeldRateQuote();
        $quote->setBuyCurrency($response->buy_currency)
            ->setClientBuyAmount($response->client_buy_amount)
            ->setClientRate($response->client_rate)
            ->setClientSellAmount($response->client_sell_amount)
            ->setCoreRate($response->core_rate)
            ->setCreatedAt(new DateTime($response->created_at))
            ->setCurrencyPair($response->currency_pair)
            ->setDepositAmount($response->deposit_amount)
            ->setDepositCurrency($response->deposit_currency)
            ->setDepositRequired($response->deposit_required)
            ->setExpiresAt(new DateTime($response->expires_at))
            ->setFixedSide($response->fixed_side)
            ->setMidMarketRate($response->mid_market_rate)
            ->setPartnerBuyAmount($response->partner_buy_amount)
            ->setPartnerRate($response->partner_rate)
            ->setPartnerSellAmount($response->partner_sell_amount)
            ->setQuoteId($response->quote_id)
            ->setSellCurrency($response->sell_currency)
            ->setSettlementCutOffTime(new DateTime($response->settlement_cut_off_time));

        return $quote;
    }
}
