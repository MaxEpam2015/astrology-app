<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $email
 * @property string $name
 */
class CheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'order_uuid' => ['required', 'uuid', 'exists:orders,uuid'],
        ];
    }
}
