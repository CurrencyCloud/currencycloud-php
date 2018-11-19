<?php
namespace CurrencyCloud\Model;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase {
    /**
     * @vcr Transactions/can_retrieve_sender_details.yaml
     * @test
     */
    public function canRetrieveSenderDetails(){
        $senderDetails = $this->getAuthenticatedClient()->transactions()->retrieveSender('');

        $dummy = json_decode(
            '{"id":"e68301d3-5b04-4c1d-8f8b-13a9b8437040","amount":"1701.51","currency":"EUR","additional_information":"USTRD-0001","value_date":"2018-07-04T00:00:00+00:00","sender":"FR7615589290001234567890113, CMBRFR2BARK, Debtor, FR, Centre ville","receiving_account_number":null,"receiving_account_iban":"GB99OXPH94665099600083","created_at":"2018-07-04T14:57:38+00:00","updated_at":"2018-07-04T14:57:39+00:00"  }',
            true
        );

        $this->assertSame($dummy['id'], $senderDetails->getId());
        $this->assertSame($dummy['amount'], $senderDetails->getAmount());
        $this->assertSame($dummy['currency'], $senderDetails->getCurrency());
        $this->assertSame($dummy['additional_information'], $senderDetails->getAdditionalInformation());
        $this->assertSame($dummy['sender'], $senderDetails->getSender());
        $this->assertSame($dummy['receiving_account_number'], $senderDetails->getReceivingAcountNumber());
        $this->assertSame($dummy['receiving_account_iban'], $senderDetails->getReceivingAcountIban());
    }
}