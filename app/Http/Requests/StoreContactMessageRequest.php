<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
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
            'phone' => ['nullable', 'string', 'regex:/^[0-9]{10}$/'],
            'interest' => ['required', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'interest.required' => 'Please choose what you are interested in.',
            'phone.regex' => 'Phone number must be exactly 10 digits.',
        ];
    }
}
