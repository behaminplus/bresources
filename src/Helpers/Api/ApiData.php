<?php

namespace Behamin\BResources\Helpers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiData extends Response
{
    private $data;

    public function data($data): self
    {
        $this->data = $data;

        return $this;
    }

    protected function respond(): JsonResource
    {
        $resource = [
            'data' => $this->data,
            'message' => $this->getMessage()
        ];

        if ($this->getNext() !== self::UNDEFINED_NEXT) {
            $resource += [
                'next' => $this->getNext()
            ];
        }

        $jsonResource = $this->getJsonResource();

        return new $jsonResource($resource);
    }
}
