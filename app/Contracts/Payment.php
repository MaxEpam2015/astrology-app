<?php

namespace App\Contracts;

interface Payment
{
    public function checkout(string $uuid): array;
}
