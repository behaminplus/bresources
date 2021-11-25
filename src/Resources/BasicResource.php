<?php

namespace Behamin\BResources\Resources;

use Behamin\BResources\Exceptions\InvalidResourceDataException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class BasicResource extends JsonResource
{
    protected $data;

    protected ?string $message;
    protected ?string $errorMessage;
    protected ?array $errors;

    protected ?int $count;
    protected ?array $sums;

    public function __construct($resource)
    {
        parent::__construct($resource);

        static::withoutWrapping();

        $this->data = $this->resource['data'] ?? null;
        $this->message = $this->resource['message'] ?? null;
        $this->errorMessage = $this->resource['error_message'] ?? null;
        $this->errors = $this->resource['errors'] ?? null;

        $this->count = $this->resource['count'] ?? null;
        $this->sums = $this->resource['sums'] ?? null;

        $this->data = $this->transformData();
    }

    public static function collection($resource)
    {
        $resourceCollection = new static($resource);

        $resourceCollection->setDataCollectionFormat();

        return $resourceCollection;
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

    protected function transformDataItem($item)
    {
        return $item;
    }

    private function transformData()
    {
        if ($this->data instanceof Collection) {
            return $this->transformCollectionDataItems();
        }

        if (is_array($this->data) && array_is_list($this->data)) {
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

    private function setDataCollectionFormat(): void
    {
        if (!is_countable($this->data)) {
            throw new InvalidResourceDataException('Given resource collection data is not countable.');
        }

        $this->data = [
            'items' => $this->data,
            'count' => $this->count ?? count($this->data),
            'sums' => $this->sums
        ];
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
            'sums',
        ];
    }
}
