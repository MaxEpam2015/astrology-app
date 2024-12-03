<?php

namespace App\Services\Payment;

interface PaymentInterface
{
    /** @return array<string, string> */
    public function checkout(string $uuid): array;
}
