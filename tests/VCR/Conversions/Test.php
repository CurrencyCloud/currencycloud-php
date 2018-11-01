<?php
namespace CurrencyCloud\tests\VCR\Conversions;

use CurrencyCloud\Criteria\ConversionProfitLossCriteria;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase {

    /**
     * @vcr Conversions/can_retrieve_conversion_profit_loss.yaml
     * @test
     */
    public function canRetrieveConversionProfitLoss(){
        $conversionProfitLossCriteria = new ConversionProfitLossCriteria();
        $pagination = new Pagination();

        $conversionProfitLossCollection = $this->getAuthenticatedClient()->conversions()->retrieveProfitLoss($conversionProfitLossCriteria, $pagination);

        $dummy = json_decode(
            '{"conversion_profit_and_losses":[{"account_id":"72970a7c-7921-431c-b95f-3438724ba16f","contact_id":"a66ca63f-e668-47af-8bb9-74363240d781","event_account_id":null,"event_contact_id":null,"conversion_id":"515eaa18-0756-42b9-9899-49bfea5d3e8a","event_type":"self_service_cancellation","amount":"-0.01","currency":"GBP","notes":"","event_date_time":"2018-06-19T15:55:15+00:00"},{"account_id":"72970a7c-7921-431c-b95f-3438724ba16f","contact_id":"a66ca63f-e668-47af-8bb9-74363240d781","event_account_id":null,"event_contact_id":null,"conversion_id":"10c79aba-a9ee-41c2-b0ce-89a0941a8599","event_type":"self_service_cancellation","amount":"-0.01","currency":"GBP","notes":"","event_date_time":"2018-06-19T16:20:45+00:00"},{"account_id":"72970a7c-7921-431c-b95f-3438724ba16f","contact_id":"a66ca63f-e668-47af-8bb9-74363240d781","event_account_id":null,"event_contact_id":null,"conversion_id":"bb95fa2e-52f7-4219-8710-110e60e1ed91","event_type":"self_service_cancellation","amount":"-0.01","currency":"GBP","notes":"","event_date_time":"2018-06-19T16:29:32+00:00"}],"pagination":{"total_entries":3,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":-1,"order":"event_date_time","order_asc_desc":"asc"}}',
        true);

        foreach($dummy['conversion_profit_and_losses'] as $key => $value){
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['account_id'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getAccountId());
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['contact_id'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getContactId());
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['event_type'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getEventType());
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['amount'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getAmount());
            $this->assertSame($dummy['conversion_profit_and_losses'][$key]['currency'],
                $conversionProfitLossCollection->getConversionsProfitLoss()[$key]->getCurrency());
        }

        $this->assertSame($dummy['pagination']['total_entries'], $conversionProfitLossCollection->getPagination()->getTotalEntries());
    }
}