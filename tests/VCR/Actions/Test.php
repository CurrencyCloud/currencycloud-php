<?php

namespace CurrencyCloud\Tests\VCR\Actions;

use CurrencyCloud\Exception\NotFoundException;
use Exception;
use CurrencyCloud\Model\Account;
use CurrencyCloud\Model\Balance;
use CurrencyCloud\Model\Beneficiary;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase
{

    /**
     * @vcr Actions/can_first.yaml
     * @test
     */
    public function canFirst()
    {
        $beneficiaries =
            $this->getAuthenticatedClient()
                ->beneficiaries()
                ->find(
                    (new Beneficiary())->setBankAccountHolderName('Test User'),
                    (new Pagination())->setPerPage(1)
                );


        foreach ($beneficiaries->getBeneficiaries() as $k => $beneficiary) {
          $this->assertTrue($beneficiary instanceof Beneficiary);
        }

        // print_r($beneficiaries->getBeneficiaries());

          $this->assertCount(1,$beneficiaries->getBeneficiaries());

    }

    /**
     * @vcr Actions/can_find.yaml
     * @test
     */
    public function canFind()
    {
        $beneficiaries = $this->getAuthenticatedClient()
            ->beneficiaries()
            ->find();

        foreach ($beneficiaries->getBeneficiaries() as $k => $beneficiary) {
          $this->assertTrue($beneficiary instanceof Beneficiary);
        }

    }

    /**
     * @vcr Actions/can_retrieve.yaml
     * @test
     */
    public function canRetrieve()
    {
      $client = $this->getAuthenticatedClient();

      $beneficiary = Beneficiary::create('Acme INC GmbH', 'DE', 'EUR', 'Martin Smith', 'martin@email.com')
          ->setBeneficiaryCountry('DE')
          ->setBicSwift('COBADEFF')
          ->setIban('DE89370400440532013000');

      // create the beneficiary
      $beneficiary = $client->beneficiaries()->create($beneficiary);
      // retrieve the beneficiary using the UUID
      $retrievedBeneficiary = $client->beneficiaries()->retrieve($beneficiary->getId());

      $this->assertTrue($retrievedBeneficiary instanceof Beneficiary);

    }

    /**
     * @vcr Actions/can_delete.yaml
     * @test
     */
    public function canDelete()
    {

        $this->setExpectedException(NotFoundException::class);

        $client = $this->getAuthenticatedClient();

        $beneficiary = Beneficiary::create('Acme INC GmbH', 'DE', 'EUR', 'Martin Smith', 'martin@email.com')
            ->setBeneficiaryCountry('DE')
            ->setBicSwift('COBADEFF')
            ->setIban('DE89370400440532013000');

        // create the beneficiary
        $beneficiary = $client->beneficiaries()->create($beneficiary);
        // delete the beneficiary
        $response = $client->beneficiaries()->delete($beneficiary);
        $retrievedBeneficiary = $client->beneficiaries()->retrieve($beneficiary->getId());

    }

    /**
     * @vcr Actions/can_create.yaml
     * @test
     */
    public function canCreate()
    {
        $client = $this->getAuthenticatedClient();
        $beneficiary =
            Beneficiary::create('Test User', 'GB', 'GBP', 'Test User')
                ->setAccountNumber('12345678')
                ->setRoutingCodeType1('sort_code')
                ->setRoutingCodeValue1('123456');

        $beneficiary = $client->beneficiaries()->create($beneficiary);

        $this->assertTrue($beneficiary instanceof Beneficiary);

    }

    /**
     * @vcr Actions/can_validate_beneficiaries.yaml
     * @test
     */
    public function canValidateBeneficiaries()
    {
        $client = $this->getAuthenticatedClient();

        $beneficiary =
            Beneficiary::createForValidate('GB', 'GBP', 'GB')
                ->setAccountNumber('12345678')
                ->setRoutingCodeType1('sort_code')
                ->setRoutingCodeValue1('123456');

        $beneficiary = $client->beneficiaries()->validate($beneficiary);
        $this->assertTrue($beneficiary instanceof Beneficiary);

    }

    /**
     * @vcr Actions/can_update.yaml
     * @test
     */
    public function canUpdate()
    {
        $client = $this->getAuthenticatedClient();

        $beneficiary = Beneficiary::create('Acme GmbH', 'DE', 'EUR', 'John Doe', 'adsdasasdasd@adsdsaads.com')
            ->setBeneficiaryCountry('DE')
            ->setBicSwift('COBADEFF')
            ->setIban('DE89370400440532013000');

        // create the beneficiary
        $beneficiary = $client->beneficiaries()->create($beneficiary);
        // retrieve the beneficiary using the UUID
        $retrievedBeneficiary = $client->beneficiaries()->retrieve($beneficiary->getId());

        // modify the record updating the bank account holders name and beneficiary first name
        $retrievedBeneficiary->setBankAccountHolderName('Test User 2')->setBeneficiaryFirstName('Dave');

        // pause the script for 2 seconds to check that the active record updated date changes
        sleep(2);
        // update the record
        $beneficiary = $client->beneficiaries()->update($retrievedBeneficiary);

        // assert that the bank account holders name is the same as the update sent
        $this->assertSame($beneficiary->getBankAccountHolderName(), $retrievedBeneficiary->getBankAccountHolderName());
        // assert that the first name is the same as the update sent
        $this->assertSame($beneficiary->getBeneficiaryFirstName(), $retrievedBeneficiary->getBeneficiaryFirstName());
        // finally validate that the updated date does not match the created date
        // this is how we know the record has been modified programatically
        $this->assertNotSame($retrievedBeneficiary->getUpdatedAt()->format('Y-m-d H:i:s'), $beneficiary->getUpdatedAt()->format('Y-m-d H:i:s'));
    }

    /**
     * @vcr Actions/does_nothing_if_nothing_updated.yaml
     * @test
     */
    public function doesNothingIfNothingUpdated()
    {
        $client = $this->getAuthenticatedClient();
        $beneficiary = Beneficiary::create('Acmea GmbH', 'DE', 'EUR', 'John Doe')
            ->setBeneficiaryCountry('DE')
            ->setBicSwift('COBADEFF')
            ->setIban('DE79370400440532013000');

        // create the beneficiary
        $beneficiary = $client->beneficiaries()->create($beneficiary);
        // retrieve the beneficiary using the UUID
        $retrievedBeneficiary = $client->beneficiaries()->retrieve($beneficiary->getId());

        // perform and update but dont modify anything
        $beneficiary = $client->beneficiaries()->update($retrievedBeneficiary);

        // assert that the updatedAt and createdAt are the same - this proves that the record
        // has not been updated.
        $this->assertSame($retrievedBeneficiary->getUpdatedAt()->format('Y-m-d H:i:s'), $beneficiary->getUpdatedAt()->format('Y-m-d H:i:s'));
    }

    /**
     * @vcr Actions/can_current.yaml
     * @test
     */
    public function canCurrent()
    {
        $account = $this->getAuthenticatedClient()->accounts()->current();
        $this->assertTrue($account instanceof Account);
    }

    /**
     * @vcr Actions/can_use_currency_to_retrieve_balance.yaml
     * @test
     */
    public function canUseCurrencyToRetrieveBalance()
    {
        $balance = $this->getAuthenticatedClient()->balances()->retrieve('GBP');

        $this->assertTrue($balance instanceof Balance);

    }
}
