<?php

namespace App\Http\Requests\Admin;

use App\Models\GalleryPhoto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryPhotoRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:180'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['sometimes', 'boolean'],
            'display_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_visible' => ['sometimes', 'boolean'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            /** @var GalleryPhoto|null $gallery */
            $gallery = $this->route('gallery');

            if ($this->boolean('remove_image') && ! $this->hasFile('image') && $gallery) {
                $validator->errors()->add('image', 'Please upload a replacement image after removing the current one.');
            }
        });
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_visible' => $this->boolean('is_visible'),
            'remove_image' => $this->boolean('remove_image'),
            'display_order' => $this->filled('display_order') ? $this->integer('display_order') : 0,
        ]);
    }
}
