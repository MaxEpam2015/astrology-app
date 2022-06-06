<?php

namespace App\Dto;

class StoreOrderDto
{
    protected string $order_uuid;

    public function __construct(
        string $orderUuid
    )
    {
        $this->order_uuid = $orderUuid;
    }

    public function toArray(): array
    {
        return (array) get_object_vars($this);
    }
}
