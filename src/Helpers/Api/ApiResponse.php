<?php

namespace Behamin\BResources\Helpers\Api;

class ApiResponse
{
    public function data($data): ApiData
    {
        return (new ApiData())->data($data);
    }

    public function message(string $message): ApiData
    {
        return (new ApiData())->message($message);
    }

    public function collection($items, ?int $count = null): ApiCollection
    {
        return (new ApiCollection())->collection($items, $count);
    }

    public function errors(string $errorMessage, ?array $errors = null): ApiError
    {
        return (new ApiError())->errors($errorMessage, $errors);
    }
}
