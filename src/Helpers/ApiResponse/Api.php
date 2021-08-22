<?php

namespace Behamin\BResources\Helpers\ApiResponse;

use Behamin\BResources\Helpers\Exceptions\NotImplementedException;
use Behamin\BResources\Resources\BasicResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class Api
{
    private ?string $message = null;
    private int $status = Response::HTTP_OK;

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

    public function data($data = null): JsonResponse
    {
        return (new ApiData($this->message, $this->status))->data($data);
    }

    public function respond(): JsonResponse
    {
        return response()->json(new BasicResource(['message' => $this->message]), $this->status);
    }

    public function collection($items, $count): JsonResponse
    {
        return (new ApiCollection($this->message, $this->status))->collection($items, $count);
    }

    public function errors()
    {
        throw new NotImplementedException();
    }
}
