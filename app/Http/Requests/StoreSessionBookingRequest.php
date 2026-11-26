<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:140'],
            'email' => ['required', 'string', 'email', 'max:160'],
            'program' => ['required', 'string', 'max:160'],
            'timing' => ['required', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }
}
