<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\ReferenceEntryPoint;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class ReferencesEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canGetPaymentDates()
    {
        $data = '{"invalid_payment_dates":{"2013-04-18":"Good Friday","2013-04-19":"No trading on Saturday"},"first_payment_date":"2013-04-15"}';

        $date = new DateTime();

        $entryPoint = new ReferenceEntryPoint(
            $this->getMockedClient(
            json_decode($data),
            'GET',
            'reference/payment_dates',
            [
                'currency' => 'EUR',
                'start_date' => $date->format(DateTime::ISO8601),
            ]
        )
        );

        $payments = $entryPoint->paymentDates('EUR', $date);

        $invalid = $payments->getInvalidPaymentDates();
        $first = $payments->getFirstPaymentDay();

        $this->assertSame('2013-04-15', $first->format('Y-m-d'));

        $temp = json_decode($data, true)['invalid_payment_dates'];

        $this->assertSame(count($temp), count($invalid));

        foreach ($invalid as $single) {
            $k = $single->getDate()->format('Y-m-d');
            $this->assertArrayHasKey($k, $temp);
            $this->assertSame($temp[$k], $single->getDescription());
        }
    }
}
