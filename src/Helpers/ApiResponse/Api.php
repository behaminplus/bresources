<?php

namespace Behamin\BResources\Helpers\ApiResponse;

use Behamin\BResources\Resources\BasicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Api extends Response
{
    public function message(?string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function status(int $code): self
    {
        $this->status = $code;
        return $this;
    }

    public function data($data = null): ApiData
    {
        return (new ApiData($this->message, $this->status))->data($data);
    }

    public function collection($items, $count = null): ApiCollection
    {
        return (new ApiCollection($this->message, $this->status))->collection($items, $count);
    }

    public function errors(string $errorMessage, array $errors = []): ApiError
    {
        return (new ApiError($this->message, $this->status))->errors($errorMessage, $errors);
    }

    protected function respond(): JsonResource
    {
        return new BasicResource(['message' => $this->message]);
    }
}
