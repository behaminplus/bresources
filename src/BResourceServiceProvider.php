<?php

namespace Behamin\BResources;

use Behamin\BResources\Console\MakeBRequestCommand;
use Behamin\BResources\Console\MakeBResourceCommand;
use Illuminate\Support\ServiceProvider;

class BResourceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            MakeBResourceCommand::class,
            MakeBRequestCommand::class
        ]);
    }

    public function boot()
    {
        //
    }
}
