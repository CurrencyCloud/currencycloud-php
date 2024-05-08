<?php
namespace CurrencyCloud\Tests\VCR\FundingTransactions;

use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;
use VCR\VCR;

class Test extends BaseCurrencyCloudVCRTestCase
{
    /** @test */
    public function canRetrieveFundingTransaction()
    {
        VCR::insertCassette('FundingTransactions/can_retrieve_funding_transaction.yaml');

        $fundingTransaction = $this->getAuthenticatedClient()->fundingTransactions()->retrieveFundingTransaction('');

        $dummy = json_decode(
            '{"id":"4924919a-6c28-11ee-a3e3-63774946bad2","amount":"1.11","currency":"USD","rail":"SEPA","additional_information":"CFST20231016143117","receiving_account_routing_code":null,"value_date":"2023-10-16T00:00:00+00:00","receiving_account_number":"8302996933","receiving_account_iban":null,"created_at":"2023-10-16T13:31:18+00:00","updated_at":"2023-10-16T13:31:18+00:00","completed_at":"2023-10-16T13:31:18+00:00","sender":{"sender_id":"5c675fa4-fdf0-4ee6-b5bb-156b36765433","sender_address":"test","sender_country":"GB","sender_name":"test","sender_bic":null,"sender_iban":null,"sender_account_number":null,"sender_routing_code":null} }',
            true
        );

        $this->assertSame($dummy['id'], $fundingTransaction->getId());
        $this->assertSame($dummy['amount'], $fundingTransaction->getAmount());
        $this->assertSame($dummy['currency'], $fundingTransaction->getCurrency());
        $this->assertSame($dummy['additional_information'], $fundingTransaction->getAdditionalInformation());
        $this->assertSame($dummy['rail'], $fundingTransaction->getRail());
        $this->assertSame($dummy['sender']['sender_id'], $fundingTransaction->getSender()->getSenderId());
    }
}
