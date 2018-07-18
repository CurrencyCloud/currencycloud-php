<?php

namespace CurrencyCloud\Tests\VCR\Payments;

use CurrencyCloud\CurrencyCloud;
use CurrencyCloud\Model\Beneficiary;
use CurrencyCloud\Model\Payment;
use CurrencyCloud\Model\Payments;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase
{
  /**
   * @vcr Payments/can_authorise_payment.yaml
   * @test
   */
    public function canAuthorisePayment(){

      $client = $this->getAuthenticatedClient();

      print_r("\n========== Should be authenticated ==============");

      $beneficiary = Beneficiary::create('Acme GmbH', 'DE', 'EUR', 'John Doe')
          ->setBeneficiaryCountry('DE')
          ->setBicSwift('COBADEFF')
          ->setIban('DE89370400440532013000');

         // print_r($client);
        //  exit;

      print_r("\n========== Beneficiary ==============");
      print_r($beneficiary);
      print_r("==========================================\n");

      $beneficiary = $client->beneficiaries()->create($beneficiary);

      print_r("\n========== Beneficiary (after client) ==============");
      print_r($beneficiary);
      print_r("==========================================\n");

      $payment = Payment::create('EUR', $beneficiary->getId(), '100', 'canAuthorise test', 'Invoice #10')
          ->setPaymentType('regular');

      print_r("\n========== Payment ==============");
      print_r($payment);
      print_r("==========================================\n");

      $payment = $client->payments()->create($payment);

      $dummy = json_decode(
        '{"id":"9bcf792c-859a-4b8a-9d7f-9e6e7b8ca285","amount":"100.00","beneficiary_id":"1de11836-b0cd-47e8-8c50-b454121dd298","currency":"EUR","reference":"Invoice #10","reason":"canAuthorise test","status":"awaiting_authorisation","creator_contact_id":"871b9f2f-f8a3-4010-b084-43e48ab4f404","payment_type":"regular","payment_date":"2018-07-19","transferred_at":"","authorisation_steps_required":"1","last_updater_contact_id":"871b9f2f-f8a3-4010-b084-43e48ab4f404","short_reference":"180719-JFLQMH001","conversion_id":null,"failure_reason":"","payer_id":"2bb67b68-6da1-4823-8bb5-b578ee09a8fa","payer_details_source":"account","created_at":"2018-07-19T08:51:57+00:00","updated_at":"2018-07-19T08:51:58+00:00","payment_group_id":null,"unique_request_id":null,"failure_returned_amount":"0.00","ultimate_beneficiary_name":null}', true
      );

      $this->validateObjectStrictName($payment, $dummy);

      $payment_ids = array($payment->getId());

      print_r($payment_ids);
      print_r($payment_ids[0]);

      $authorised_payments = $client->payments()->authorise($payment_ids);

      print_r("\nAuthroised Payment\n============================");
      print_r($authorised_payments);
      print_r("\n\n====================================");

    }
}
