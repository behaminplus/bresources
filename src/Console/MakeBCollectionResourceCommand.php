<?php

namespace Behamin\BResources\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeBCollectionResourceCommand extends GeneratorCommand
{
    protected $signature = 'make:bcresource {name}';
    protected $type = "BCollectionResource";

    protected function getStub()
    {
        return __DIR__ . '/stubs/collection-resource.stub';
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