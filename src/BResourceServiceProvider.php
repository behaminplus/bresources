<?php

namespace Behamin\BResources;

use Illuminate\Support\ServiceProvider;
use \Behamin\BResources\Console\MakeBResourceCommand;
use \Behamin\BResources\Console\MakeBResourceCollectionCommand;
use \Behamin\BResources\Console\MakeBRequestCommand;

class BResourceServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeBResourceCommand::class,
                MakeBResourceCollectionCommand::class,
                MakeBRequestCommand::class
            ]);
        }
    }
}