<?php
namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\Criteria\ConversionReportCriteria;
use CurrencyCloud\Criteria\FindReportsCriteria;
use CurrencyCloud\Criteria\PaymentReportCriteria;
use CurrencyCloud\EntryPoint\ReportsEntryPoint;
use CurrencyCloud\Model\Pagination;
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

    /**
     * @test
     */
    public function canCreatePaymentReport(){
        $data = '{
            "id": "f2ec161b-5713-4d1a-953a-f6c783c622c0",
            "short_reference": "RP-2683901-DQIJUJ",
            "description": "Test Report for Payment",
            "search_params": {
                "currency": "EUR",
                "scope": "own"
            },
            "report_type": "payment",
            "status": "processing",
            "failure_reason": null,
            "expiration_date": null,
            "report_url": "",
            "account_id": "bf5b1007-b364-43cc-b3d6-9f2d1be75297",
            "contact_id": "ba33d76a-4a7f-4cb3-afa8-5678d5bc712a",
            "created_at": "2018-10-26T07:29:53+00:00",
            "updated_at": "2018-10-26T07:29:53+00:00"
        }';

        $reportsEntryPoint = new ReportsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
                json_decode($data),
                'POST',
                'reports/payments/create',
                [],
                [
                    'on_behalf_of' => null,
                    'description' => null,
                    'currency' => 'EUR',
                    'amount_from' => null,
                    'amount_to' => null,
                    'status' => null,
                    'payment_date_from' => null,
                    'payment_date_to' => null,
                    'transfered_at_from' => null,
                    'transfered_at_to' => null,
                    'created_at_from' => null,
                    'created_at_to' => null,
                    'updated_at_from' => null,
                    'updated_at_to' => null,
                    'beneficiary_id' => null,
                    'conversion_id' => null,
                    'with_deleted' => null,
                    'payment_group_id' => null,
                    'unique_request_id' => null,
                    'scope' => null
                ]
            )
        );

        $paymentReportCriteria = new PaymentReportCriteria();
        $paymentReportCriteria->setCurrency("EUR");
        $report = $reportsEntryPoint->createPaymentReport($paymentReportCriteria);

        $this->assertSame("f2ec161b-5713-4d1a-953a-f6c783c622c0", $report->getId());
        $this->assertSame("processing", $report->getStatus());
        $this->assertSame("RP-2683901-DQIJUJ", $report->getShortReference());
        $this->assertSame("payment", $report->getReportType());
        $this->assertSame("Test Report for Payment", $report->getDescription());

    }

    /**
     * @test
     */
    public function canFindReportRequests(){
        $data = '{
            "report_requests": [
                {
                    "id": "075ce584-b977-4538-a524-16b759277d66",
                    "short_reference": "RP-5279826-KZJHNX",
                    "description": null,
                    "search_params": {
                        "buy_currency": "EUR",
                        "sell_currency": "GBP",
                        "scope": "own"
                    },
                    "report_type": "conversion",
                    "status": "completed",
                    "failure_reason": null,
                    "expiration_date": "2018-10-18T00:00:00+00:00",
                    "report_url": "https://ccycloud-reports-prod-demo1-customer-reporting.s3.eu-west-1.amazonaws.com/customer_reporting/075ce584-b977-4538-a524-16b759277d66/conversion_report_1610201808101539677748.csv?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=somecredential&X-Amz-Date=20181026T114629Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=xyz&X-Amz-Signature=abcdef",
                    "account_id": "bf5b1007-b364-43cc-b3d6-9f2d1be75297",
                    "contact_id": "ba33d76a-4a7f-4cb3-afa8-5678d5bc712a",
                    "created_at": "2018-10-16T08:15:46+00:00",
                    "updated_at": "2018-10-16T08:15:48+00:00"
                },
                {
                    "id": "ea8da492-b03d-4330-b279-b5e4a25804a0",
                    "short_reference": "RP-3256961-MLEPRN",
                    "description": "Test report for Conversion",
                    "search_params": {
                        "buy_currency": "EUR",
                        "sell_currency": "GBP",
                        "scope": "own"
                    },
                    "report_type": "conversion",
                    "status": "completed",
                    "failure_reason": null,
                    "expiration_date": "2018-10-27T00:00:00+00:00",
                    "report_url": "https://ccycloud-reports-prod-demo1-customer-reporting.s3.eu-west-1.amazonaws.com/customer_reporting/ea8da492-b03d-4330-b279-b5e4a25804a0/conversion_report_2510201810101540462593.csv?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=somecredential&X-Amz-Date=20181026T114629Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=xyz&X-Amz-Signature=abcdef",
                    "account_id": "bf5b1007-b364-43cc-b3d6-9f2d1be75297",
                    "contact_id": "ba33d76a-4a7f-4cb3-afa8-5678d5bc712a",
                    "created_at": "2018-10-25T10:16:32+00:00",
                    "updated_at": "2018-10-25T10:16:33+00:00"
                },
                {
                    "id": "3301474c-a4bc-44d3-9cfb-96ab109db0a7",
                    "short_reference": "RP-8740994-YLNMNX",
                    "description": "Test Report for Conversion",
                    "search_params": {
                        "buy_currency": "EUR",
                        "sell_currency": "GBP",
                        "scope": "own"
                    },
                    "report_type": "conversion",
                    "status": "completed",
                    "failure_reason": null,
                    "expiration_date": "2018-10-27T00:00:00+00:00",
                    "report_url": "https://ccycloud-reports-prod-demo1-customer-reporting.s3.eu-west-1.amazonaws.com/customer_reporting/3301474c-a4bc-44d3-9cfb-96ab109db0a7/conversion_report_2510201810101540464044.csv?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=somecredential&X-Amz-Date=20181026T114629Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=xyz&X-Amz-Signature=abcdef",
                    "account_id": "bf5b1007-b364-43cc-b3d6-9f2d1be75297",
                    "contact_id": "ba33d76a-4a7f-4cb3-afa8-5678d5bc712a",
                    "created_at": "2018-10-25T10:40:44+00:00",
                    "updated_at": "2018-10-25T10:40:44+00:00"
                }
            ],
            "pagination": {
                "total_entries": 3,
                "total_pages": 1,
                "current_page": 1,
                "per_page": 25,
                "previous_page": -1,
                "next_page": -1,
                "order": "created_at ASC",
                "order_asc_desc": "asc"
            }
        }';

        $reportsEntryPoint = new ReportsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'reports/report_requests/find',
            [
                'short_reference' => null,
                'description' => null,
                'created_at_from' => null,
                'created_at_to' => null,
                'expiration_date_from' => null,
                'expiration_date_to' => null,
                'status' => null,
                'report_type' => null,
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null
            ],
            []
        )
        );

        $findReportCriteria = new FindReportsCriteria();
        $pagination  = new Pagination();
        $reports = $reportsEntryPoint->findReports($findReportCriteria, $pagination);

        $this->assertSame(3, $reports->getPagination()->getTotalEntries());
        $this->assertSame("075ce584-b977-4538-a524-16b759277d66", $reports->getReports()[0]->getId());
        $this->assertSame("RP-5279826-KZJHNX", $reports->getReports()[0]->getShortReference());
        $this->assertSame("ea8da492-b03d-4330-b279-b5e4a25804a0", $reports->getReports()[1]->getId());
        $this->assertSame("RP-3256961-MLEPRN", $reports->getReports()[1]->getShortReference());
        $this->assertSame("3301474c-a4bc-44d3-9cfb-96ab109db0a7", $reports->getReports()[2]->getId());

        $this->assertSame("EUR", $reports->getReports()[0]->getSearchParams()->getBuyCurrency());
        $this->assertSame("GBP", $reports->getReports()[0]->getSearchParams()->getSellCurrency());
        $this->assertSame("own", $reports->getReports()[0]->getSearchParams()->getScope());
    }

    /**
     * @test
     */
    public function canRetrieveReport(){
        $data = '{
            "id": "075ce584-b977-4538-a524-16b759277d66",
            "short_reference": "RP-5279826-KZJHNX",
            "description": null,
            "search_params": {
                "buy_currency": "EUR",
                "sell_currency": "GBP",
                "scope": "own"
            },
            "report_type": "conversion",
            "status": "completed",
            "failure_reason": null,
            "expiration_date": "2018-10-18T00:00:00+00:00",
            "report_url": "https://ccycloud-reports-prod-demo1-customer-reporting.s3.eu-west-1.amazonaws.com/customer_reporting/075ce584-b977-4538-a524-16b759277d66/conversion_report_1610201808101539677748.csv?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=somecredential&X-Amz-Date=20181026T114629Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=xyz&X-Amz-Signature=abcdef",
            "account_id": "bf5b1007-b364-43cc-b3d6-9f2d1be75297",
            "contact_id": "ba33d76a-4a7f-4cb3-afa8-5678d5bc712a",
            "created_at": "2018-10-16T08:15:46+00:00",
            "updated_at": "2018-10-16T08:15:48+00:00"
        }';

        $reportsEntryPoint = new ReportsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'reports/report_requests/075ce584-b977-4538-a524-16b759277d66',
            ['on_behalf_of' => null],
            []
        )
        );

        $report = $reportsEntryPoint->retrieve("075ce584-b977-4538-a524-16b759277d66");

        $this->assertSame("075ce584-b977-4538-a524-16b759277d66", $report->getId());
        $this->assertSame("RP-5279826-KZJHNX", $report->getShortReference());
        $this->assertSame("completed", $report->getStatus());

    }
}