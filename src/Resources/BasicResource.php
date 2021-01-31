<?php

namespace Behamin\BResources\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use stdClass;

class BasicResource extends JsonResource
{
    protected $data, $message, $error_message, $errors, $count, $sum, $transform;

    public function __construct($resource, $transform = false)
    {
        parent::__construct($resource);
        $this->data = $this['data'] ?? new stdClass();
        $this->count = $this['count'] ?? null;
        $this->sum = $this['sum'] ?? null;
        $this->message = $this['message'] ?? null;
        $this->error_message = $this['error_message'] ?? null;
        $this->errors = $this['errors'] ?? null;

        if ($transform and $this->isObjectVars()) {
            $this->transform = $transform;
            $this->data = $this->getArray($this->data);
        }
    }

    public function isObjectVars()
    {
        if (is_object($this->data) && count(get_object_vars($this->data)) > 0){
            return true;
        }

        if (is_array($this->data) && count($this['data']) > 0) {
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

        if (is_string($this->transform))
        {
            $transform = [$this->transform];
        }

        $data = [];
        foreach ($this->transform as $key) {
            if (is_array($resource)) {
                $data[$key] = $resource[$key];
            } else {
                $data[$key] = data_get($resource, $key);
            }
        }
        return $data;
    }
}
