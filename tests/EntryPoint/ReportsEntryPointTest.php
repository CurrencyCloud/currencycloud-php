<?php
namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\Criteria\ConversionReportCriteria;
use CurrencyCloud\EntryPoint\ReportsEntryPoint;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class ReportsEntryPointTest extends BaseCurrencyCloudTestCase {

    /**
     * @test
     */
    public function canCreateConversionReport(){
        $data = '{
            "id": "ea8da492-b03d-4330-b279-b5e4a25804a0",
            "short_reference": "RP-3256961-MLEPRN",
            "description": "Test report for Conversion",
            "search_params": {
                "buy_currency": "EUR",
                "sell_currency": "GBP",
                "scope": "own"
            },
            "report_type": "conversion",
            "status": "processing",
            "failure_reason": null,
            "expiration_date": null,
            "report_url": "",
            "account_id": "bf5b1007-b364-43cc-b3d6-9f2d1be75297",
            "contact_id": "ba33d76a-4a7f-4cb3-afa8-5678d5bc712a",
            "created_at": "2018-10-25T10:16:32+00:00",
            "updated_at": "2018-10-25T10:16:32+00:00"
        }';

        $reportsEntryPoint = new ReportsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
                json_decode($data),
                'POST',
                'reports/conversions/create',
                [],
                [
                    'buy_currency' => 'EUR',
                    'sell_currency' => 'GBP',
                    'scope' => null,
                    'on_behalf_of' => null,
                    'description' => null,
                    'client_buy_amount_from' => null,
                    'client_buy_amount_to' => null,
                    'client_sell_amount_from' => null,
                    'client_sell_amount_to' => null,
                    'partner_buy_amount_from' => null,
                    'partner_buy_amount_to' => null,
                    'partner_sell_amount_from' => null,
                    'partner_sell_amount_to' => null,
                    'client_status' => null,
                    'partner_status' => null,
                    'conversion_date_from' => null,
                    'conversion_date_to' => null,
                    'settlement_date_from' => null,
                    'settlement_date_to' => null,
                    'created_at_from' => null,
                    'created_at_to' => null,
                    'updated_at_from' => null,
                    'updated_at_to' => null,
                    'unique_request_id' => null
                ]
            )
        );

        $conversionReportCriteria = new ConversionReportCriteria();
        $conversionReportCriteria->setBuyCurrency("EUR")
            ->setSellCurrency("GBP");
        $report = $reportsEntryPoint->createConversionReport($conversionReportCriteria);

        $this->assertSame("ea8da492-b03d-4330-b279-b5e4a25804a0", $report->getId());
        $this->assertSame("processing", $report->getStatus());
        $this->assertSame("RP-3256961-MLEPRN", $report->getShortReference());
        $this->assertSame("conversion", $report->getReportType());
        $this->assertSame("Test report for Conversion", $report->getDescription());

    }
}