<?php

namespace Behamin\BResources\Helpers\ApiResponse;

use Behamin\BResources\Resources\BasicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiMessage extends Response
{

    public function message(string $message): self
    {
        return parent::message($message);
    }

    protected function respond(): JsonResource
    {
        $data = ['message' => $this->getMessage()];
        if ($this->getNext() != null) {
            $data = $data + ["next" => $this->getNext()];
        }
        return new BasicResource($data);
    }
}
