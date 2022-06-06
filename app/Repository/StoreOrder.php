<?php

namespace App\Repository;

use App\Dto\StoreOrderDto;
use App\Http\Requests\StoreRequest;
use App\Models\Order;
use Illuminate\Support\Str;

class StoreOrder
{
    public function perform(StoreRequest $storeRequest): array
    {
        $createdOrder = Order::create([
            'name' => $storeRequest->name,
            'email' => $storeRequest->email,
            'astrologer_uuid' => $storeRequest->astrologer_uuid,
            'uuid' => Str::uuid(),
        ]);

        return (new StoreOrderDto($createdOrder->uuid))->toArray();
    }
}
