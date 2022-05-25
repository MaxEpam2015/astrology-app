<?php

namespace App\Contracts;

interface Payment
{
    public function checkout(string $email, string $name): array;
}
