<?php
namespace Behamin\BResources\Traits;

trait CollectionResource
{
    public function __construct($collectionResource, $transform = false)
    {
        parent::__construct($collectionResource, false);

        if ($transform) {
            $this->transformData();
        } else {
            $this->getData();
        }
    }

    protected function transformData()
    {
        $this->data = [
            'items' => $this['data']->transform(function ($item) {
                return $this->getArray($item);
            }),
            'count' => $this->count
        ];
    }

    protected function getData()
    {
        $this->data = [
            'items' => $this['data'],
            'count' => $this->count
        ];
    }
}