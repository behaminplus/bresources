<?php

namespace Behamin\BResources\Resources;

class BasicResourceCollection extends BasicResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->data = [
            'items' => $this['data']->transform(function ($item) {
                return $this->getArray($item);
            }),
            'count' => $this->count
        ];
    }
}
