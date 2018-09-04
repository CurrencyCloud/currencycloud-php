<?php

namespace CurrencyCloud\Tests\VCR\Rates;

use CurrencyCloud\Model\DetailedRate;
use CurrencyCloud\Model\Rates;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase
{
    /**
     * @vcr Rates/can_find.yaml
     * @test
     * @description performs a basic rates API call and asserts
     * that we have the correct paramaters returned in the Response.
     */
    public function canFind()
    {
        // config
        $currencyPairs = array('GBPUSD', 'EURGBP');

        $rates = $this->getAuthenticatedClient()->rates()->multiple($currencyPairs);

        // expected response from API:
        //{"rates":{"EURGBP":["0.71445","0.71508"],"GBPUSD":["1.52264","1.52334"]},"unavailable":[]}

        // assert we have an object
        $this->assertTrue($rates instanceof Rates);

        // check that we have 2 currency rates returned
        $this->assertEquals(count($rates->getRates()), 2);
        // check we have GBPUSD rate returned
        $this->assertArrayHasKey($currencyPairs[0], $rates->getRates());
        // check we have EURGBP rate returned
        $this->assertArrayHasKey($currencyPairs[1], $rates->getRates());
        // check unavailable currencies count equals zero
        $this->assertEquals(count($rates->getUnavailable()), 0);
    }

    /**
     * @vcr Rates/can_provided_detailed_rate.yaml
     * @test
     * @description performs a detailed rates API call and asserts
     * that we have the correct paramaters returned in the Response.
     */
    public function canProvidedDetailedRate()
    {
        // config
        $buyCurrency  = 'GBP';
        $sellCurrency = 'EUR';
        $fixedSide    = 'buy';
        $value        = 1000;

        $detailedRate = $this->getAuthenticatedClient()->rates()->detailed($buyCurrency, $sellCurrency, $fixedSide, $value);

        // expected response from API:
        // {"settlement_cut_off_time":"2018-07-31T13:00:00Z","currency_pair":"EURGBP","client_buy_currency":"GBP","client_sell_currency":"EUR","client_buy_amount":"1000.00","client_sell_amount":"1244.56","fixed_side":"buy","client_rate":"0.8035","partner_rate":null,"core_rate":"0.8035","deposit_required":false,"deposit_amount":"0.0","deposit_currency":"EUR","mid_market_rate":"0.8036"}

        // assert we have an object
        $this->assertTrue($detailedRate instanceof DetailedRate);
        // check that the currency_pair match what we sent
        $this->assertEquals($sellCurrency.$buyCurrency, $detailedRate->getCurrencyPair());
        // check we have the buy currency set correctly
        $this->assertEquals($buyCurrency, $detailedRate->getClientBuyCurrency());
        // check we have the sell currency set correctly
        $this->assertEquals($sellCurrency, $detailedRate->getClientSellCurrency());
        // check we have the fixed side set correctly
        $this->assertEquals($fixedSide, $detailedRate->getFixedSide());

    }
}
