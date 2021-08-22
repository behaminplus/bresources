<?php


namespace Behamin\BResources\Helpers\ApiResponse;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class Response
{
    protected ?string $message;
    private int $status;

    public function __construct(?string $message, int $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    abstract protected function respond(): JsonResource;

    public function get(): JsonResponse
    {
        return response()->json($this->respond(), $this->status);
    }
}
