<?php


namespace Behamin\BResources\Tests;


class ApiResponseTest extends TestCase
{
    /** @test */
    public function test_mainKeysExistTest()
    {
        $resource = json_decode(apiResponse()->data([])->content(), true);

        $this->assertArrayHasKey('data', $resource);
        $this->assertArrayHasKey('message', $resource);
        $this->assertArrayHasKey('error', $resource);
    }
}
