<?php

namespace Behamin\BResources\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class BasicResource extends JsonResource
{
    protected ?string $message;
    protected ?string $errorMessage;
    protected ?array $errors;
    protected $data;

    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->data = $this->resource['data'] ?? null;
        $this->message = $this->resource['message'] ?? null;
        $this->errorMessage = $this->resource['error_message'] ?? null;
        $this->errors = $this->resource['errors'] ?? null;

        $this->data = $this->transformData();
    }

    public function toArray($request = null)
    {
        $data = [
            'data' => $this->isEmptyObject($this->data) ? null : $this->data,
            'message' => $this->message,
            'error' => [
                'message' => $this->errorMessage,
                'errors' => $this->errors
            ]
        ];

        return array_merge($data, Arr::except($this->resource, $this->getMainKeys()));
    }

    protected function transformDataItem($resource)
    {
        return $resource;
    }

    private function transformData()
    {
        if ($this->data instanceof Collection) {
            return $this->transformCollectionDataItems();
        }

        if (is_array($this->data)) {
            return $this->transformArrayDataItems();
        }

        return $this->transformDataItem($this->data);
    }

    private function transformArrayDataItems(): array
    {
        return array_map(function ($item) {
            return $this->transformDataItem($item);
        }, $this->data);
    }

    private function transformCollectionDataItems(): Collection
    {
        return $this->data->transform(function ($item) {
            return $this->transformDataItem($item);
        });
    }

    private function isEmptyObject($resource): bool
    {
        return is_object($resource) && !is_countable($resource) && empty(get_object_vars($resource));
    }

    private function getMainKeys(): array
    {
        return [
            'data',
            'count',
            'message',
            'error_message',
            'errors',
            'sum',
        ];
    }
}
