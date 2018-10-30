<?php

use CurrencyCloud\Criteria\FindReportsCriteria;
use CurrencyCloud\Criteria\PaymentReportCriteria;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\Report;
use CurrencyCloud\Criteria\ConversionReportCriteria;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;


class Test extends BaseCurrencyCloudVCRTestCase{

    /**
     * @vcr Reports/can_create_conversion_report.yaml
     * @test
     */
    public function canCreateConversionReport()
    {

        $conversionReportCriteria = new ConversionReportCriteria();
        $conversionReportCriteria->setBuyCurrency("EUR")
            ->setSellCurrency("GBP");

        $report = $this->getAuthenticatedClient()->reports()->createConversionReport($conversionReportCriteria);

        $dummy = json_decode(
            '{"id":"ea8da492-b03d-4330-b279-b5e4a25804a0","short_reference":"RP-3256961-MLEPRN","description":"Test report for Conversion","search_params":{"buy_currency":"EUR","sell_currency":"GBP","scope":"own"},"report_type":"conversion","status":"processing","failure_reason":null,"expiration_date":null,"report_url":"","account_id":"bf5b1007-b364-43cc-b3d6-9f2d1be75297","contact_id":"ba33d76a-4a7f-4cb3-afa8-5678d5bc712a","created_at":"2018-10-25T10:16:32+00:00","updated_at":"2018-10-25T10:16:32+00:00"}',
            true
        );

        $this->assertSame($dummy['account_id'], $report->getAccountId());
        $this->assertSame($dummy['id'], $report->getId());
        $this->assertSame($dummy['short_reference'], $report->getShortReference());
    }

    /**
     * @vcr Reports/can_create_payment_report.yaml
     * @test
     */
    public function canCreatePaymentReport()
    {

        $paymentReportCriteria = new PaymentReportCriteria();
        $paymentReportCriteria->setCurrency("EUR");

        $report = $this->getAuthenticatedClient()->reports()->createPaymentReport($paymentReportCriteria);

        $dummy = json_decode(
            '{"id":"f2ec161b-5713-4d1a-953a-f6c783c622c0","short_reference":"RP-2683901-DQIJUJ","description":"Test Report for Payment","search_params":{"currency":"EUR","scope":"own"},"report_type":"payment","status":"processing","failure_reason":null,"expiration_date":null,"report_url":"","account_id":"bf5b1007-b364-43cc-b3d6-9f2d1be75297","contact_id":"ba33d76a-4a7f-4cb3-afa8-5678d5bc712a","created_at":"2018-10-26T07:29:53+00:00","updated_at":"2018-10-26T07:29:53+00:00"}',
            true
        );

        $this->assertSame($dummy['account_id'], $report->getAccountId());
        $this->assertSame($dummy['id'], $report->getId());
        $this->assertSame($dummy['short_reference'], $report->getShortReference());
    }

