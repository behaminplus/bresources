<?php

namespace Behamin\BResources\Helpers\ApiResponse;

use Behamin\BResources\Resources\BasicResource;
use Illuminate\Http\JsonResponse;

class ApiData
{
    private ?string $message;
    private int $status;

    public function __construct(?string $message, int $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    public function data($data): JsonResponse
    {
        return response()->json(new BasicResource(['data' => $data, 'message' => $this->message]), $this->status);
    }
}
