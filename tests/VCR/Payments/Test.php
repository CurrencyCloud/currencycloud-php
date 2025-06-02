<?php
namespace CurrencyCloud\Tests\VCR\Payments;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;
use VCR\VCR;

class Test extends BaseCurrencyCloudVCRTestCase {

    /** @test */
    public function canAuthorisePayments()
    {
        VCR::insertCassette('Payments/can_authorise_payments.yaml');

        $authorisations = $this->getAuthenticatedClient()->payments()->authorise(
            [
                '2416c8fe-0486-4fc3-82d9-4dc9a44eba9a',
                'abf2ebe7-cdc9-460b-b64e-3652297b629e'
            ]
        );

        $dummy = json_decode(
            '{"authorisations":[{"payment_id":"2416c8fe-0486-4fc3-82d9-4dc9a44eba9a","payment_status":"authorised","updated":true,"error":null,"auth_steps_taken":1,"auth_steps_required":1,"short_reference":"181108-WRMWLR001"},{"payment_id":"abf2ebe7-cdc9-460b-b64e-3652297b629e","payment_status":"authorised","updated":true,"error":null,"auth_steps_taken":1,"auth_steps_required":1,"short_reference":"181108-BHJNQM001"}]}',
            true
        );

        $this->assertSame(count($dummy['authorisations']), $authorisations->count());

        foreach ($dummy['authorisations'] as $key => $value) {
            $this->assertSame($value['payment_id'], $authorisations->getAuthorisations()[$key]->getPaymentId());
            $this->assertSame($value['payment_status'], $authorisations->getAuthorisations()[$key]->getPaymentStatus());
            $this->assertSame($value['updated'], $authorisations->getAuthorisations()[$key]->getUpdated());
            $this->assertSame($value['auth_steps_taken'], $authorisations->getAuthorisations()[$key]->getAuthSteptsTaken());
            $this->assertSame($value['auth_steps_required'], $authorisations->getAuthorisations()[$key]->getAuthSteptsRequired());
            $this->assertSame($value['short_reference'], $authorisations->getAuthorisations()[$key]->getShortReference());
        }
    }

    /** @test */
    public function canGetPaymentSubmission()
    {
        VCR::insertCassette('Payments/can_get_payment_submission.yaml');

        $paymentSubmission = $this->getAuthenticatedClient()->payments()->retrieveSubmission('48e707c9-43e3-4b07-a1d1-bee38f9c95a1');

        $data = json_decode(
            '{"mt103":"{1:F01TCCLGB20AXXX0090000004}{2:I103BARCGB22XXXXN}{4: :20:20160617-ZSYWVY :23B:CRED :32A:160617GBP3000,0 :33B:GBP3000,0 :50K:/150618-00026 PCOMAPNY address New-York Province 555222 GB :53B:/20060513071472 :57C://SC200605 :59:/200605000 First Name Last Name e03036bf6c325dd12c58 London GB :70:test reference Test reason Payment group: 0160617-ZSYWVY :71A:SHA -}","status":"pending","submission_ref":"MXGGYAGJULIIQKDV"}',
            true);

        $this->assertSame($data['status'], $paymentSubmission->getStatus());
        $this->assertSame($data['mt103'], $paymentSubmission->getMt103());
        $this->assertSame($data['submission_ref'], $paymentSubmission->getSubmissionRef());
    }

    /** @test */
    public function canGetPaymentSubmissionInfo()
    {
        VCR::insertCassette('Payments/can_get_new_payment_submission.yaml');

        $paymentSubmission = $this->getAuthenticatedClient()->payments()->retrieveSubmissionInfo('48e707c9-43e3-4b07-a1d1-bee38f9c95a1');

        $data = json_decode(
            '{"message":"{1:F01TCCLGB20AXXX0090000004}{2:I103BARCGB22XXXXN}{4: :20:20160617-ZSYWVY :23B:CRED :32A:160617GBP3000,0 :33B:GBP3000,0 :50K:/150618-00026 PCOMAPNY address New-York Province 555222 GB :53B:/20060513071472 :57C://SC200605 :59:/200605000 First Name Last Name e03036bf6c325dd12c58 London GB :70:test reference Test reason Payment group: 0160617-ZSYWVY :71A:SHA -}","status":"pending","submission_ref":"MXGGYAGJULIIQKDV","format":"MT103"}',
            true);

        $this->assertSame($data['status'], $paymentSubmission->getStatus());
        $this->assertSame($data['message'], $paymentSubmission->getMessage());
        $this->assertSame($data['submission_ref'], $paymentSubmission->getSubmissionRef());
        $this->assertSame($data['format'], $paymentSubmission->getFormat());
    }

    /** @test */
    public function canGetPaymentConfirmation()
    {
        VCR::insertCassette('Payments/can_get_payment_confirmation.yaml');

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
