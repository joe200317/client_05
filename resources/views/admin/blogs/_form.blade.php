@php $post = $post ?? null; @endphp

<div class="form-grid">
    <div class="field">
        <label for="category">Category</label>
        <input type="text" id="category" name="category" value="{{ old('category', $post->category ?? '') }}" required maxlength="120" placeholder="Focus & attention">
        @error('category') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="field">
        <label for="reading_time">Reading time <span class="field-hint">(optional)</span></label>
        <input type="text" id="reading_time" name="reading_time" value="{{ old('reading_time', $post->reading_time ?? '') }}" maxlength="60" placeholder="6 min read">
        @error('reading_time') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="field">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}" required maxlength="200">
    @error('title') <span class="field-error">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="slug">Slug <span class="field-hint">(optional — auto from title)</span></label>
    <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug ?? '') }}" maxlength="220">
    @error('slug') <span class="field-error">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="excerpt">Excerpt</label>
    <textarea id="excerpt" name="excerpt" rows="3" required maxlength="1000">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    @error('excerpt') <span class="field-error">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="content">Content</label>
    <textarea id="content" name="content" rows="10" required>{{ old('content', $post->content ?? '') }}</textarea>
    @error('content') <span class="field-error">{{ $message }}</span> @enderror
</div>

<div class="form-grid">
    <div class="field">
        <x-admin.media-upload
            name="cover_image"
            label="Cover image"
            hint="(optional — max 1 image)"
            :existing-url="$post?->cover_image_url"
            remove-name="remove_cover_image"
        />
    </div>

    <div class="field">
        <label for="published_at">Published date</label>
        <input type="date" id="published_at" name="published_at" value="{{ old('published_at', optional($post->published_at ?? null)->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required>
        @error('published_at') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="check-row">
    <label><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $post->is_published ?? true))> Published on website</label>
</div>
