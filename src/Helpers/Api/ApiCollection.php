<?php

namespace Behamin\BResources\Helpers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiCollection extends Response
{
    private $items;
    private ?int $count;

    public function collection($items, ?int $count = null): self
    {
        $this->items = $items;
        $this->count = $count;

        return $this;
    }

    protected function respond(): JsonResource
    {
        $resource = [
            'data' => $this->items,
            'count' => $this->count,
            'message' => $this->getMessage()
        ];

        if ($this->getNext() !== "undefined") {
            $resource += [
                "next" => $this->getNext()
            ];
        }

        $jsonResource = $this->getJsonResource();

        return $jsonResource::collection($resource);
    }
}
