<?php

namespace Behamin\BResources\Helpers\ApiResponse;

class Api
{
    public function data($data): ApiData
    {
        return (new ApiData())->data($data);
    }

    public function collection($items, ?int $count = null): ApiCollection
    {
        return (new ApiCollection())->collection($items, $count);
    }

    public function errors(string $errorMessage, array $errors = []): ApiError
    {
        return (new ApiError())->errors($errorMessage, $errors);
    }

    public function message(string $message): ApiMessage
    {
        return (new ApiMessage())->message($message);
    }
}
