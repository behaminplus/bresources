<?php

namespace Behamin\BResources\Tests;

class ApiResponseCollectionTest extends TestCase
{
    /** @test */
    public function mainKeysExistTest(): void
    {
        $resource = apiResponse()->collection([])->get()->getData(true);

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('error', $resource);
    }

    /** @test */
    public function errorKeysExistTest(): void
    {
        $resource = apiResponse()->collection([])->get()->getData(true);
        $errors = $resource['error'];

        $this->assertArrayHasKey('errors', $errors);
        $this->assertArrayHasKey('message', $errors);
    }

    /** @test */
    public function collectionKeysExistTest(): void
    {
        $resource = apiResponse()->collection([])->get()->getData(true);
        $resourceData = $resource['data'];

        $this->assertArrayHasKey('items', $resourceData);
        $this->assertArrayHasKey('count', $resourceData);
        $this->assertArrayHasKey('sum', $resourceData);
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
        $resource = apiResponse()->collection($data)->get()->getData(true);
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
        $resource = apiResponse()->collection($data, 150)->get()->getData(true);
        $resourceData = $resource['data'];

        $this->assertEquals(150, $resourceData['count']);
    }

    /** @test */
    public function messageTest(): void
    {
        $resource = apiResponse()->collection([])->message('profile updated.')->get()->getData(true);

        $this->assertIsString($resource['message']);
        $this->assertEquals('profile updated.', $resource['message']);
    }

    /** @test */
    public function errorMessageTest(): void
    {
        $resource = apiResponse()->errors('invalid data.')->get()->getData(true);

        $this->assertIsString($resource['error']['message']);
        $this->assertEquals('invalid data.', $resource['error']['message']);
    }

    /** @test */
    public function nextCollectionTest()
    {
        $resource = apiResponse()->collection([])->next('https://debug.test')->get()->getData(true);

        $this->assertIsString($resource['next']);
        $this->assertEquals('https://debug.test', $resource['next']);
    }

    /** @test */
    public function nextDataTest()
    {
        $resource = apiResponse()->data([])->next('https://debug.test')->get()->getData(true);

        $this->assertIsString($resource['next']);
        $this->assertEquals('https://debug.test', $resource['next']);
    }

    /** @test */
    public function nextMessageTest()
    {
        $resource = apiResponse()->message('')->next('https://debug.test')->get()->getData(true);

        $this->assertIsString($resource['next']);
        $this->assertEquals('https://debug.test', $resource['next']);
    }

    /** @test */
    public function nextErrorTest()
    {
        $resource = apiResponse()->errors('')->next('https://debug.test')->get()->getData(true);

        $this->assertIsString($resource['next']);
        $this->assertEquals('https://debug.test', $resource['next']);
    }
}
