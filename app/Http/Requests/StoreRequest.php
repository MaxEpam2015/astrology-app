<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $email
 * @property string $name
 * @property string $astrologer_uuid
 */
class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'astrologer_uuid' => ['required', 'uuid', 'exists:astrologers,uuid'],
        ];
    }
}
