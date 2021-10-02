<?php

namespace Behamin\BResources\Tests;

use stdClass;
use Behamin\BResources\Resources\BasicResource;

class BasicResourceTest extends TestCase
{
    /** @test */
    public function mainKeysExistTest(): void
    {
        $resource = (new BasicResource(['data' => null]))->toArray();

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('error', $resource);
    }

    /** @test */
    public function errorKeysExistTest(): void
    {
        $resource = (new BasicResource(['data' => null]))->toArray();
        $errors = $resource['error'];

        $this->assertArrayHasKey('errors', $errors);
        $this->assertArrayHasKey('message', $errors);
    }

    /** @test */
    public function dataTest(): void
    {
        $resource = (new BasicResource(['data' => null]))->toArray();
        $this->assertNull($resource['data']);

        $data = [
            'key' => 'value'
        ];
        $resource = (new BasicResource(['data' => $data]))->toArray();
        $this->assertArrayHasKey('key', $resource['data']);
        $this->assertEquals('value', $resource['data']['key']);
    }

    /** @test */
    public function arrayDataTest(): void
    {
        $data = [
            [
                'key' => 'value'
            ],
            [
                'key' => 'value'
            ]

        ];
        $resource = (new BasicResource(['data' => $data]))->toArray();
        $this->assertIsArray($resource['data']);
        $this->assertCount(2, $resource['data']);
    }

    /** @test */
    public function objectDataTest(): void
    {
        $data = (object) [
            'key' => 'value'
        ];
        $resource = (new BasicResource(['data' => $data]))->toArray();
        $this->assertIsObject($resource['data']);
        $this->assertObjectHasAttribute('key', $resource['data']);
    }

    /** @test */
    public function emptyObjectDataToNullConversionTest(): void
    {
        $data = new stdClass();
        $resource = (new BasicResource(['data' => $data]))->toArray();
        $this->assertNull($resource['data']);
    }

    /** @test */
    public function messageTest(): void
    {
        $resource = (new BasicResource(['message' => 'form submitted.']))->toArray();
        $this->assertIsString($resource['message']);
        $this->assertEquals('form submitted.', $resource['message']);
    }

    /** @test */
    public function errorMessageTest(): void
    {
        $resource = (new BasicResource(['error_message' => 'invalid data.']))->toArray();
        $this->assertIsString($resource['error']['message']);
        $this->assertEquals('invalid data.', $resource['error']['message']);
    }

    /** @test */
    public function additionalKeysTest(): void
    {
        $resource = (new BasicResource([
            'next' => 'path',
            'back' => 'previous'
        ]))->toArray();

        $this->assertArrayHasKey('next', $resource);
        $this->assertArrayHasKey('back', $resource);
        $this->assertEquals('path', $resource['next']);
        $this->assertEquals('previous', $resource['back']);
    }
}
