<?php

namespace Behamin\BResources\Tests;

use Behamin\BResources\BResourceServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            BResourceServiceProvider::class
        ];
    }
}
