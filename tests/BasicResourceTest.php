<?php

namespace Behamin\BResources\Tests;

use stdClass;
use Behamin\BResources\Resources\BasicResource;

class BasicResourceTest extends TestCase
{
    /** @test */
    public function mainKeysExistTest()
    {
        $resource = (new BasicResource(['data' => null]))->toArray(null);

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('error', $resource);
    }

    /** @test */
    public function errorKeysExistTest()
    {
        $resource = (new BasicResource(['data' => null]))->toArray(null);
        $errors = $resource['error'];

        $this->assertArrayHasKey('errors', $errors);
        $this->assertArrayHasKey('message', $errors);
    }

    /** @test */
    public function dataTest()
    {
        $resource = (new BasicResource(['data' => null]))->toArray(null);
        $this->assertNull($resource['data']);

        $data = [
            'key' => 'value'
        ];
        $resource = (new BasicResource(['data' => $data]))->toArray(null);
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
        $resource = (new BasicResource(['data' => $data]))->toArray(null);
        $this->assertIsArray($resource['data']);
        $this->assertCount(2, $resource['data']);
    }

    /** @test */
    public function objectDataTest()
    {
        $data = (object) [
            'key' => 'value'
        ];
        $resource = (new BasicResource(['data' => $data]))->toArray(null);
        $this->assertIsObject($resource['data']);
        $this->assertObjectHasAttribute('key', $resource['data']);
    }

    /** @test */
    public function emptyObjectDataToNullConversionTest()
    {
        $data = new stdClass();
        $resource = (new BasicResource(['data' => $data]))->toArray(null);
        $this->assertNull($resource['data']);
    }

    /** @test */
    public function messageTest()
    {
        $resource = (new BasicResource(['message' => 'form submitted.']))->toArray(null);
        $this->assertIsString($resource['message']);
        $this->assertEquals('form submitted.', $resource['message']);
    }

    /** @test */
    public function errorMessageTest()
    {
        $resource = (new BasicResource(['error_message' => 'invalid data.']))->toArray(null);
        $this->assertIsString($resource['error']['message']);
        $this->assertEquals('invalid data.', $resource['error']['message']);
    }
}
