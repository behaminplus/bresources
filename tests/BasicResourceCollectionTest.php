<?php

namespace Behamin\BResources\Tests;

use Behamin\BResources\Resources\BasicResource;

class BasicResourceCollectionTest extends TestCase
{
    /** @test */
    public function mainKeysExistTest(): void
    {
        $resource = BasicResource::collection(['data' => []])->toArray();

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('error', $resource);
    }

    /** @test */
    public function errorKeysExistTest(): void
    {
        $resource = BasicResource::collection(['data' => []])->toArray();
        $errors = $resource['error'];

        $this->assertArrayHasKey('errors', $errors);
        $this->assertArrayHasKey('message', $errors);
    }

    /** @test */
    public function collectionKeysExistTest(): void
    {
        $resource = BasicResource::collection(['data' => []])->toArray();
        $resourceData = $resource['data'];

        $this->assertArrayHasKey('items', $resourceData);
        $this->assertArrayHasKey('count', $resourceData);
        $this->assertArrayHasKey('sums', $resourceData);
    }

    /** @test */
    public function itemsTest(): void
    {
        $data = [
            [
                'key' => 'value'
            ],
            [
                'key' => 'value'
            ]

        ];
        $resource = BasicResource::collection(['data' => $data])->toArray();
        $resourceData = $resource['data'];

        $this->assertIsArray($resourceData['items']);
        $this->assertIsInt($resourceData['count']);
        $this->assertCount(2, $resourceData['items']);
        $this->assertEquals(2, $resourceData['count']);
    }

    /** @test */
    public function itemsCountTest(): void
    {
        $data = [
            [
                'key' => 'value'
            ]
        ];
        $resource = BasicResource::collection(['data' => $data, 'count' => 150])->toArray();
        $resourceData = $resource['data'];

        $this->assertEquals(150, $resourceData['count']);
    }
}
