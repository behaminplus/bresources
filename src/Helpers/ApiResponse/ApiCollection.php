<?php

namespace Behamin\BResources\Helpers\ApiResponse;

use Behamin\BResources\Resources\BasicResourceCollection;
use Illuminate\Http\JsonResponse;

class ApiCollection
{
    private ?string $message;
    private int $status;

    public function __construct(?string $message, int $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    public function collection($items, int $count): JsonResponse
    {
        return response()->json(new BasicResourceCollection(
            ['data' => $items, 'count' => $count, 'message' => $this->message]),
            $this->status
        );
    }
}
