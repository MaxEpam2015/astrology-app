<?php

namespace App\Services\Payment;

use App\Jobs\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class MockedPayment implements PaymentInterface
{
    public function checkout(string $uuid): array
    {
        $order = Order::firstWhere('uuid', $uuid);
        $payload[] = [
            'email' => $order->email,
            'user_name' => $order->name,
            'astrologer_name' => $order->astrologer->name,
        ];
        Payment::dispatch($payload);
        Log::info("[Queue][Checkout] Sent in queue order_uuid {$uuid} to google-sheets", $payload);

        return ['message' => __('payment.successful')];
    }

}
