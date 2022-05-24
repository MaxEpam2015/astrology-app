<?php

namespace App\Http\Controllers;

use App\Jobs\Payment;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(201);
    }

    public function payOrder(): JsonResponse
    {
        $payload = [];
        Payment::dispatch($payload);

        return new JsonResponse(['message' => __('payment.successful')]);
    }
}
