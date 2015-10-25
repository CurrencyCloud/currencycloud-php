<?php

namespace CurrencyCloud\Tests\VCR\Settlements;

use CurrencyCloud\Model\Conversion;
use CurrencyCloud\Model\SettlementEntry;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class Test extends BaseCurrencyCloudTestCase
{

    /**
     * @vcr Settlements/can_add_conversion.yaml
     * @test
     */
    public function canAddConversion()
    {
        $client = $this->getAuthenticatedClient();

        $conversion =
            $client->conversions()
                ->create(Conversion::create('GBP', 'USD', 'buy'), '1000', 'mortgage payment', true);

        $dummy = json_decode(
            '{"id":"24d2ee7f-c7a3-4181-979e-9c58dbace992","settlement_date":"2015-05-06T14:00:00+00:00","conversion_date":"2015-05-06T00:00:00+00:00","short_reference":"20150504-PGRNVJ","creator_contact_id":"c4d838e8-1625-44c6-a9fb-39bcb1fe353d","account_id":"8ec3a69b-02d1-4f09-9a6b-6bd54a61b3a8","currency_pair":"GBPUSD","status":"awaiting_funds","buy_currency":"GBP","sell_currency":"USD","client_buy_amount":"1000.00","client_sell_amount":"1511.70","fixed_side":"buy","mid_market_rate":"1.5118","core_rate":"1.5117","partner_rate":"","partner_status":"funds_arrived","partner_buy_amount":"0.00","partner_sell_amount":"0.00","client_rate":"1.5117","deposit_required":false,"deposit_amount":"0.00","deposit_currency":"","deposit_status":"not_required","deposit_required_at":"","payment_ids":[],"created_at":"2015-05-04T20:28:29+00:00","updated_at":"2015-05-04T20:28:29+00:00"}',
            true
        );

        $this->validateObjectStrictName($conversion, $dummy);

        $settlement = $client->settlements()->create();

        $dummy = json_decode(
            '{"id":"63eeef54-3531-4e65-827a-7d0f37503fcc","status":"open","short_reference":"20150504-RKNNBH","type":"bulk","conversion_ids":[],"entries":[],"created_at":"2015-05-04T20:29:16+00:00","updated_at":"2015-05-04T20:29:16+00:00","released_at":""}',
            true
        );

        $this->validateObjectStrictName($settlement, $dummy);

        $settlement = $client->settlements()->addConversion($settlement->getId(), $conversion->getId());

        $dummy = json_decode(
            '{"id":"63eeef54-3531-4e65-827a-7d0f37503fcc","status":"open","short_reference":"20150504-RKNNBH","type":"bulk","conversion_ids":["24d2ee7f-c7a3-4181-979e-9c58dbace992"],"entries":[{"GBP":{"receive_amount":"1000.00","send_amount":"0.00"}},{"USD":{"receive_amount":"0.00","send_amount":"1511.70"}}],"created_at":"2015-05-04T20:29:16+00:00","updated_at":"2015-05-04T20:40:56+00:00","released_at":""}',
            true
        );

        $dummy['entries'] = [
            'GBP' => new SettlementEntry('0.00', '1000.00'),
            'USD' => new SettlementEntry('1511.70', '0.00')
        ];

        $this->validateObjectStrictName($settlement, $dummy);
    }

    /**
     * @vcr Settlements/can_release.yaml
     * @test
     */
    public function canRelease()
    {
        $client = $this->getAuthenticatedClient();

        $settlement =
            $client->settlements()->release('51c619e0-0256-40ad-afba-ca4114b936f9');

        $dummy = json_decode(
            '{"id":"51c619e0-0256-40ad-afba-ca4114b936f9","status":"released","short_reference":"20150504-SHKTFD","type":"bulk","conversion_ids":["9bb4a49b-f959-402f-8bb8-4463b18d93c7"],"entries":{"USD":{"receive_amount":"0.00","send_amount":"1512.00"},"GBP":{"receive_amount":"1000.00","send_amount":"0.00"}},"created_at":"2015-05-04T21:14:48+00:00","updated_at":"2015-05-04T21:44:23+00:00","released_at":"2015-05-04T21:44:23+00:00"}',
            true
        );

        $dummy['entries'] = [
            'GBP' => new SettlementEntry('0.00', '1000.00'),
            'USD' => new SettlementEntry('1512.00', '0.00')
        ];

        $this->validateObjectStrictName($settlement, $dummy);
    }

}
