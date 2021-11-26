<?php

namespace Behamin\BResources\Helpers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiCollection extends Response
{
    private $items;
    private ?int $count;
    private ?array $sums;

    public function collection($items, ?int $count = null, ?array $sums = null): self
    {
        $this->items = $items;
        $this->count = $count;
        $this->sums = $sums;

        return $this;
    }

    protected function respond(): JsonResource
    {
        $resource = [
            'data' => $this->items,
            'count' => $this->count,
            'sums' => $this->sums,
            'message' => $this->getMessage()
        ];

        if ($this->getNext() !== "undefined") {
            $resource += [
                "next" => $this->getNext()
            ];
        }

        if ($this->getBack() !== "undefined") {
            $resource += [
                "back" => $this->getBack()
            ];
        }

        $jsonResource = $this->getJsonResource();

        return $jsonResource::collection($resource);
    }
}
