<?php

namespace CurrencyCloud\Tests\VCR\Authentication;

use CurrencyCloud\Model\Beneficiaries;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;

class Test extends BaseCurrencyCloudTestCase
{

    /**
     * @vcr Authentication/can_be_closed.yaml
     * @test
     */
    public function canBeClosed()
    {

        $client = $this->getClient();
        $client->getSession()->setAuthToken('2ec8a86c8cf6e0378a20ca6793f3260c');
        $client->authenticate()->close();

        $this->assertNull($client->getSession()->getAuthToken());
    }

    /**
     * @vcr Authentication/can_use_just_a_token.yaml
     * @test
     */
    public function canUseJustToken()
    {

        $client = $this->getAuthenticatedClient('2ec8a86c8cf6e0378a20ca6793f3260c');


        $beneficiaries = $client->beneficiaries()->find();

        $this->assertTrue($beneficiaries instanceof Beneficiaries);
        $this->assertCount(0, $beneficiaries->getBeneficiaries());

        $dummy = json_decode(
            '{"beneficiaries":[],"pagination":{"total_entries":0,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":-1,"order":"created_at","order_asc_desc":"asc"}}',
            true
        );
        $this->validateObjectStrictName($beneficiaries->getPagination(), $dummy['pagination']);
    }

    /**
     * @vcr Authentication/happens_lazily.yaml
     * @test
     */
    public function happensLazily()
    {
        $client = $this->getClient();
        $client->getSession()->setAuthToken(null);

        $beneficiaries = $client->beneficiaries()->find();

        $this->assertTrue($beneficiaries instanceof Beneficiaries);
        $this->assertCount(0, $beneficiaries->getBeneficiaries());

        $dummy = json_decode(
            '{"beneficiaries":[],"pagination":{"total_entries":0,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":-1,"order":"created_at","order_asc_desc":"asc"}}',
            true
        );
        $this->validateObjectStrictName($beneficiaries->getPagination(), $dummy['pagination']);
        $this->assertEquals('038022bcd2f372cac7bab448db7b5c3b', $client->getSession()->getAuthToken());
    }

    /**
     * @vcr Authentication/handles_session_timeout_error.yaml
     * @test
     */
    public function handlesSessionTimeoutError()
    {
        $client = $this->getAuthenticatedClient();

        $beneficiaries = $client->beneficiaries()->find();

        $this->assertTrue($beneficiaries instanceof Beneficiaries);
        $this->assertCount(0, $beneficiaries->getBeneficiaries());

        $dummy = json_decode(
            '{"beneficiaries":[],"pagination":{"total_entries":0,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":-1,"order":"created_at","order_asc_desc":"asc"}}',
            true
        );
        $this->validateObjectStrictName($beneficiaries->getPagination(), $dummy['pagination']);
        $this->assertEquals('038022bcd2f372cac7bab448db7b5c3b', $client->getSession()->getAuthToken());
    }
}
