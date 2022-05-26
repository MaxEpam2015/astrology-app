<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $order_uuid
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
