<?php

namespace CurrencyCloud\Tests\VCR\Settlements;

use CurrencyCloud\Model\Conversion;
use CurrencyCloud\Model\SettlementEntry;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase
{

  private static $conversionId;
  private static $settlementId;
  private static $buyCurrency    = 'GBP';
  private static $sellCurrency   = 'EUR';
  private static $fixedSide      = 'buy';
  private static $amount         = 750;
  private static $term_agreement = true;
  private static $reason         = 'Mortgage Payment';


    protected function createConversion(){
      $client = $this->getClient(SDK_SETTLEMENTS_LOGIN_ID, SDK_SETTLEMENTS_API_KEY);

      $conversion = $client->conversions()
        ->create(Conversion::create(self::$buyCurrency, self::$sellCurrency, self::$fixedSide), self::$amount, self::$term_agreement, self::$reason);

      self::$conversionId = $conversion->getId();

      return $conversion;
    }

    /**
     * @vcr Settlements/can_add_conversion.yaml
     * @test
     */
    public function canAddConversion()
    {
      $client = $this->getClient(SDK_SETTLEMENTS_LOGIN_ID, SDK_SETTLEMENTS_API_KEY);

      $conversion = $this->createConversion();

      // assert we have an object
      $this->assertTrue($conversion instanceof Conversion);
      // check that the currency_pair match what we sent
      $this->assertEquals(self::$sellCurrency.self::$buyCurrency, $conversion->getCurrencyPair());
      // check we have the buy currency set correctly
      $this->assertEquals(self::$buyCurrency, $conversion->getBuyCurrency());
      // check we have the sell currency set correctly
      $this->assertEquals(self::$sellCurrency, $conversion->getSellCurrency());
      // check we have the fixed side set correctly
      $this->assertEquals(self::$fixedSide, $conversion->getFixedSide());
      // check the clientBuyAmount is the value of amount
      $this->assertEquals(self::$amount, $conversion->getClientBuyAmount());

      // Create the settlement
      $settlement = $client->settlements()->create();

      // Add conversion to settlement
      $settlementsWithConversion = $client->settlements()->addConversion($settlement->getId(), $conversion->getId());

      // assert settlementId is that of the settlement passed
      $this->assertEquals($settlement->getId(), $settlementsWithConversion->getId());
      // assert conversionId is that of the conversion passed

      $this->assertTrue(in_array($conversion->getId(), $settlementsWithConversion->getConversionIds()));
      // assert the settlement has not yet been released
      $this->assertNull($settlement->getReleasedAt());
      // assert the settlement has an 'open' status
      $this->assertEquals($settlement->getStatus(), 'open');

      self::$settlementId = $settlement->getId();
    }

    /**
     * @vcr Settlements/can_release.yaml
     * @test
     */
    public function canRelease()
    {
      $client = $this->getClient(SDK_SETTLEMENTS_LOGIN_ID, SDK_SETTLEMENTS_API_KEY);

      $settlementReleased = $client->settlements()->release(self::$settlementId);

      $this->assertEquals($settlementReleased->getId(), self::$settlementId);

      $this->assertNotNull($settlementReleased->getReleasedAt());

      $this->assertEquals($settlementReleased->getStatus(), 'released');
    }

    /**
     * @vcr Settlements/can_unrelease.yaml
     * @test
     */
    public function canUnrelease()
    {
      $client = $this->getClient(SDK_SETTLEMENTS_LOGIN_ID, SDK_SETTLEMENTS_API_KEY);

      $unReleasedSettlement = $client->settlements()->unrelease(self::$settlementId);

      $this->assertEquals($unReleasedSettlement->getId(), self::$settlementId);

      $this->assertEquals($unReleasedSettlement->getStatus(), 'open');
    }


    /**
     * @vcr Settlements/can_remove_conversion.yaml
     * @test
     */
    public function canRemoveConversion()
    {
      $client = $this->getClient(SDK_SETTLEMENTS_LOGIN_ID, SDK_SETTLEMENTS_API_KEY);

      $settlementsWithOutConversion = $client->settlements()
        ->removeConversion(self::$settlementId, self::$conversionId);

      $this->assertEquals($settlementsWithOutConversion->getId(), self::$settlementId);

      $this->assertNull($settlementsWithOutConversion->getReleasedAt());

      $this->assertEquals($settlementsWithOutConversion->getStatus(), 'open');

      $this->assertEmpty($settlementsWithOutConversion->getConversionIds());
    }

}
