<?php

namespace Behamin\BResources\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;

class BasicResource extends JsonResource
{
    protected $data, $message, $error_message, $errors, $count;

    public function __construct($resource, $transform = false)
    {
        parent::__construct($resource);
        $this->data = isset($this['data']) ? $this['data'] : new stdClass();
        $this->count = isset($this['count']) ? $this['count'] : null;
        $this->message = isset($this['message']) ? $this['message'] : null;
        $this->error_message = isset($this['error_message']) ? $this['error_message'] : null;
        $this->errors = isset($this['errors']) ? $this['errors'] : null;
        if ($transform and count(get_object_vars($this->data)) > 0) {
            $this->data = $this->getArray($this->data);
        }
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
}
