<?php

namespace App\Providers;

use App\Contracts\Payment as PaymentInterface;
use App\Payment\MockedPayment;
use Illuminate\Support\ServiceProvider;

class PaymentProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PaymentInterface::class, function () {
            $paymentProvider = config('payment.provider');
            $payment = match ($paymentProvider) {
                'MockedPayment' => app()->make(MockedPayment::class),
            };
            if (empty($payment)) {
                throw new \Exception("Payment method {$paymentProvider} not found");
            }

            return app()->make($payment::class);
        });
    }
}
