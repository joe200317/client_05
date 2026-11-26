@props([
    'name',
    'id' => null,
    'label' => 'Image',
    'hint' => null,
    'accept' => 'image/jpeg,image/png,image/webp',
    'required' => false,
    'existingUrl' => null,
    'removeName' => null,
    'avatar' => false,
    'errorBag' => null,
])

@php
    $inputId = $id ?? $name;
    $errorBag = $errorBag ?? $name;
    $hasExisting = filled($existingUrl);
@endphp

<div
    class="media-upload"
    data-media-upload
    data-max="1"
    @if ($required && ! $hasExisting) data-required-on-empty="true" @endif
>
    <label for="{{ $inputId }}">
        {{ $label }}
        @if ($hint)
            <span class="field-hint">{{ $hint }}</span>
        @endif
    </label>

    <input
        type="file"
        id="{{ $inputId }}"
        name="{{ $name }}"
        accept="{{ $accept }}"
        data-media-input
        @required($required && ! $hasExisting)
    >

    @if ($removeName)
        <input type="hidden" name="{{ $removeName }}" value="0" data-media-remove>
    @endif

    <div
        class="media-upload__preview {{ $avatar ? 'is-avatar' : '' }}"
        data-media-preview
        @if (! $hasExisting) hidden @endif
    >
        <img
            @if ($hasExisting) src="{{ $existingUrl }}" @endif
            alt=""
            data-media-image
        >
        <div class="media-upload__overlay">
            <button type="button" class="media-upload__remove" data-media-remove-btn>
                Remove
            </button>
        </div>
    </div>

    <p class="media-upload__error" data-media-error hidden></p>
    @error($errorBag) <span class="field-error">{{ $message }}</span> @enderror
    @if ($removeName)
        @error($removeName) <span class="field-error">{{ $message }}</span> @enderror
    @endif
</div>
