<?php


namespace Behamin\BResources\Helpers\ApiResponse;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as HttpResponse;

abstract class Response
{
    protected ?string $message;
    protected int $status;

    public function __construct(?string $message = null, int $status = HttpResponse::HTTP_OK)
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
