<?php

namespace App\Providers;

use App\Contracts\Payment as PaymentInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\ExtensionFileException;


class PaymentProvider extends ServiceProvider
{
    const PAYMENT_NAMESPACE = 'App\Payment\\';

    public function register(): void
    {
        $this->app->bind(PaymentInterface::class, function () {
            $paymentMethodFilename = '';
            $paymentProvider = config('payment.provider');
            $paymentFiles = File::allFiles(config('payment.files_namespace'));
            foreach ($paymentFiles as $file) {
                if (str_contains($file->getFilename(), $paymentProvider)) {
                    $paymentMethodFilename = $paymentProvider;
                }
            }

            if (empty($paymentMethodFilename)) {
                throw new ExtensionFileException("Payment method {$paymentProvider} doesn't exist");
            }

            return app()->make(self::PAYMENT_NAMESPACE . $paymentMethodFilename);
        });
    }
}
