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
            $this->createCollectionRecourse();
        }
    }

    protected function createCollectionRecourse()
    {
        $collectionResourceName = Str::studly($this->getCollectionResourceName());

        $this->call('make:bcresource', [
            'name' => $collectionResourceName,
        ]);
    }

    /**
     * @return string
     */
    protected function getCollectionResourceName()
    {
        $name = $this->argument('name');

        $hasResourceWordEnd = preg_match('/resource$/i', $name, $match);
        if ($hasResourceWordEnd) {
            return Str::replaceArray($match[0], [''], $name) . 'Collection' . 'Resource';
        }

        return $name . 'Collection';
    }
}