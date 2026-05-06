<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\QuotesEntryPoint;
use CurrencyCloud\Model\HeldRateQuote;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class QuotesEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canCreateQuote()
    {
        $data = '{
            "buy_currency": "USD",
            "client_buy_amount": "118.56",
            "client_rate": "1.1856",
            "client_sell_amount": "100.0",
            "core_rate": "1.1858",
            "created_at": "2025-08-11T08:10:21Z",
            "currency_pair": "EURUSD",
            "deposit_amount": "0.0",
            "deposit_currency": "EUR",
            "deposit_required": "false",
            "expires_at": "2025-08-11T08:15:21Z",
            "fixed_side": "sell",
            "mid_market_rate": "1.0146",
            "partner_buy_amount": "118.56",
            "partner_rate": "1.1856",
            "partner_sell_amount": "100.0",
            "quote_id": "3c25ce4a-3552-45bb-869e-406c795052aa",
            "sell_currency": "EUR",
            "settlement_cut_off_time": "2025-08-13T15:30:00Z"
        }';

        $entryPoint = new QuotesEntryPoint($this->getMockedClient(
            json_decode($data),
            'POST',
            'quotes/create',
            [],
            [
                'buy_currency' => 'USD',
                'sell_currency' => 'EUR',
                'fixed_side' => 'sell',
                'amount' => '100.0',
                'hold_period' => '30s',
                'conversion_date' => null,
                'conversion_date_preference' => null,
                'on_behalf_of' => null
            ]
        ));

        $quote = $entryPoint->create('USD', 'EUR', 'sell', '100.0', '30s');

        $this->assertInstanceOf(HeldRateQuote::class, $quote);
        $this->assertSame('USD', $quote->getBuyCurrency());
        $this->assertSame('EUR', $quote->getSellCurrency());
        $this->assertSame('sell', $quote->getFixedSide());
        $this->assertSame('118.56', $quote->getClientBuyAmount());
        $this->assertSame('100.0', $quote->getClientSellAmount());
        $this->assertSame('1.1856', $quote->getClientRate());
        $this->assertSame('3c25ce4a-3552-45bb-869e-406c795052aa', $quote->getQuoteId());
        $this->assertInstanceOf(DateTime::class, $quote->getCreatedAt());
        $this->assertInstanceOf(DateTime::class, $quote->getExpiresAt());
        $this->assertInstanceOf(DateTime::class, $quote->getSettlementCutOffTime());
        $this->assertSame('2025-08-11T08:10:21+00:00', $quote->getCreatedAt()->format(DateTime::RFC3339));
        $this->assertSame('2025-08-11T08:15:21+00:00', $quote->getExpiresAt()->format(DateTime::RFC3339));
    }

    /**
     * @test
     */
    public function canCreateQuoteWithConversionDatePreference()
    {
        $data = '{
            "buy_currency": "USD",
            "client_buy_amount": "118.56",
            "client_rate": "1.1856",
            "client_sell_amount": "100.0",
            "core_rate": "1.1858",
            "created_at": "2025-08-11T08:10:21Z",
            "currency_pair": "EURUSD",
            "deposit_amount": "0.0",
            "deposit_currency": "EUR",
            "deposit_required": "false",
            "expires_at": "2025-08-11T08:15:21Z",
            "fixed_side": "sell",
            "mid_market_rate": "1.0146",
            "partner_buy_amount": "118.56",
            "partner_rate": "1.1856",
            "partner_sell_amount": "100.0",
            "quote_id": "3c25ce4a-3552-45bb-869e-406c795052aa",
            "sell_currency": "EUR",
            "settlement_cut_off_time": "2025-08-13T15:30:00Z"
        }';

        $entryPoint = new QuotesEntryPoint($this->getMockedClient(
            json_decode($data),
            'POST',
            'quotes/create',
            [],
            [
                'buy_currency' => 'USD',
                'sell_currency' => 'EUR',
                'fixed_side' => 'sell',
                'amount' => '100.0',
                'hold_period' => '3m',
                'conversion_date' => null,
                'conversion_date_preference' => 'earliest',
                'on_behalf_of' => null
            ]
        ));

        $quote = $entryPoint->create('USD', 'EUR', 'sell', '100.0', '3m', null, 'earliest');

        $this->assertInstanceOf(HeldRateQuote::class, $quote);
        $this->assertSame('3c25ce4a-3552-45bb-869e-406c795052aa', $quote->getQuoteId());
    }
}
