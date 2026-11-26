<?php

namespace App\Http\Requests\Admin;

use App\Models\Program;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return ($this->user()?->role ?? null) === 'admin';
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'category_option' => ['required', 'string', Rule::in(Program::CATEGORY_OPTIONS)],
            'category_other' => ['nullable', 'required_if:category_option,Others', 'string', 'max:120'],
            'type_option' => ['required', 'string', Rule::in(Program::TYPE_OPTIONS)],
            'type_other' => ['nullable', 'required_if:type_option,Others', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:120'],
            'type' => ['required', 'string', 'max:120'],
            'title' => ['required', 'string', 'max:180'],
            'description' => ['required', 'string', 'max:5000'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_thumbnail' => ['sometimes', 'boolean'],
            'schedule_or_format' => ['nullable', 'string', 'max:160'],
            'price' => ['nullable', 'numeric', 'min:0', 'max:999999.99'],
            'button_label' => ['nullable', 'string', 'max:80'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_visible' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $categoryOption = (string) $this->input('category_option', '');
        $typeOption = (string) $this->input('type_option', '');

        $this->merge([
            'category' => $categoryOption === 'Others'
                ? trim((string) $this->input('category_other', ''))
                : $categoryOption,
            'type' => $typeOption === 'Others'
                ? trim((string) $this->input('type_other', ''))
                : $typeOption,
            'is_visible' => $this->boolean('is_visible'),
            'remove_thumbnail' => $this->boolean('remove_thumbnail'),
            'button_label' => $this->filled('button_label') ? $this->string('button_label')->toString() : 'Book a Session',
            'display_order' => $this->filled('display_order') ? $this->integer('display_order') : 0,
        ]);
    }
}
