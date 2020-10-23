<?php

namespace Behamin\BResources\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeBResourceCommand extends GeneratorCommand
{
    protected $name = 'make:bresource';
    protected $type = "BResource";

    protected function getStub()
    {
        return __DIR__ . '/stubs/resource.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Resources';
    }


    public function handle()
    {
        parent::handle();

        if ($this->option('collection')) {
            $this->createResourceCollection();
        }
    }

    protected function createResourceCollection()
    {
        $resourceName = Str::studly($this->argument('name'));

        $this->call('make:bcresource', [
            'name' => $resourceName . 'Collection',
            '--extends' => $resourceName
        ]);
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the resource class.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['collection', 'c', InputOption::VALUE_NONE, 'with creation collection resource'],
        ];
    }
}
