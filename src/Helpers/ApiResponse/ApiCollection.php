<?php

namespace Behamin\BResources\Helpers\ApiResponse;

use Behamin\BResources\Resources\BasicResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiCollection extends Response
{

    /**
     * @var mixed
     */
    private $items;
    private ?int $count;

    /**
     * @param  mixed  $items
     * @param  null|int  $count
     * @return $this
     */
    public function collection($items, ?int $count): self
    {
        $this->items = $items;
        $this->count = $count;
        return $this;
    }

    protected function respond(): JsonResource
    {
        return new BasicResourceCollection([
            'data' => $this->items, 'count' => $this->count,
            'message' => $this->message
        ]);
    }
}