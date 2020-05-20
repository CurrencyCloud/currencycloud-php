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
     */
    public function canFind()
    {

        $rates = $this->getAuthenticatedClient()->rates()->multiple(['GBPUSD', 'EURGBP']);

        $this->assertTrue($rates instanceof Rates);

        $dummy = json_decode(
            '{"rates":{"EURGBP":["0.71445","0.71508"],"GBPUSD":["1.52264","1.52334"]},"unavailable":[]}',
            true
        );
        foreach ($dummy['rates'] as $rate => $values) {
            $myRate = $rates->getRate($rate);
            $this->assertEquals($values[0], $myRate->getBidRate());
            $this->assertEquals($values[1], $myRate->getOfferRate());
        }
        $this->assertEquals(count($dummy['rates']), count($rates->getRates()));
        $this->assertEquals(count($dummy['unavailable']), count($rates->getUnavailable()));
    }

    /**
     * @vcr Rates/can_provided_detailed_rate.yaml
     * @test
     */
    public function canProvidedDetailedRate()
    {

        $detailedRate = $this->getAuthenticatedClient()->rates()->detailed('GBP', 'USD', 'buy', 10000);

        $this->assertTrue($detailedRate instanceof DetailedRate);

        $dummy = json_decode(
            '{"settlement_cut_off_time":"2015-04-29T14:00:00Z","currency_pair":"GBPUSD","client_buy_currency":"GBP","client_sell_currency":"USD","client_buy_amount":"10000.00","client_sell_amount":"15234.00","fixed_side":"buy","mid_market_rate":"1.5231","client_rate":"1.5234","partner_rate":null,"core_rate":"1.5234","deposit_required":null,"deposit_amount":"0.0","deposit_currency":"USD"}',
            true
        );
        $this->validateObjectStrictName($detailedRate, $dummy);
    }

    /**
     * @vcr Rates/can_provided_detailed_rate_with_conversion_date_preference.yaml
     * @test
     */
    public function canProvidedDetailedRateWithConversionDatePreference()
    {

        $detailedRate = $this->getAuthenticatedClient()->rates()->detailed('GBP', 'USD',
            'buy', 10000, null, null, "conversion_date_preference");

        $this->assertTrue($detailedRate instanceof DetailedRate);

        $dummy = json_decode(
            '{"settlement_cut_off_time": "2020-05-21T14:00:00Z","currency_pair": "GBPUSD","client_buy_currency": "GBP","client_sell_currency": "USD","client_buy_amount": "10000.00","client_sell_amount": "14081.00","fixed_side": "buy","client_rate": "1.4081","partner_rate": null,"core_rate": "1.4081","deposit_required": false,"deposit_amount": "0.0","deposit_currency": "USD","mid_market_rate": "1.4080"}',
            true
        );
        $this->validateObjectStrictName($detailedRate, $dummy);
    }

}
