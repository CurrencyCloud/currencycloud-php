<?php
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

        $paymentReportCriteria = new ConversionReportCriteria();
        $paymentReportCriteria->setBuyCurrency("EUR");

        $report = $this->getAuthenticatedClient()->reports()->createConversionReport($paymentReportCriteria);

        $dummy = json_decode(
            '{"id":"f2ec161b-5713-4d1a-953a-f6c783c622c0","short_reference":"RP-2683901-DQIJUJ","description":"Test Report for Payment","search_params":{"currency":"EUR","scope":"own"},"report_type":"payment","status":"processing","failure_reason":null,"expiration_date":null,"report_url":"","account_id":"bf5b1007-b364-43cc-b3d6-9f2d1be75297","contact_id":"ba33d76a-4a7f-4cb3-afa8-5678d5bc712a","created_at":"2018-10-26T07:29:53+00:00","updated_at":"2018-10-26T07:29:53+00:00"}',
            true
        );

        $this->assertSame($dummy['account_id'], $report->getAccountId());
        $this->assertSame($dummy['id'], $report->getId());
        $this->assertSame($dummy['short_reference'], $report->getShortReference());
    }
}