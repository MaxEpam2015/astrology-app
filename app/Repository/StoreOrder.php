<?php

namespace App\Repository;

use App\Http\Requests\StoreRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

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

        return $createdOrder->uuid->toString();
    }
}
