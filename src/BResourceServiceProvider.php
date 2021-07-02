<?php

namespace Behamin\BResources;

use Illuminate\Support\ServiceProvider;
use Behamin\BResources\Console\MakeBResourceCommand;
use Behamin\BResources\Console\MakeBResourceCollectionCommand;
use Behamin\BResources\Console\MakeBRequestCommand;

class BResourceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            MakeBResourceCommand::class,
            MakeBResourceCollectionCommand::class,
            MakeBRequestCommand::class
        ]);
    }

    public function boot()
    {
        //
    }
}
