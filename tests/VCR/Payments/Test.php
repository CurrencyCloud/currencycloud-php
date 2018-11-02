<?php
namespace CurrencyCloud\Tests\VCR;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase {

    /**
     * @vcr Payments/can_get_payment_confirmation.yaml
     * @test
     */
    public function canGetPaymentConfirmation(){
        $paymentConfirmation = $this->getAuthenticatedClient()->payments()->retrieveConfirmation('796e0d7d-bae6-4d8a-b217-3cf9ee80a350');

        $dummy = json_decode(
            '{"id":"d7d5c073-7aac-415a-b2cd-f3f4942ca164","payment_id":"3c66de91-0083-4e8f-aff7-a2b5250f6aa8","account_id":"bf5b1007-b364-43cc-b3d6-9f2d1be75297","short_reference":"PC-9387530-VFDXNJ","status":"completed","confirmation_url":"https://ccycloud-payment-confirmations-prod-demo1.s3.eu-west-1.amazonaws.com/payment_confirmations/d7d5c073-7aac-415a-b2cd-f3f4942ca164/181102-XYJHCH001.pdf?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=abcxyz12345&X-Amz-Date=20181102T121904Z&X-Amz-Expires=172800&X-Amz-SignedHeaders=host&X-Amz-Security-Token=wxyzabc123&X-Amz-Signature=abcdef1234","created_at":"2018-11-02T09:02:57+00:00","updated_at":"2018-11-02T09:02:58+00:00","expires_at":"2018-11-04T00:00:00+00:00"}',
            true
        );

        $this->assertSame($dummy['payment_id'], $paymentConfirmation->getPaymentId());
        $this->assertSame($dummy['account_id'], $paymentConfirmation->getAccountId());
        $this->assertSame($dummy['short_reference'], $paymentConfirmation->getShortReference());
        $this->assertSame($dummy['status'], $paymentConfirmation->getStatus());
    }
}