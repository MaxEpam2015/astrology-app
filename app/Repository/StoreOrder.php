<?php

namespace App\Repository;

use App\Http\Requests\StoreRequest;
use App\Models\Order;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

class StoreOrder
{
    public function perform(StoreRequest $storeRequest): string
    {
        $createdOrder = Order::create([
            'name' => $storeRequest->name,
            'email' => $storeRequest->email,
            'astrologer_uuid' => $storeRequest->astrologer_uuid,
            'uuid' => Str::uuid(),
        ]);

        /** @var UuidInterface $orderUuid */
        $orderUuid = $createdOrder->uuid;

        return $orderUuid->toString();
    }
}
