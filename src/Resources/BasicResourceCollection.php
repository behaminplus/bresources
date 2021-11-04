<?php

namespace Behamin\BResources\Resources;

use Behamin\BResources\Exceptions\InvalidResourceDataException;

class BasicResourceCollection extends BasicResource
{
    protected ?int $count;
    protected ?array $sums;

    public function __construct($resourceCollection)
    {
        parent::__construct($resourceCollection);

        $this->count = $this->resource['count'] ?? null;
        $this->sums = $this->resource['sums'] ?? null;

        $this->setDataCollectionFormat();
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
}
