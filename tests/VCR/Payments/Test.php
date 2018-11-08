<?php
namespace CurrencyCloud\Tests\VCR\Payments;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase {

    /**
     * @vcr Payments/can_authorise_payments.yaml
     * @test
     */
    public function canAuthorisePayments(){
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
}