<?php

namespace Behamin\BResources\Tests;

use Behamin\BResources\BResourceServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            BResourceServiceProvider::class
        ];
    }

    protected function getResourcePath(?string $resourceFileName = null): string
    {
        return app_path("Http/Resources"."/$resourceFileName");
    }

    protected function getRequestPath(?string $requestFileName = null): string
    {
        return app_path("Http/Requests"."/$requestFileName");
    }
}
