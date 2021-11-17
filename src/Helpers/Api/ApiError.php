<?php

namespace Behamin\BResources\Helpers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiError extends Response
{
    private string $errorMessage;
    private ?array $errors;

    public function errors(string $errorMessage, ?array $errors = null): self
    {
        $this->errorMessage = $errorMessage;
        $this->errors = $errors;

        return $this;
    }

    protected function respond(): JsonResource
    {
        $resource = [
            'error_message' => $this->errorMessage,
            'errors' => $this->errors,
            'message' => $this->getMessage()
        ];

        if ($this->getNext() !== self::UNDEFINED_NEXT) {
            $resource += [
                'next' => $this->getNext()
            ];
        }

        $jsonResource = $this->getJsonResource();

        return new $jsonResource($resource);
    }
}
