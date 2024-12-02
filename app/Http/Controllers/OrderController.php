<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\StoreRequest;
use App\Repository\StoreOrder;
use App\Services\Payment\PaymentInterface;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function store(StoreRequest $storeRequest, StoreOrder $storeOrder): JsonResponse
    {
        $storeOrderResponse = $storeOrder->perform($storeRequest);

        return new JsonResponse(['uuid' => $storeOrderResponse]);
    }

    public function checkout(CheckoutRequest $checkoutRequest, PaymentInterface $payment): JsonResponse
    {
        $paymentResponse = $payment->checkout($checkoutRequest->order_uuid);

        return new JsonResponse($paymentResponse);
    }
}
