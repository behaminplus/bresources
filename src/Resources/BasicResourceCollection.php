<?php

namespace Behamin\BResources\Resources;

class BasicResourceCollection extends BasicResource
{
    public function __construct($collectionResource, $transform = false)
    {
        parent::__construct($collectionResource);

        if ($transform) {
            $this->transformData();
        } else {
            $this->data = [
                'items' => $this['data'],
                'count' => $this->count ?? count($this->data),
                'sum' => $this->sum
            ];
        }
    }

    protected function transformData()
    {
        $this->data = [
            'items' => $this['data']->transform(function ($item) {
                return $this->getArray($item);
            }),
            'count' => $this->count ?? count($this->data),
            'sum' => $this->sum
        ];
    }
}
