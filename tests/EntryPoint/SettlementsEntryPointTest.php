<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\Criteria\FindSettlementsCriteria;
use CurrencyCloud\EntryPoint\SettlementsEntryPoint;
use CurrencyCloud\Model\Settlement;
use CurrencyCloud\Model\Settlements;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class SettlementsEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canRetrieve()
    {
        $data = '{"id":"a937f05e-e9fd-442e-a46f-11e84ba37806","short_reference":"20140101-BCDFGH","status":"open","conversion_ids":["c9b6b851-10f9-4bbf-881e-1d8a49adf7d8"],"entries":[{"GBP":{"send_amount":"0.00","receive_amount":"1000.00"}},{"USD":{"send_amount":"1587.80","receive_amount":"0.00"}}],"created_at":"2014-01-01T12:00:00+00:00","updated_at":"2014-01-01T12:00:00+00:00","released_at":"2014-01-01T12:00:00+00:00"}';

        $entryPoint = new SettlementsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'settlements/hi',
            [
                'on_behalf_of' => null
            ]
        )
        );

        $entity = $entryPoint->retrieve('hi');

        $temp = json_decode($data, true);

        $entries = $entity->getEntries();

        foreach ($temp['entries'] as $k => $t) {
            $this->assertArrayHasKey($k, $entries);
            foreach ($t as $c => $o) {
                $this->assertArrayHasKey($c, $entries[$k]);
                /* @var \CurrencyCloud\Model\SettlementEntry $a */
                $a = $entries[$k][$c];
                $this->assertSame($o['send_amount'], $a->getSendAmount());
                $this->assertSame($o['receive_amount'], $a->getReceiveAmount());
            }
        }

        unset($temp['entries']);

        $this->validateObjectStrictName($entity, $temp);
    }

    /**
     * @test
     */
    public function canRetrieveWithOnBehalfOf()
    {
        $data = '{"id":"a937f05e-e9fd-442e-a46f-11e84ba37806","short_reference":"20140101-BCDFGH","status":"open","conversion_ids":["c9b6b851-10f9-4bbf-881e-1d8a49adf7d8"],"entries":[],"created_at":"2014-01-01T12:00:00+00:00","updated_at":"2014-01-01T12:00:00+00:00","released_at":"2014-01-01T12:00:00+00:00"}';

        $entryPoint = new SettlementsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'settlements/hi',
            [
                'on_behalf_of' => 'me'
            ]
        )
        );

        $entity = $entryPoint->retrieve('hi', 'me');

        $temp = json_decode($data, true);

        unset($temp['entries']);

        $this->validateObjectStrictName($entity, $temp);
    }

    /**
     * @test
     */
    public function canDelete()
    {
        $data = '{"id":"a937f05e-e9fd-442e-a46f-11e84ba37806","short_reference":"20140101-BCDFGH","status":"open","conversion_ids":["c9b6b851-10f9-4bbf-881e-1d8a49adf7d8"],"entries":[],"created_at":"2014-01-01T12:00:00+00:00","updated_at":"2014-01-01T12:00:00+00:00","released_at":"2014-01-01T12:00:00+00:00"}';

        $entryPoint = new SettlementsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'settlements/hi/delete',
            [],
            [
                'on_behalf_of' => null
            ]
        )
        );

        $entity = new Settlement();
        $this->setIdProperty($entity, 'hi');

        $entity = $entryPoint->delete($entity);

        $temp = json_decode($data, true);

        unset($temp['entries']);

        $this->validateObjectStrictName($entity, $temp);
    }

    /**
     * @test
     */
    public function canDeleteWithOnBehalfOF()
    {
        $data = '{"id":"a937f05e-e9fd-442e-a46f-11e84ba37806","short_reference":"20140101-BCDFGH","status":"open","conversion_ids":["c9b6b851-10f9-4bbf-881e-1d8a49adf7d8"],"entries":[],"created_at":"2014-01-01T12:00:00+00:00","updated_at":"2014-01-01T12:00:00+00:00","released_at":"2014-01-01T12:00:00+00:00"}';

        $entryPoint = new SettlementsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'settlements/hi/delete',
            [],
            [
                'on_behalf_of' => 'me'
            ]
        )
        );

        $entity = new Settlement();
        $this->setIdProperty($entity, 'hi');

        $entity = $entryPoint->delete($entity, 'me');

        $temp = json_decode($data, true);

        unset($temp['entries']);

        $this->validateObjectStrictName($entity, $temp);
    }

    /**
     * @test
     */
    public function canFind()
    {
        $data = '{"settlements":[{"id":"a937f05e-e9fd-442e-a46f-11e84ba37806","short_reference":"20140101-BCDFGH","status":"open","conversion_ids":["c9b6b851-10f9-4bbf-881e-1d8a49adf7d8"],"entries":[],"created_at": "2014-01-01T12:00:00+00:00","updated_at": "2014-01-01T12:00:00+00:00","released_at": "2014-01-01T12:00:00+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"previous_page":-1,"next_page":-1,"per_page":25,"order":"created_at","order_asc_desc":"asc"}}';

        $entryPoint = new SettlementsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'settlements/find',
            [
                'created_at_from' => null,
                'created_at_to' => null,
                'updated_at_from' => null,
                'updated_at_to' => null,
                'released_at_from' => null,
                'short_reference' => null,
                'status' => null,
                'released_at_to' => null,
                'on_behalf_of' => null,
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null,
            ]
        )
        );

        $settlements = $entryPoint->find();

        $this->assertInstanceOf(Settlements::class, $settlements);
        $list = $settlements->getSettlements();

        $this->assertArrayHasKey(0, $list);
        $this->assertCount(1, $list);

        $this->validateObjectStrictName($list[0], json_decode($data, true)['settlements'][0]);
    }

    /**
     * @test
     */
    public function canFindWithAllParams()
    {
        $data = '{"settlements":[{"id":"a937f05e-e9fd-442e-a46f-11e84ba37806","short_reference":"20140101-BCDFGH","status":"open","conversion_ids":["c9b6b851-10f9-4bbf-881e-1d8a49adf7d8"],"entries":[],"created_at": "2014-01-01T12:00:00+00:00","updated_at": "2014-01-01T12:00:00+00:00","released_at": "2014-01-01T12:00:00+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"previous_page":-1,"next_page":-1,"per_page":25,"order":"created_at","order_asc_desc":"asc"}}';

        /* @var DateTime[] $dateTimes */
        $dateTimes = [
            new DateTime(),
            (new DateTime())->modify('-1 hour'),
            (new DateTime())->modify('-2 hour'),
            (new DateTime())->modify('-3 hour'),
            (new DateTime())->modify('-4 hour'),
            (new DateTime())->modify('-5 hour')
        ];

        $entryPoint = new SettlementsEntryPoint(
            new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'settlements/find',
            [
                'created_at_from' => $dateTimes[0]->format(DateTime::ISO8601),
                'created_at_to' => $dateTimes[1]->format(DateTime::ISO8601),
                'updated_at_from' => $dateTimes[2]->format(DateTime::ISO8601),
                'updated_at_to' => $dateTimes[3]->format(DateTime::ISO8601),
                'released_at_from' => $dateTimes[4]->format(DateTime::ISO8601),
                'released_at_to' => $dateTimes[5]->format(DateTime::ISO8601),
                'short_reference' => 'A',
                'status' => 'B',
                'on_behalf_of' => 'C',
                'page' => null,
                'per_page' => null,
                'order' => null,
                'order_asc_desc' => null,
            ]
        )
        );

        $criteria = new FindSettlementsCriteria();
        $criteria->setCreatedAtFrom($dateTimes[0])
            ->setCreatedAtTo($dateTimes[1])
            ->setUpdatedAtFrom($dateTimes[2])
            ->setUpdatedAtTo($dateTimes[3])
            ->setReleasedAtFrom($dateTimes[4])
            ->setReleasedAtTo($dateTimes[5]);


        $settlements = $entryPoint->find('A', 'B', $criteria, null, 'C');

        $this->assertInstanceOf(Settlements::class, $settlements);
        $list = $settlements->getSettlements();

        $this->assertArrayHasKey(0, $list);
        $this->assertCount(1, $list);

        $this->validateObjectStrictName($list[0], json_decode($data, true)['settlements'][0]);
    }
}
