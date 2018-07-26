<?php

namespace CurrencyCloud\Tests\VCR\Payments;

use CurrencyCloud\CurrencyCloud;
use CurrencyCloud\EntryPoint\PaymentsEntryPoint;
use CurrencyCloud\Model\Beneficiary;
use CurrencyCloud\Model\Payment;
use CurrencyCloud\Model\Payments;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Model\PaymentAuthorisation;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase
{
  /**
   * @vcr Payments/can_authorise_payment.yaml
   * @test
   */
    public function cannotAuthoriseOwnPayment(){

      $error = new PaymentAuthorisation();
      $client = $this->getAuthenticatedClient();
      $beneficiary = Beneficiary::create('Acme GmbH', 'DE', 'EUR', 'John Doe')
          ->setBeneficiaryCountry('DE')
          ->setBicSwift('COBADEFF')
          ->setIban('DE89370400440532013000');

      $beneficiary = $client->beneficiaries()->create($beneficiary);

      $payment = Payment::create('EUR', $beneficiary->getId(), '100', 'canAuthorise test', 'Invoice #10')
          ->setPaymentType('regular');

      $payment = $client->payments()->create($payment);

      $dummy = json_decode(
        '{"id":"21a49b0a-8ec7-4eca-af16-bae516a7ed9a","amount":"100.00","beneficiary_id":"594342e8-4e27-4120-8a4a-9358036992e0","currency":"EUR","reference":"Invoice #10","reason":"canAuthorise test","status":"awaiting_authorisation","creator_contact_id":"871b9f2f-f8a3-4010-b084-43e48ab4f404","payment_type":"regular","payment_date":"2018-07-25","transferred_at":"","authorisation_steps_required":"1","last_updater_contact_id":"871b9f2f-f8a3-4010-b084-43e48ab4f404","short_reference":"180725-CFJSFX001","conversion_id":null,"failure_reason":"","payer_id":"2bb67b68-6da1-4823-8bb5-b578ee09a8fa","payer_details_source":"account","created_at":"2018-07-25T13:25:19+00:00","updated_at":"2018-07-25T13:25:19+00:00","payment_group_id":null,"unique_request_id":null,"failure_returned_amount":"0.00","ultimate_beneficiary_name":null}', true
      );

      $this->validateObjectStrictName($payment, $dummy);
      $payment_ids = array('payment_ids' => array($payment->getId()));
      $authorised_payments = $client->payments()->authorise($payment_ids);

      $this->assertSame($authorised_payments[0]->getError(), 'You cannot authorise this Payment as it was created by you.');

    }
}
