<?php

namespace Behamin\BResources\Traits;

use Illuminate\Support\Collection;

trait CollectionResource
{
    public function __construct($collectionResource, $transform = false)
    {
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
        if ($this->data instanceof Collection) {
            $items = $this->data->transform(function ($item) {
                return $this->getArray($item);
            });
        } else {
            $items = $this->getArray($this->data);
        }

        $this->data = [
            'items' => $items,
            'count' => $this->count ?? count($this->data),
            'sum' => $this->sum
        ];
    }

    protected function getData()
    {
        $this->data = [
            'items' => $this->data,
            'count' => $this->count ?? count($this->data),
            'sum' => $this->sum
        ];
    }
}
