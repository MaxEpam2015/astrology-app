<?php

namespace App\Http\Controllers;

use App\Repository\StoreOrder;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\JsonResponse;
use App\Contracts\Payment;

class OrderController extends Controller
{
    public function store(StoreRequest $storeRequest, StoreOrder $storeOrder): JsonResponse
    {
        $storeOrderResponse = $storeOrder->perform($storeRequest);

        return new JsonResponse($storeOrderResponse);
    }

    public function checkout(CheckoutRequest $checkoutRequest, Payment $payment): JsonResponse
    {
        $paymentResponse = $payment->checkout($checkoutRequest->order_uuid);

        return new JsonResponse($paymentResponse);
    }
}
