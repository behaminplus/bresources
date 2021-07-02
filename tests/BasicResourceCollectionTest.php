<?php

namespace Behamin\BResources\Tests;

use Behamin\BResources\Resources\BasicResourceCollection;

class BasicResourceCollectionTest extends TestCase
{
    /** @test */
    public function mainKeysExistTest()
    {
        $resource = (new BasicResourceCollection(['data' => []]))->toArray(null);

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('error', $resource);
    }

    /** @test */
    public function errorKeysExistTest()
    {
        $resource = (new BasicResourceCollection(['data' => []]))->toArray(null);
        $errors = $resource['error'];

        $this->assertArrayHasKey('errors', $errors);
        $this->assertArrayHasKey('message', $errors);
    }

    /** @test */
    public function collectionKeysExistTest()
    {
        $resource = (new BasicResourceCollection(['data' => []]))->toArray(null);
        $resourceData = $resource['data'];
        $this->assertArrayHasKey('items', $resourceData);
        $this->assertArrayHasKey('count', $resourceData);
        $this->assertArrayHasKey('sum', $resourceData);
    }

    /** @test */
    public function itemsTest()
    {
        $data = [
            [
                'key' => 'value'
            ],
            [
                'key' => 'value'
            ]

        ];
        $resource = (new BasicResourceCollection(['data' => $data]))->toArray(null);
        $resourceData = $resource['data'];
        $this->assertIsArray($resourceData['items']);
        $this->assertIsInt($resourceData['count']);
        $this->assertCount(2, $resourceData['items']);
        $this->assertEquals(2, $resourceData['count']);
    }

    /** @test */
    public function itemsCountTest()
    {
        $data = [
            [
                'key' => 'value'
            ]
        ];
        $resource = (new BasicResourceCollection(['data' => $data, 'count' => 150]))->toArray(null);
        $resourceData = $resource['data'];
        $this->assertEquals(150, $resourceData['count']);
    }

    /** @test */
    public function messageTest()
    {
        $resource = (new BasicResourceCollection(['message' => 'profile updated.']))->toArray(null);
        $this->assertIsString($resource['message']);
        $this->assertEquals('profile updated.', $resource['message']);
    }

    /** @test */
    public function errorMessageTest()
    {
        $resource = (new BasicResourceCollection(['error_message' => 'invalid data.']))->toArray(null);
        $this->assertIsString($resource['error']['message']);
        $this->assertEquals('invalid data.', $resource['error']['message']);
    }
}
