<?php

namespace Behamin\BResources\Helpers\Api;

use Behamin\BResources\Resources\BasicResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as HttpResponse;

abstract class Response implements Responsable
{
    protected const UNDEFINED = 'undefined';

    protected string $jsonResource = BasicResource::class;

    private ?string $message;
    private ?string $next;
    private ?string $back;
    private int $status;

    public function __construct(
        ?string $message = null,
        int $status = HttpResponse::HTTP_OK,
        ?string $next = self::UNDEFINED,
        ?string $back = self::UNDEFINED
    ) {
        $this->message = $message;
        $this->status = $status;
        $this->next = $next;
        $this->back = $back;
    }

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

    public function next(?string $next): self
    {
        $this->next = $next;

        return $this;
    }

    public function back(?string $back): self
    {
        $this->back = $back;

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

    protected function getBack(): ?string
    {
        return $this->back;
    }

    protected function getJsonResource(): string
    {
        return $this->jsonResource;
    }

    abstract protected function respond(): JsonResource;

    public function toResponse($request = null): JsonResponse
    {
        return $this->get();
    }
}
