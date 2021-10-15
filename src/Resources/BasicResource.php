<?php

namespace Behamin\BResources\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class BasicResource extends JsonResource
{
    protected $transform;
    protected $data, $message, $errorMessage, $errors, $count, $sum;

    public function __construct($resource, $transform = false)
    {
        parent::__construct($resource);

        $this->data = $this->resource['data'] ?? null;
        $this->count = $this->resource['count'] ?? null;
        $this->message = $this->resource['message'] ?? null;
        $this->errorMessage = $this->resource['error_message'] ?? null;
        $this->errors = $this->resource['errors'] ?? null;
        $this->sum = $this->resource['sum'] ?? null;

        $this->finalizeData($transform);
    }

    public function toArray($request = null)
    {
        $data = [
            'data' => $this->data,
            'message' => $this->message,
            'error' => [
                'message' => $this->errorMessage,
                'errors' => $this->errors
            ]
        ];

        return array_merge($data, Arr::except($this->resource, $this->getMainKeys()));
    }

    protected function getArray($resource)
    {
        if (is_bool($this->transform)) {
            if (method_exists($resource, 'toArray')) {
                return $resource->toArray();
            }

            return get_object_vars($resource);
        }

        $transform = is_string($this->transform) ? [$this->transform] : $this->transform;

        if (!is_array($transform)) {
            return $resource;
        }

        $data = [];
        foreach ($transform as $key) {
            if (is_array($resource)) {
                $data[$key] = $resource[$key];
            } else {
                $data[$key] = data_get($resource, $key);
            }
        }

        return $data;
    }

    protected function finalizeData($transform): void
    {
        if (is_array($this->data) || $this->data instanceof Collection) {
            $itemsCount = count($this->data);
            if ($itemsCount > 0 && $transform) {
                $this->transform = $transform;
                $this->data = $this->getArray($this->data);
            } elseif ($itemsCount === 0) {
                $this->data = [];
            }
        } elseif (is_object($this->data)) {
            $objectVarsCount = count(get_object_vars($this->data));
            if ($objectVarsCount > 0 && $transform) {
                $this->transform = $transform;
                $this->data = $this->getArray($this->data);
            } elseif ($objectVarsCount === 0) {
                $this->data = null;
            }
        }
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
