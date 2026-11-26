@php $testimonial = $testimonial ?? null; @endphp

<div class="form-grid">
    <div class="field">
        <label for="learner_name">Learner name</label>
        <input type="text" id="learner_name" name="learner_name" value="{{ old('learner_name', $testimonial->learner_name ?? '') }}" required maxlength="140">
        @error('learner_name') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="program_or_role">Program / role <span class="field-hint">(optional)</span></label>
        <input type="text" id="program_or_role" name="program_or_role" value="{{ old('program_or_role', $testimonial->program_or_role ?? '') }}" maxlength="160">
        @error('program_or_role') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="field">
    <label for="quote">Quote</label>
    <textarea id="quote" name="quote" rows="5" required maxlength="5000">{{ old('quote', $testimonial->quote ?? '') }}</textarea>
    @error('quote') <span class="field-error">{{ $message }}</span> @enderror
</div>

<div class="form-grid">
    <div class="field">
        <x-admin.media-upload
            name="photo"
            label="Photo"
            hint="(optional — max 1 image)"
            :existing-url="$testimonial?->photo_url"
            remove-name="remove_photo"
            :avatar="true"
        />
    </div>

    <div class="field">
        <label for="display_order">Display order</label>
        <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $testimonial->display_order ?? 0) }}" min="0" max="9999">
        @error('display_order') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="check-row">
    <label><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $testimonial->is_published ?? true))> Published on website</label>
    <label><input type="checkbox" name="show_on_home" value="1" @checked(old('show_on_home', $testimonial->show_on_home ?? false))> Show on home</label>
</div>
