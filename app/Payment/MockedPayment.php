<?php

namespace App\Payment;

use App\Contracts\Payment as PaymentInterface;
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
        Log::info("[Queue][Checkout] Prepare to send order_uuid {$uuid} to google-sheets", $payload);
        Payment::dispatch($payload);
        Log::info("[Queue][Checkout] Finished sending order_uuid {$uuid} to google-sheets", $payload);

        return ['message' => __('payment.successful')];
    }

}
