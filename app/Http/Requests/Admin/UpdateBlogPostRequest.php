<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogPostRequest extends FormRequest
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
        $blogPostId = $this->route('blog')?->id;

        return [
            'category' => ['required', 'string', 'max:120'],
            'title' => ['required', 'string', 'max:200'],
            'slug' => [
                'nullable',
                'string',
                'max:220',
                'alpha_dash',
                Rule::unique('blog_posts', 'slug')->ignore($blogPostId),
            ],
            'excerpt' => ['required', 'string', 'max:1000'],
            'content' => ['required', 'string', 'max:50000'],
            'reading_time' => ['nullable', 'string', 'max:60'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_cover_image' => ['sometimes', 'boolean'],
            'published_at' => ['required', 'date'],
            'is_published' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'remove_cover_image' => $this->boolean('remove_cover_image'),
            'reading_time' => $this->filled('reading_time') ? $this->string('reading_time')->toString() : null,
        ]);
    }
}
