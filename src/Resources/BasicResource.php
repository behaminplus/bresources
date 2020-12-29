<?php

namespace Behamin\BResources\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;

class BasicResource extends JsonResource
{
    protected $data, $message, $error_message, $errors, $count, $sum;

    public function __construct($resource, $transform = false)
    {
        parent::__construct($resource);
        $this->data = $this['data'] ?? new stdClass();
        $this->count = $this['count'] ?? null;
        $this->sum = $this['sum'] ?? null;
        $this->message = $this['message'] ?? null;
        $this->error_message = $this['error_message'] ?? null;
        $this->errors = $this['errors'] ?? null;
        if ($transform and count(get_object_vars($this->data)) > 0) {
            $this->data = $this->getArray($this->data);
        }
    }

    public function toArray($resource)
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
        if (method_exists($resource, 'toArray')) {
            return $resource->toArray();
        } else {
            return get_object_vars($resource);
        }
    }
}
