<?php

namespace Behamin\BResources\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CommandTest extends TestCase
{
    protected string $resourceFileName = 'TestResource.php';
    protected string $requestFileName = 'TestRequest.php';

    /** @test */
    public function makeBResourceCommandCreatesResourceClassTest(): void
    {
        Artisan::call('make:bresource TestResource');
        $this->assertTrue(File::exists($this->getResourcePath($this->resourceFileName)));
    }

    /** @test */
    public function makeBRequestCommandCreatesRequestClassTest(): void
    {
        Artisan::call('make:brequest TestRequest');
        $this->assertTrue(File::exists($this->getRequestPath($this->requestFileName)));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->removeRequestAndResourceFile();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->removeRequestAndResourceFile();
    }

    protected function removeRequestAndResourceFile(): void
    {
        if (File::exists($this->getResourcePath($this->resourceFileName))) {
            unlink($this->getResourcePath($this->resourceFileName));
        }

        if (File::exists($this->getResourcePath($this->requestFileName))) {
            unlink($this->getResourcePath($this->requestFileName));
        }
    }
}
