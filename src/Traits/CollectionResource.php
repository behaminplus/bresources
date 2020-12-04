<?php
namespace Behamin\BResources\Traits;

trait CollectionResource
{
    public function __construct($collectionResource, $transform = false)
    {
        //send $transform to false because not set to root data with basic request
        parent::__construct($collectionResource, false);

        if ($transform) {
            $this->transform = $transform;
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