<?php

namespace Behamin\BResources\Resources;

class BasicResourceCollection extends BasicResource
{
    public function __construct($resourceCollection, $transform = false)
    {
        parent::__construct($resourceCollection);
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
