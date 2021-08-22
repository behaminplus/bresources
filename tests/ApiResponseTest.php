<?php


namespace Behamin\BResources\Tests;


use stdClass;

class ApiResponseTest extends TestCase
{
    /** @test */
    public function mainKeysExistTest()
    {
        $resource = apiResponse()->data([])->get()->getData(true);

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('error', $resource);
    }

    /** @test */
    public function errorKeysExistTest()
    {
        $resource = apiResponse()->get()->getData(true);
        $errors = $resource['error'];

        $this->assertArrayHasKey('errors', $errors);
        $this->assertArrayHasKey('message', $errors);
    }

    /** @test */
    public function dataTest()
    {
        $resource =apiResponse()->get()->getData(true);
        $this->assertNull($resource['data']);

        $data = [
            'key' => 'value'
        ];
        $resource = apiResponse()->data($data)->get()->getData(true);
        $this->assertArrayHasKey('key', $resource['data']);
        $this->assertEquals('value', $resource['data']['key']);
    }

    /** @test */
    public function arrayDataTest()
    {
        $data = [
            [
                'key' => 'value'
            ],
            [
                'key' => 'value'
            ]

        ];
        $resource = apiResponse()->data($data)->get()->getData(true);
        $this->assertIsArray($resource['data']);
        $this->assertCount(2, $resource['data']);
    }

    /** @test */
    public function emptyObjectDataToNullConversionTest()
    {
        $data = new stdClass();
        $resource = apiResponse()->data($data)->get()->getData(true);
        $this->assertNull($resource['data']);
    }

    /** @test */
    public function messageTest()
    {
        $resource = apiResponse()->message('form submitted.')->get()->getData(true);
        $this->assertIsString($resource['message']);
        $this->assertEquals('form submitted.', $resource['message']);
    }

    /** @test */
    public function errorMessageTest()
    {
        $resource = apiResponse()->errors('invalid data.')->get()->getData(true);
        $this->assertIsString($resource['error']['message']);
        $this->assertEquals('invalid data.', $resource['error']['message']);
    }
}
