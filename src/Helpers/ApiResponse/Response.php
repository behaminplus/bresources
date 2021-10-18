<?php


namespace Behamin\BResources\Helpers\ApiResponse;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as HttpResponse;

abstract class Response
{
    private ?string $message;
    private ?string $next;
    private int $status;

    public function __construct(?string $message = null, int $status = HttpResponse::HTTP_OK, ?string $next = "undefined")
    {
        $this->message = $message;
        $this->next = $next;
        $this->status = $status;
    }

    public function getNext(): ?string
    {
        return $this->next;
    }

    protected function getMessage(): ?string
    {
        return $this->message;
    }

    protected function getStatus(): int
    {
        return $this->status;
    }

    abstract protected function respond(): JsonResource;

    public function get(): JsonResponse
    {
        return response()->json($this->respond(), $this->status);
    }

    public function message(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function status(int $code): self
    {
        $this->status = $code;
        return $this;
    }

    public function next(string $next): self
    {
        $this->next = $next;
        return $this;
    }
}
