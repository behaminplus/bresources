<?php

namespace Behamin\BResources\Helpers\ApiResponse;

use Behamin\BResources\Resources\BasicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiData extends Response
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param  mixed  $data
     * @return $this
     */
    public function data($data): self
    {
        $this->data = $data;
        return $this;
    }

    protected function respond(): JsonResource
    {
        return new BasicResource(['data' => $this->data, 'message' => $this->getMessage()]);
    }
}
