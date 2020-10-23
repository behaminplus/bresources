<?php

namespace Behamin\BResources\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeBRequestCommand extends GeneratorCommand
{
    protected $signature = 'make:brequest {name}';
    protected $type = "BRequest";

    protected function getStub()
    {
        return __DIR__ . '/stubs/request.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Requests';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the request class.'],
        ];
    }
}