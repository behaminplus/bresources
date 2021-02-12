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
        if ($this->hasDataVariables()) {
            if ($transform) {
                $this->transform = $transform;
                $this->data = $this->getArray($this->data);
            }
        } else {
            $this->setEmptyData();
        }
    }

    public function hasDataVariables()
    {
        if (is_object($this->data) and count(get_object_vars($this->data)) > 0) {
            return true;
        }
        if ((is_array($this->data) or $this->data instanceof Collection) and count($this->data) > 0) {
            return true;
        }

        return false;
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

    protected function setEmptyData()
    {
        if (is_array($this['data']) or $this['data'] instanceof Collection) {
            $this->data = [];
        } else {
            $this->data = null;
        }
    }
}
