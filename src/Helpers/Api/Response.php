<?php

namespace Behamin\BResources\Helpers\Api;

use Behamin\BResources\Resources\BasicResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as HttpResponse;

abstract class Response
{
    protected const UNDEFINED_NEXT = 'undefined';

    protected string $jsonResource = BasicResource::class;

    private ?string $message;
    private ?string $next;
    private int $status;

    public function __construct(
        ?string $message = null,
        int $status = HttpResponse::HTTP_OK,
        ?string $next = self::UNDEFINED_NEXT
    ) {
        $this->message = $message;
        $this->next = $next;
        $this->status = $status;
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

    public function jsonResource(string $jsonResource): self
    {
        $this->jsonResource = $jsonResource;

        return $this;
    }

    public function get(): JsonResponse
    {
        return response()->json($this->respond(), $this->getStatus());
    }

    protected function getMessage(): ?string
    {
        return $this->message;
    }

    protected function getStatus(): int
    {
        return $this->status;
    }

    protected function getNext(): ?string
    {
        return $this->next;
    }

    protected function getJsonResource(): string
    {
        return $this->jsonResource;
    }

    abstract protected function respond(): JsonResource;
}
