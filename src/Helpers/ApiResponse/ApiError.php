<?php


namespace Behamin\BResources\Helpers\ApiResponse;


use Behamin\BResources\Resources\BasicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiError extends Response
{
    private string $errorMessage;
    private array $errors;

    public function errors(string $errorMessage, array $errors = []): self
    {
        $this->errorMessage = $errorMessage;
        $this->errors = $errors;
        return $this;
    }

    protected function respond(): JsonResource
    {
        return new BasicResource([
            'error_message' => $this->errorMessage,
            'errors' => $this->errors,
            'message' => $this->getMessage()
        ]);
    }
}
