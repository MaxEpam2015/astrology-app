<?php

namespace App\Http\Controllers;

use App\Action\StoreOrder;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\JsonResponse;
use App\Contracts\Payment;

class OrderController extends Controller
{
    public function store(StoreRequest $storeRequest, StoreOrder $storeOrder): JsonResponse
    {
        $storeOrder->perform($storeRequest);

        return new JsonResponse(201);
    }

    public function checkout(CheckoutRequest $paymentRequest, Payment $payment): JsonResponse
    {
        $paymentResponse = $payment->checkout($paymentRequest->email, $paymentRequest->name);

        return new JsonResponse($paymentResponse);
    }
}
