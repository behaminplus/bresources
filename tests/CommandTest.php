<?php

namespace Behamin\BResources\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CommandTest extends TestCase
{
    /** @test */
    public function makeBResourceCommandCreatesResourceClassTest()
    {
        $resourceFileName = 'TestResource.php';
        if (File::exists($this->getResourcePath($resourceFileName))) {
            unlink($this->getResourcePath($resourceFileName));
        }
        $this->assertFalse(File::exists($this->getResourcePath($resourceFileName)));
        Artisan::call('make:bresource TestResource');
        $this->assertTrue(File::exists($this->getResourcePath($resourceFileName)));
    }

    /** @test */
    public function makeBResourceCollectionCommandCreatesResourceCollectionClassTest()
    {
        $resourceFileName = 'TestResourceCollection.php';
        if (File::exists($this->getResourcePath($resourceFileName))) {
            unlink($this->getResourcePath($resourceFileName));
        }
        $this->assertFalse(File::exists($this->getResourcePath($resourceFileName)));
        Artisan::call('make:bcresource TestResourceCollection');
        $this->assertTrue(File::exists($this->getResourcePath($resourceFileName)));
    }

    /** @test */
    public function makeBRequestCommandCreatesRequestClassTest()
    {
        $requestFileName = 'TestRequest.php';
        if (File::exists($this->getRequestPath($requestFileName))) {
            unlink($this->getRequestPath($requestFileName));
        }
        $this->assertFalse(File::exists($this->getRequestPath($requestFileName)));
        Artisan::call('make:brequest TestRequest');
        $this->assertTrue(File::exists($this->getRequestPath($requestFileName)));
    }
}
