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
            '{"mt103":"{1:F01TCCLGB20AXXX0090000004}{2:I103BARCGB22XXXXN}{4: :20:20160617-ZSYWVY :23B:CRED :32A:160617GBP3000,0 :33B:GBP3000,0 :50K:/150618-00026 PCOMAPNY address New-York Province 555222 GB :53B:/20060513071472 :57C://SC200605 :59:/200605000 First Name Last Name e03036bf6c325dd12c58 London GB :70:test reference Test reason Payment group: 0160617-ZSYWVY :71A:SHA -}","status":"pending","submission_ref":"MXGGYAGJULIIQKDV"}',
            true);

        $this->assertSame($data['status'], $paymentSubmission->getStatus());
        $this->assertSame($data['mt103'], $paymentSubmission->getMt103());
        $this->assertSame($data['submission_ref'], $paymentSubmission->getSubmissionRef());
    }
}