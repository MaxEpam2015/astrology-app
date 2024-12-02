<?php

namespace App\Services\Payment;

interface PaymentInterface
{
    public function checkout(string $uuid): array;
}
