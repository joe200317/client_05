<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogPostRequest;
use App\Http\Requests\Admin\UpdateBlogPostRequest;
use App\Models\BlogPost;
use App\Support\MediaStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function __construct(private MediaStorage $media) {}

    public function index(): View
    {
        $posts = BlogPost::query()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        return view('admin.blogs.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.blogs.create');
    }

    public function store(StoreBlogPostRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['cover_image', 'remove_cover_image']);

        if (empty($data['slug'])) {
            $data['slug'] = BlogPost::generateUniqueSlug($data['title']);
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $this->media->storeUploadedFile($request->file('cover_image'), 'blogs');
        }

        BlogPost::create($data);

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blog): View
    {
        return view('admin.blogs.edit', ['post' => $blog]);
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blog): RedirectResponse
    {
        $data = $request->safe()->except(['cover_image', 'remove_cover_image']);

        if (empty($data['slug'])) {
            $data['slug'] = BlogPost::generateUniqueSlug($data['title'], $blog->id);
        }

        if ($request->boolean('remove_cover_image') && $blog->cover_image_path) {
            $this->media->delete($blog->cover_image_path);
            $data['cover_image_path'] = null;
        }

        if ($request->hasFile('cover_image')) {
            if ($blog->cover_image_path && ! array_key_exists('cover_image_path', $data)) {
                $this->media->delete($blog->cover_image_path);
            }

            $data['cover_image_path'] = $this->media->storeUploadedFile($request->file('cover_image'), 'blogs');
        }

        $blog->update($data);

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog): RedirectResponse
    {
        if ($blog->cover_image_path) {
            $this->media->delete($blog->cover_image_path);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('status', 'Blog post deleted successfully.');
    }
}
