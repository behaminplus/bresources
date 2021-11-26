<?php

namespace Behamin\BResources\Helpers\Api;

class ApiResponse
{
    public function collection($items, ?int $count = null, ?array $sums = null): ApiCollection
    {
        return (new ApiCollection())->collection($items, $count, $sums);
    }

    public function data($data): ApiData
    {
        return (new ApiData())->data($data);
    }

    public function message(string $message): ApiData
    {
        return (new ApiData())->message($message);
    }

    public function next(string $next): ApiData
    {
        return (new ApiData())->next($next);
    }

    public function back(string $back): ApiData
    {
        return (new ApiData())->back($back);
    }

    public function errors(string $errorMessage, ?array $errors = null): ApiError
    {
        return (new ApiError())->errors($errorMessage, $errors);
    }
}