    /**
     * @vcr Reports/can_find_reports_requests.yaml
     * @test
     */
    public function canFindReportsRequests()
    {

        $findReportsCriteria = new FindReportsCriteria();
        $pagination = new Pagination();

        $reports = $this->getAuthenticatedClient()->reports()->findReports($findReportsCriteria, $pagination);

        $dummy = json_decode(
            '{"report_requests":[{"id":"075ce584-b977-4538-a524-16b759277d66","short_reference":"RP-5279826-KZJHNX","description":null,"search_params":{"buy_currency":"EUR","sell_currency":"GBP","scope":"own"},"report_type":"conversion","status":"completed","failure_reason":null,"expiration_date":"2018-10-18T00:00:00+00:00","report_url":"https://ccycloud-reports-prod-demo1-customer-reporting.s3.eu-west-1.amazonaws.com/customer_reporting/075ce584-b977-4538-a524-16b759277d66/conversion_report_1610201808101539677748.csv?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=somecredential&X-Amz-Date=20181026T114629Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=xyz&X-Amz-Signature=abcdef","account_id":"bf5b1007-b364-43cc-b3d6-9f2d1be75297","contact_id":"ba33d76a-4a7f-4cb3-afa8-5678d5bc712a","created_at":"2018-10-16T08:15:46+00:00","updated_at":"2018-10-16T08:15:48+00:00"},{"id":"ea8da492-b03d-4330-b279-b5e4a25804a0","short_reference":"RP-3256961-MLEPRN","description":"Test report for Conversion","search_params":{"buy_currency":"EUR","sell_currency":"GBP","scope":"own"},"report_type":"conversion","status":"completed","failure_reason":null,"expiration_date":"2018-10-27T00:00:00+00:00","report_url":"https://ccycloud-reports-prod-demo1-customer-reporting.s3.eu-west-1.amazonaws.com/customer_reporting/ea8da492-b03d-4330-b279-b5e4a25804a0/conversion_report_2510201810101540462593.csv?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=somecredential&X-Amz-Date=20181026T114629Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=xyz&X-Amz-Signature=abcdef","account_id":"bf5b1007-b364-43cc-b3d6-9f2d1be75297","contact_id":"ba33d76a-4a7f-4cb3-afa8-5678d5bc712a","created_at":"2018-10-25T10:16:32+00:00","updated_at":"2018-10-25T10:16:33+00:00"},{"id":"3301474c-a4bc-44d3-9cfb-96ab109db0a7","short_reference":"RP-8740994-YLNMNX","description":"Test Report for Conversion","search_params":{"buy_currency":"EUR","sell_currency":"GBP","scope":"own"},"report_type":"conversion","status":"completed","failure_reason":null,"expiration_date":"2018-10-27T00:00:00+00:00","report_url":"https://ccycloud-reports-prod-demo1-customer-reporting.s3.eu-west-1.amazonaws.com/customer_reporting/3301474c-a4bc-44d3-9cfb-96ab109db0a7/conversion_report_2510201810101540464044.csv?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=somecredential&X-Amz-Date=20181026T114629Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=xyz&X-Amz-Signature=abcdef","account_id":"bf5b1007-b364-43cc-b3d6-9f2d1be75297","contact_id":"ba33d76a-4a7f-4cb3-afa8-5678d5bc712a","created_at":"2018-10-25T10:40:44+00:00","updated_at":"2018-10-25T10:40:44+00:00"}],"pagination":{"total_entries":3,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":-1,"order":"created_at ASC","order_asc_desc":"asc"}}',
            true
        );

        $this->assertSame($dummy['pagination']['total_entries'], $reports->getPagination()->getTotalEntries());
        $this->assertSame($dummy['report_requests'][0]['id'], $reports->getReports()[0]->getId());
        $this->assertSame($dummy['report_requests'][0]['short_reference'], $reports->getReports()[0]->getShortReference());
        $this->assertSame($dummy['report_requests'][1]['id'], $reports->getReports()[1]->getId());
        $this->assertSame($dummy['report_requests'][1]['short_reference'], $reports->getReports()[1]->getShortReference());
        $this->assertSame($dummy['report_requests'][2]['id'], $reports->getReports()[2]->getId());
        $this->assertSame($dummy['report_requests'][2]['short_reference'], $reports->getReports()[2]->getShortReference());

        $this->assertSame($dummy['report_requests'][0]['search_params']['buy_currency'], $reports->getReports()[0]->getSearchParams()->getBuyCurrency());
        $this->assertSame($dummy['report_requests'][0]['search_params']['sell_currency'], $reports->getReports()[0]->getSearchParams()->getSellCurrency());
        $this->assertSame($dummy['report_requests'][0]['search_params']['scope'], $reports->getReports()[0]->getSearchParams()->getScope());

    }

    /**
     * @vcr Reports/can_retrieve_report.yaml
     * @test
     */
    public function canRetrieveReport()
    {
        $report = $this->getAuthenticatedClient()->reports()->retrieve("075ce584-b977-4538-a524-16b759277d66");

        $dummy = json_decode(
            '{"id":"075ce584-b977-4538-a524-16b759277d66","short_reference":"RP-5279826-KZJHNX","description":null,"search_params":{"buy_currency":"EUR","sell_currency":"GBP","scope":"own"},"report_type":"conversion","status":"completed","failure_reason":null,"expiration_date":"2018-10-18T00:00:00+00:00","report_url":"https://ccycloud-reports-prod-demo1-customer-reporting.s3.eu-west-1.amazonaws.com/customer_reporting/075ce584-b977-4538-a524-16b759277d66/conversion_report_1610201808101539677748.csv?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=somecredential&X-Amz-Date=20181026T114629Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=xyz&X-Amz-Signature=abcdef","account_id":"bf5b1007-b364-43cc-b3d6-9f2d1be75297","contact_id":"ba33d76a-4a7f-4cb3-afa8-5678d5bc712a","created_at":"2018-10-16T08:15:46+00:00","updated_at":"2018-10-16T08:15:48+00:00"}',
            true
        );

        $this->assertSame($dummy['id'], $report->getId());
        $this->assertSame($dummy['short_reference'], $report->getShortReference());

    }
}