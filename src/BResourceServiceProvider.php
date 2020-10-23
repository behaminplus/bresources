<?php

namespace Behamin\BResources;

use Illuminate\Support\ServiceProvider;

class BResourceServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                '\Behamin\BResources\Console\MakeBResourceCommand',
                '\Behamin\BResources\Console\MakeBRequestCommand'
            ]);
        }
    }
}