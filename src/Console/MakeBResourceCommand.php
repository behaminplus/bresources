<?php

namespace Behamin\BResources\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeBResourceCommand extends GeneratorCommand
{
    protected $signature = 'make:bresource {name} {--collection=: with creation collection resource}';
    protected $type = "BResource";

    protected function getStub()
    {
        return __DIR__ . '/stubs/resource.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Resources';
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

    public function handle()
    {
        parent::handle();

        if ($this->hasOption('collection')) {
            $this->createResourceCollection();
        }
    }

    protected function createResourceCollection()
    {
        $ResourceCollectionName = Str::studly($this->getResourceCollectionName());

        $this->call('make:bcresource', [
            'name' => $ResourceCollectionName,
        ]);
    }

    /**
     * @return string
     */
    protected function getResourceCollectionName()
    {
        $name = $this->argument('name');

        $hasResourceWordEnd = preg_match('/resource$/i', $name, $match);
        if ($hasResourceWordEnd) {
            return Str::replaceArray($match[0], [''], $name) . 'Resource' . 'Collection';
        }

        return $name . 'Collection';
    }
}