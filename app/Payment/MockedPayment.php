<?php

namespace App\Payment;

use App\Contracts\Payment as PaymentInterface;
use App\Jobs\Payment;

class MockedPayment implements PaymentInterface
{
    public function checkout(string $email, string $name): array
    {
        $payload[] = [
            'email' => $email,
            'name' => $name,
        ];
        Payment::dispatch($payload);

        return ['message' => __('payment.successful')];
    }

}
