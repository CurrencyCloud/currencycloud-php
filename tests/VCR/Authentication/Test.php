<?php

namespace CurrencyCloud\Tests\VCR\Authentication;

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
}
