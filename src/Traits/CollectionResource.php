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

    protected function transformData(): void
    {
        if ($this->data instanceof Collection) {
            $items = $this->data->transform(function ($item) {
                return $this->getArray($item);
            });
        } else {
            $items = array_map(function ($item) {
                return $this->getArray($item);
            }, $this->data);
        }

        $this->data = [
            'items' => $items,
            'count' => $this->count ?? (is_countable($this->data) ? count($this->data) : 0),
            'sum' => $this->sum
        ];
    }

    protected function getData(): void
    {
        $this->data = [
            'items' => $this->data,
            'count' => $this->count ?? (is_countable($this->data) ? count($this->data) : 0),
            'sum' => $this->sum
        ];
    }
}
