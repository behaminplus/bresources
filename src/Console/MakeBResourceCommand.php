<?php

namespace Behamin\BResources\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeBResourceCommand extends GeneratorCommand
{
    protected $name = 'make:bresource';
    protected $type = 'BResource';

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
        if ($this->isCollectionResName()){
            $this->createResourceCollection(false);
            return true;
        }

        parent::handle();

        if ($this->option('collection')) {
            $this->createResourceCollection();
        }
    }

    protected function createResourceCollection($withResource = true )
    {
        $resourceName = Str::studly($this->argument('name'));
        $resourceName = $this->isCollectionResName() ?  $resourceName : $resourceName . 'Collection';
        $arguments = [
            'name' => $resourceName
        ];
        if ($withResource){
            $arguments['--extends'] = Str::replaceLast('Collection', '', $resourceName);
        }

        $this->call('make:bcresource', $arguments);
    }

    protected function isCollectionResName(){
        return preg_match('/.+collection$/i',  $this->argument('name'));
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
            ['collection', 'c', InputOption::VALUE_NONE, 'with resource collection creation'],
        ];
    }
}
