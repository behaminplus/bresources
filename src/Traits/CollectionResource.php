<?php
namespace Behamin\BResources\Traits;

trait CollectionResource
{
    public function __construct($collectionResource, $byPass = false)
    {
        parent::__construct($collectionResource, true);

        if (! $byPass) {
            $this->reData();
        } else {
            $this->reDataByPass();
        }
    }

    protected function reDataByPass()
    {
        $this->data = [
            'items' => $this['data'],
            'count' => $this->count
        ];
    }

    protected function reData()
    {
        $this->data = [
            'items' => $this['data']->transform(function ($item) {
                return $this->getArray($item);
            }),
            'count' => $this->count
        ];
    }
}