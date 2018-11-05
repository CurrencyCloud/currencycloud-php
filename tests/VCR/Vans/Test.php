<?php
namespace CurrencyCloud\Tests\VCR\Vans;

use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Tests\BaseCurrencyCloudVCRTestCase;

class Test extends BaseCurrencyCloudVCRTestCase {

    /**
     * @vcr Vans/can_get_vans.yaml
     * @test
     */
    public function canGetVans(){

        $pagination = new Pagination();
        $vansCollection = $this->getAuthenticatedClient()->vans()->retrieveVans($pagination);

        $dummy = json_decode(
            '{"virtual_accounts":[{"id":"00d272ee-fae5-4f97-b425-993a2d6e3a46","account_id":"2090939e-b2f7-3f2b-1363-4d235b3f58af","virtual_account_number":"8303723297","account_holder_name":"Account-ZXOANNAMKPRQ","bank_institution_name":"Community Federal Savings Bank","bank_institution_address":"Seventh Avenue, New York, NY 10019, US","bank_institution_country":"United States","routing_code":"026073150","created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":2,"order":"created_at","order_asc_desc":"asc"}}',
            true);

        $this->assertSame(count($dummy['virtual_accounts']), $vansCollection->count());

        $this->assertSame($dummy['virtual_accounts'][0]['id'], $vansCollection->getVans()[0]->getId());
        $this->assertSame($dummy['virtual_accounts'][0]['account_id'], $vansCollection->getVans()[0]->getAccountId());
        $this->assertSame($dummy['virtual_accounts'][0]['virtual_account_number'], $vansCollection->getVans()[0]->getVirtualAccountNumber());
        $this->assertSame($dummy['virtual_accounts'][0]['account_holder_name'], $vansCollection->getVans()[0]->getAccountHolderName());
        $this->assertSame($dummy['virtual_accounts'][0]['bank_institution_name'], $vansCollection->getVans()[0]->getBankInstitutionName());
        $this->assertSame($dummy['virtual_accounts'][0]['bank_institution_address'], $vansCollection->getVans()[0]->getBankInstitutionAddress());
        $this->assertSame($dummy['virtual_accounts'][0]['bank_institution_country'], $vansCollection->getVans()[0]->getBankInstitutionCountry());
        $this->assertSame($dummy['virtual_accounts'][0]['routing_code'], $vansCollection->getVans()[0]->getRoutingCode());
    }
}