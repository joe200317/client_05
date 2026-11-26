@php
    /** @var \App\Models\Program|null $program */
    $program = $program ?? null;

    $savedCategory = old('category', $program->category ?? '');
    $savedType = old('type', $program->type ?? '');

    $categoryOption = old('category_option', in_array($savedCategory, \App\Models\Program::CATEGORY_OPTIONS, true) ? $savedCategory : (filled($savedCategory) ? 'Others' : ''));
    $typeOption = old('type_option', in_array($savedType, \App\Models\Program::TYPE_OPTIONS, true) ? $savedType : (filled($savedType) ? 'Others' : ''));

    $categoryOther = old('category_other', $categoryOption === 'Others' ? $savedCategory : '');
    $typeOther = old('type_other', $typeOption === 'Others' ? $savedType : '');
@endphp

<div class="form-grid">
    <div class="field">
        <label for="category_option">Program category</label>
        <select id="category_option" name="category_option" required data-theme-dropdown data-other-toggle="category_other_wrap">
            <option value="" disabled @selected($categoryOption === '')>Select category</option>
            @foreach (\App\Models\Program::CATEGORY_OPTIONS as $option)
                <option value="{{ $option }}" @selected($categoryOption === $option)>{{ $option }}</option>
            @endforeach
        </select>
        @error('category_option') <span class="field-error">{{ $message }}</span> @enderror
        @error('category') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="type_option">Program type</label>
        <select id="type_option" name="type_option" required data-theme-dropdown data-other-toggle="type_other_wrap">
            <option value="" disabled @selected($typeOption === '')>Select type</option>
            @foreach (\App\Models\Program::TYPE_OPTIONS as $option)
                <option value="{{ $option }}" @selected($typeOption === $option)>{{ $option }}</option>
            @endforeach
        </select>
        @error('type_option') <span class="field-error">{{ $message }}</span> @enderror
        @error('type') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-grid">
    <div class="field" id="category_other_wrap" @style(['display:none' => $categoryOption !== 'Others'])>
        <label for="category_other">Custom category</label>
        <input type="text" id="category_other" name="category_other" value="{{ $categoryOther }}" maxlength="120" placeholder="Enter custom category">
        @error('category_other') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field" id="type_other_wrap" @style(['display:none' => $typeOption !== 'Others'])>
        <label for="type_other">Custom type</label>
        <input type="text" id="type_other" name="type_other" value="{{ $typeOther }}" maxlength="120" placeholder="Enter custom type">
        @error('type_other') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="field">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $program->title ?? '') }}" required maxlength="180">
    @error('title') <span class="field-error">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="5" required maxlength="5000">{{ old('description', $program->description ?? '') }}</textarea>
    @error('description') <span class="field-error">{{ $message }}</span> @enderror
</div>

<div class="field">
    <x-admin.media-upload
        name="thumbnail"
        label="Program thumbnail"
        hint="(optional — max 1 image)"
        :existing-url="$program?->thumbnail_url"
        remove-name="remove_thumbnail"
    />
</div>

<div class="form-grid">
    <div class="field">
        <label for="schedule_or_format">Schedule / format</label>
        <input type="text" id="schedule_or_format" name="schedule_or_format" value="{{ old('schedule_or_format', $program->schedule_or_format ?? '') }}" maxlength="160" placeholder="Flexible format">
        @error('schedule_or_format') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="price">Price <span class="field-hint">(optional)</span></label>
        <input type="number" id="price" name="price" value="{{ old('price', $program->price ?? '') }}" min="0" step="0.01" placeholder="0.00">
        @error('price') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-grid">
    <div class="field">
        <label for="button_label">Button label</label>
        <input type="text" id="button_label" name="button_label" value="{{ old('button_label', $program->button_label ?? 'Book a Session') }}" maxlength="80">
        @error('button_label') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="button_link">Button link <span class="field-hint">(optional — leave blank for Book a Session modal)</span></label>
        <input type="text" id="button_link" name="button_link" value="{{ old('button_link', $program->button_link ?? '') }}" maxlength="255" placeholder="">
        @error('button_link') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="form-grid">
    <div class="field">
        <label for="display_order">Display order</label>
        <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $program->display_order ?? 0) }}" min="0" max="9999">
        @error('display_order') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field" style="justify-content:flex-end;padding-top:22px;">
        <label style="display:flex;align-items:center;gap:10px;text-transform:none;letter-spacing:0;font-weight:600;font-size:13.5px;">
            <input type="checkbox" name="is_visible" value="1" @checked(old('is_visible', $program->is_visible ?? true))>
            Visible on website
        </label>
        @error('is_visible') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const syncOtherField = (select) => {
            const wrapId = select.getAttribute('data-other-toggle');
            const wrap = document.getElementById(wrapId);
            if (!wrap) return;
            wrap.style.display = select.value === 'Others' ? '' : 'none';
        };

        document.querySelectorAll('[data-other-toggle]').forEach((select) => {
            syncOtherField(select);
            select.addEventListener('change', () => syncOtherField(select));
        });
    });
</script>
