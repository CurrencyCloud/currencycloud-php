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
            '{"id":"e6b30f2d-0088-4d99-bb47-c6b136fcf447","payment_id":"796e0d7d-bae6-4d8a-b217-3cf9ee80a350","account_id":"72970a7c-7921-431c-b95f-3438724ba16f","short_reference":"PC-2436231-LYODVS","status":"failed","confirmation_url":"","created_at":"2018-08-03T13:18:23+00:00","updated_at":"2018-08-03T13:18:23+00:00","expires_at":null}',
            true
        );

        $this->assertSame($dummy['payment_id'], $paymentConfirmation->getPaymentId());
        $this->assertSame($dummy['account_id'], $paymentConfirmation->getAccountId());
        $this->assertSame($dummy['short_reference'], $paymentConfirmation->getShortReference());
        $this->assertSame($dummy['status'], $paymentConfirmation->getStatus());
    }
}