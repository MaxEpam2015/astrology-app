<?php

return [
    'provider' => env('PAYMENT_PROVIDER', 'MockedPayment'),
    'files_namespace' => env('PAYMENT_FILES_NAMESPACE', '/var/www/app/Payment'),
];
