@php $photo = $photo ?? null; @endphp

<div class="field">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $photo->title ?? '') }}" required maxlength="180">
    @error('title') <span class="field-error">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="description">Description <span class="field-hint">(optional)</span></label>
    <textarea id="description" name="description" rows="3" maxlength="2000">{{ old('description', $photo->description ?? '') }}</textarea>
    @error('description') <span class="field-error">{{ $message }}</span> @enderror
</div>

<div class="form-grid">
    <div class="field">
        <x-admin.media-upload
            name="image"
            label="Image"
            :hint="$photo ? '(max 1 image — remove current to replace)' : '(required — max 1 image)'"
            :required="! $photo"
            :existing-url="$photo?->image_url"
            remove-name="remove_image"
        />
    </div>

    <div class="field">
        <label for="display_order">Display order</label>
        <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $photo->display_order ?? 0) }}" min="0" max="9999">
        @error('display_order') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="check-row">
    <label><input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $photo->is_visible ?? true))> Visible on website</label>
</div>
