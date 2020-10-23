<?php

namespace Behamin\BResources\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeBResourceCollectionCommand extends GeneratorCommand
{
    protected $signature = 'make:bcresource {name}';
    protected $type = "BResourceCollection";

    protected function getStub()
    {
        return __DIR__ . '/stubs/resource-collection.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Resources';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the collection resource class.'],
        ];
    }
}