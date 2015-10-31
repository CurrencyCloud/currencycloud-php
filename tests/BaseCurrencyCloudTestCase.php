<?php

namespace CurrencyCloud\Tests;

use CurrencyCloud\Client;
use CurrencyCloud\SimpleEntityManager;
use DateTime;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

class BaseCurrencyCloudTestCase extends PHPUnit_Framework_TestCase
{

    /**
     * @param $returns
     * @param $method
     * @param $path
     * @param array $query
     * @param array $request
     * @param array $options
     * @param bool|true $secured
     *
     * @return Client
     */
    protected function getMockedClient($returns, $method, $path, $query = [], $request = [], $options = [], $secured = true)
    {
        $mock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->once())->method('request')
            ->with($method, $path, $query, $request, $options, $secured)
            ->will($this->returnValue($returns));

        return $mock;
    }

    /**
     * @param $expectedModel
     * @param $changeSet
     *
     * @return SimpleEntityManager
     */
    protected function getMockedEntityManager($expectedModel, $changeSet)
    {
        $mock = $this->getMockBuilder(SimpleEntityManager::class)
            ->getMock();

        $mock->expects($this->once())->method('computeChangeSet')
            ->with($expectedModel)
            ->will($this->returnValue($changeSet));

        return $mock;
    }

    protected function validateObjectStrictName($object, $dummy)
    {
        $this->assertInternalType('object', $object);
        foreach ($dummy as $key => $original) {
            $parts = explode('_', $key);
            $uCased = implode('', array_map('ucfirst', $parts));
            $getter = sprintf('get%s', $uCased);
            if (!is_callable([$object, $getter])) {
                $getter = sprintf('is%s', $uCased);
                if (!is_callable([$object, $getter])) {
                    $this->fail(
                        sprintf('Found property "%s" but not method "(is|get)%s". Is it wrongly named?', $key, $uCased)
                    );
                }
            }
            $value = $object->$getter();
            if ($value instanceof DateTime) {
                $value = $value->getTimestamp();
                $original = (new DateTime($original))->getTimestamp();
            } else if (is_bool($value)) {
                if (!is_bool($original)) {
                    $value = $value ? 'true' : 'false';
                }
            }
            $this->assertEquals($original, $value, sprintf('Property "%s" with method "%s"', $key, $getter));
            unset($dummy[$key]);
        }
        $this->assertEquals(0, count($dummy));
    }

    /**
     * @return array
     */
    protected function getDummyPagination()
    {
        return [
            'total_entries' => 1,
            'total_pages' => 1,
            'current_page' => 1,
            'per_page' => 25,
            'previous_page' => -1,
            'next_page' => 2,
            'order' => 'created_at',
            'order_asc_desc' => 'asc'
        ];
    }

    /**
     * @param object $object
     * @param mixed $value
     * @param string $propertyName
     */
    protected function setIdProperty($object, $value, $propertyName = 'id')
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }
}
