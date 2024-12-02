<?php

namespace App\Providers;

use App\Enums\PaymentMethod;
use App\Services\Payment\MockedPayment;
use App\Services\Payment\PaymentInterface as PaymentInterface;
use Illuminate\Support\ServiceProvider;

class PaymentProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PaymentInterface::class, function () {
            $paymentProvider = config('payment.provider');
            $payment = match ($paymentProvider) {
                PaymentMethod::MOCKED_PAYMENT->value => app()->make(MockedPayment::class),
            };
            if (empty($payment)) {
                throw new \Exception("Payment method {$paymentProvider} not found");
            }

            return app()->make($payment::class);
        });
    }
}
