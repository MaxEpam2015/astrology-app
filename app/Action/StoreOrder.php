<?php

namespace App\Action;

use App\Http\Requests\StoreRequest;
use App\Models\Order;

class StoreOrder
{
    public function perform(StoreRequest $storeRequest): array
    {
        $createdOrder = Order::create([
            'name' => $storeRequest->name,
            'email' => $storeRequest->email,
            'astrologer_uuid' => $storeRequest->astrologer_uuid,
        ]);

        return ['message' => "Order {$createdOrder->uuid} has been created successfully"];
    }
}
