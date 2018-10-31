<?php
namespace CurrencyCloud\Tests\VCR\Payments;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase{


    /**
     * @vcr Payments/can_get_payment_submission.yaml
     * @test
     */
    public function canGetPaymentSubmission(){
        $paymentSubmission = $this->getAuthenticatedClient()->payments()->retrieveSubmission('48e707c9-43e3-4b07-a1d1-bee38f9c95a1');

        $data = json_decode(
            '{"status":null,"mt103":null,"submission_ref":null        }',
            true);

        $this->assertSame($data['status'], $paymentSubmission->getStatus());
        $this->assertSame($data['mt103'], $paymentSubmission->getMt103());
        $this->assertSame($data['submission_ref'], $paymentSubmission->getSubmissionRef());
    }
}