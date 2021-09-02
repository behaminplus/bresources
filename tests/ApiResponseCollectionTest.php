<?php


namespace Behamin\BResources\Tests;


class ApiResponseCollectionTest extends TestCase
{
    /** @test */
    public function mainKeysExistTest()
    {
        $resource = apiResponse()->collection([])->get()->getData(true);

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('error', $resource);
    }

    /** @test */
    public function errorKeysExistTest()
    {
        $resource = apiResponse()->collection([])->get()->getData(true);
        $errors = $resource['error'];

        $this->assertArrayHasKey('errors', $errors);
        $this->assertArrayHasKey('message', $errors);
    }

    /** @test */
    public function collectionKeysExistTest()
    {
        $resource = apiResponse()->collection([])->get()->getData(true);
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
        $resource = apiResponse()->collection($data)->get()->getData(true);
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
        $resource = apiResponse()->collection($data, 150)->get()->getData(true);
        $resourceData = $resource['data'];
        $this->assertEquals(150, $resourceData['count']);
    }

    /** @test */
    public function messageTest()
    {
        $resource = apiResponse()->collection([])->message('profile updated.')->get()->getData(true);
        $this->assertIsString($resource['message']);
        $this->assertEquals('profile updated.', $resource['message']);
    }

    /** @test */
    public function errorMessageTest()
    {
        $resource = apiResponse()->errors('invalid data.')->get()->getData(true);
        $this->assertIsString($resource['error']['message']);
        $this->assertEquals('invalid data.', $resource['error']['message']);
    }

}
