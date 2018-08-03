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

  private $uuid_V4_format_regex = "/\A[a-f0-9]{8}\-[a-f0-9]{4}\-4[a-f0-9]{3}\-(8|9|a|b)[a-f0-9]{3}\-[a-f0-9]{12}\z/";

  /**
   * @vcr Payments/cannot_authorise_own_payment.yaml
   * @test
   */
    public function cannotAuthoriseOwnPayment(){
      // config
      // expected response from API:
      //{
      //  "authorisations":[
      //     {
      //       "payment_id":"7be6df7a-3ce1-47d0-aa07-cbcce7421c6b",
      //       "payment_status":"awaiting_authorisation",
      //       "updated":false,
      //       "error":"You cannot authorise this Payment as it was created by you.",
      //       "auth_steps_taken":0,
      //       "auth_steps_required":1,
      //       "short_reference":"180731-LMBHLG001"
      //     }
      //   ]
      // }

      // change to an account that can authorise the payment
      // $client = $this->getClient(SDK_NEEDING_AUTHORISATION_LOGIN_ID, SDK_NEEDING_AUTHORISATION_API_KEY);
      $client = $this->getClient(REDACTED_LOGIN_ID, REDACTED_API_KEY);
      // $client = $this->getClient(LOGIN_ID, API_KEY);

      $beneficiary = Beneficiary::create('Acme GmbH', 'DE', 'EUR', 'John Doe')
          ->setBeneficiaryCountry('DE')
          ->setBicSwift('COBADEFF')
          ->setIban('DE89370400440532013000');

      $beneficiary = $client->beneficiaries()->create($beneficiary);

      $payment = Payment::create('EUR', $beneficiary->getId(), '100', 'cannot Authorise test', 'Invoice #10')
          ->setPaymentType('regular');

      $payment = $client->payments()->create($payment);

      // assert we have payment objects
      $this->assertTrue($payment instanceof Payment);

      // test with an array containing a single payment_id
      $payment_ids = array('payment_ids' => array($payment->getId()));




      // attempt to authorise payment
      $authorised_payments = $client->payments()->authorise($payment_ids);


      // assert we have an array of objects
      $this->assertInternalType('array', $authorised_payments);
      // assert we have 1 payment_authorisation
      $this->assertCount(1, $authorised_payments);

      // check each element of array is a PaymentAuthorisation
      $this->assertTrue($authorised_payments[0] instanceof PaymentAuthorisation);
      // check the authorisation has a payment_id that is a UUID v4
      $this->assertSame(preg_match($this->uuid_V4_format_regex, $authorised_payments[0]->getPaymentId()), 1);

      // check the payment_status is 'authorised'
      $this->assertSame($authorised_payments[0]->getPaymentStatus(), 'awaiting_authorisation');
      // check there is no entry in the error attribute
      $this->assertSame($authorised_payments[0]->getError(), 'You cannot authorise this Payment as it was created by you.');
    }


    /**
     * @vcr Payments/can_authorise_payment.yaml
     * @test
     */
      public function canAuthorisePayment(){

        // config
        // expected response from API:
        // {
        //   "authorisations":[
        //     {
        //       "payment_id":"3afd16c2-3b7e-476d-b633-e67ca9f1eff6",
        //       "payment_status":"authorised",
        //       "updated":true,
        //       "error":null,
        //       "auth_steps_taken":1,
        //       "auth_steps_required":1,
        //       "short_reference":"180731-YMCSWX001"
        //     },
        //     {
        //       "payment_id":"afd66d20-2210-4218-b337-7c36ccb9d3c6",
        //       "payment_status":"authorised",
        //       "updated":true,
        //       "error":null,
        //       "auth_steps_taken":1,
        //       "auth_steps_required":1,
        //       "short_reference":"180731-MCDNHH001"
        //     }
        //   ]
        // }


        // $client = $this->getAuthenticatedClient();
        // We need to use an account that requires payment authorisations to have authorisation limits/steps
        $client = $this->getClient(SDK_NEEDING_AUTHORISATION_LOGIN_ID, SDK_NEEDING_AUTHORISATION_API_KEY);
      // $client = $this->getClient(REDACTED_LOGIN_ID, REDACTED_API_KEY);

        // setup Beneficiary
        $beneficiary = Beneficiary::create('Faces GmbH', 'DE', 'EUR', 'Jason Donmash')
            ->setBeneficiaryCountry('DE')
            ->setBicSwift('COBADEFF')
            ->setIban('DE89370400440532013000');

        $beneficiary = $client->beneficiaries()->create($beneficiary);

        // create 1st Payment requiring authorisation
        $payment_1 = Payment::create('EUR', $beneficiary->getId(), '550', 'canAuthorise test - Payment 1', 'Invoice #11')
            ->setPaymentType('regular');

        // create 2nd Payment requiring authorisation
        $payment_2 = Payment::create('EUR', $beneficiary->getId(), '25', 'canAuthorise test - Payment 2', 'Invoice #12')
        ->setPaymentType('regular');

        $paymentsForAuthorisation[] = $client->payments()->create($payment_1);
        $paymentsForAuthorisation[] = $client->payments()->create($payment_2);

        // change to an account that can authorise the payment
        $client = $this->getClient(SDK_CAN_AUTHORISE_LOGIN_ID, SDK_CAN_AUTHORISE_API_KEY);
      // $client = $this->getClient(REDACTED_LOGIN_ID, REDACTED_API_KEY);

        foreach ($paymentsForAuthorisation as $key => $paymentForAuthorisation) {
          $this->assertTrue($paymentsForAuthorisation[$key] instanceof Payment);
          $this->assertTrue($paymentsForAuthorisation[$key] instanceof Payment);
          $payment_ids['payment_ids'][] = $paymentForAuthorisation->getId();
        }

        // attempt to authorise payments
        $authorised_payments = $client->payments()->authorise($payment_ids);
        // assert we have an array of objects
        $this->assertInternalType('array', $authorised_payments);
        // assert we have 2 payment_authorisations
        $this->assertCount(2, $authorised_payments);

        foreach ($authorised_payments as $key => $authorised_payment) {
          // check each element of array is a PaymentAuthorisation
          $this->assertTrue($authorised_payments[$key] instanceof PaymentAuthorisation);
          $this->assertSame(preg_match($this->uuid_V4_format_regex, $authorised_payments[$key]->getPaymentId()), 1);
          // assert the UUID the same as the payment UUID when created
          $this->assertSame($authorised_payments[$key]->getPaymentId(),$paymentsForAuthorisation[$key]->getId());
          // check the payment_status is 'authorised'
          $this->assertSame($authorised_payments[$key]->getPaymentStatus(), 'authorised');
          // check there is no entry in the error attribute
          $this->assertNull($authorised_payments[$key]->getError());
        }
      }
}
