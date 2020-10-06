<?php

namespace Behamin\BResources\Resources;

class BasicCollectionResource extends BasicResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->data = [
            'items' => $this['data'],
            'count' => $this->count ? $this->count : sizeof($this->data)
        ];
    }
}
