<?php
namespace CurrencyCloud\Tests\VCR\Ibans;

use CurrencyCloud\Criteria\FindIbansCriteria;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;
use VCR\VCR;

class Test extends BaseCurrencyCloudVCRTestCase {

    /** @test */
    public function canFindIbans()
    {
        VCR::insertCassette('Ibans/can_find_ibans.yaml');

        $findIbansCriteria = new FindIbansCriteria();
        $pagination = new Pagination();
        $ibans = $this->getAuthenticatedClient()->ibans()->find($findIbansCriteria, $pagination);

        $dummy = json_decode('{"ibans":[{"id":"b7981972-8e29-485b-8a4a-9643fc9ae4ea","account_id":"8d98bdc8-e8e3-47dc-bd08-3dd0f4f7ea7b","iban_code":"GB61TCCL00997950423807","currency":"EUR","account_holder_name":"My Example Account","bank_institution_name":"The Currency Cloud","bank_institution_address":"12 Steward Street, The Steward Building, London, E1 6FQ, GB","bank_institution_country":"United Kingdom","bic_swift":"TCCLGB31","created_at":"2018-05-14T14:18:30+00:00","updated_at":"2018-05-14T14:18:30+00:00"},{"id":"fe662294-71a8-47c0-941a-a5fdcd3da394","account_id":"a155eca9-5d3f-4659-ab2c-212a1414a0fa","iban_code":"GB20TCCL00997973237199","currency":"EUR","account_holder_name":"My Example Account","bank_institution_name":"The Currency Cloud","bank_institution_address":"12 Steward Street, The Steward Building, London, E1 6FQ, GB","bank_institution_country":"United Kingdom","bic_swift":"TCCLGB31","created_at":"2018-05-14T15:27:20+00:00","updated_at":"2018-05-14T15:27:20+00:00"},{"id":"460540e5-b854-4082-a524-1831cde4aafa","account_id":"0398176a-adfe-4095-880d-c6932131aa6e","iban_code":"GB91TCCL00997900063971","currency":"EUR","account_holder_name":"My Example Account","bank_institution_name":"The Currency Cloud","bank_institution_address":"12 Steward Street, The Steward Building, London, E1 6FQ, GB","bank_institution_country":"United Kingdom","bic_swift":"TCCLGB31","created_at":"2018-05-14T15:28:03+00:00","updated_at":"2018-05-14T15:28:03+00:00"}],"pagination":{"total_entries":3,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":-1,"order":"created_at","order_asc_desc":"asc"}}',
            true);

        $this->assertSame($ibans->getPagination()->getTotalEntries(), 3);
        $this->assertSame($ibans->getIbans()[0]->getAccountId(), $dummy['ibans'][0]['account_id']);
        $this->assertSame($ibans->getIbans()[0]->getIbanCode(), $dummy['ibans'][0]['iban_code']);
        $this->assertSame($ibans->getIbans()[0]->getBicSwift(), $dummy['ibans'][0]['bic_swift']);

        $this->assertSame($ibans->getIbans()[1]->getAccountId(), $dummy['ibans'][1]['account_id']);
        $this->assertSame($ibans->getIbans()[1]->getIbanCode(), $dummy['ibans'][1]['iban_code']);
        $this->assertSame($ibans->getIbans()[1]->getBicSwift(), $dummy['ibans'][1]['bic_swift']);

        $this->assertSame($ibans->getIbans()[2]->getAccountId(), $dummy['ibans'][2]['account_id']);
        $this->assertSame($ibans->getIbans()[2]->getIbanCode(), $dummy['ibans'][2]['iban_code']);
        $this->assertSame($ibans->getIbans()[2]->getBicSwift(), $dummy['ibans'][2]['bic_swift']);
    }
}
