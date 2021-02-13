<?php

namespace Behamin\BResources\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class BasicResource extends JsonResource
{
    protected $data, $message, $error_message, $errors, $count, $sum, $transform;

    public function __construct($resource, $transform = false)
    {
        parent::__construct($resource);
        $this->data = $this['data'] ?? null;
        $this->count = $this['count'] ?? null;
        $this->sum = $this['sum'] ?? null;
        $this->message = $this['message'] ?? null;
        $this->error_message = $this['error_message'] ?? null;
        $this->errors = $this['errors'] ?? null;
        $this->finalizeData($transform);
    }

    public function toArray($request)
    {
        return [
            "data" => $this->data,
            "message" => $this->message,
            "error" => [
                "message" => $this->error_message,
                "errors" => $this->errors
            ]
        ];
    }

    protected function getArray($resource)
    {
        if (is_bool($this->transform)) {
            if (method_exists($resource, 'toArray')) {
                return $resource->toArray();
            } else {
                return get_object_vars($resource);
            }
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

    protected function finalizeData($transform)
    {
        if (is_object($this->data)) {
            $objectVarsCount = count(get_object_vars($this->data));
            if ($objectVarsCount > 0 and $transform) {
                $this->transform = $transform;
                $this->data = $this->getArray($this->data);
            } elseif ($objectVarsCount == 0) {
                $this->data = null;
            }
        } elseif (is_array($this->data) or $this->data instanceof Collection) {
            $itemsCount = count($this->data);
            if ($itemsCount > 0 and $transform) {
                $this->transform = $transform;
                $this->data = $this->getArray($this->data);
            } elseif ($itemsCount == 0) {
                $this->data = [];
            }
        }
    }
}
