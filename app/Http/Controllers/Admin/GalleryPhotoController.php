<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryPhotoRequest;
use App\Http\Requests\Admin\UpdateGalleryPhotoRequest;
use App\Models\GalleryPhoto;
use App\Support\MediaStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryPhotoController extends Controller
{
    public function __construct(private MediaStorage $media) {}

    public function index(): View
    {
        $photos = GalleryPhoto::query()
            ->orderBy('display_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.gallery.index', compact('photos'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(StoreGalleryPhotoRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image']);
        $data['image_path'] = $this->media->storeUploadedFile($request->file('image'), 'gallery');

        GalleryPhoto::create($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Gallery photo created successfully.');
    }

    public function edit(GalleryPhoto $gallery): View
    {
        return view('admin.gallery.edit', ['photo' => $gallery]);
    }

    public function update(UpdateGalleryPhotoRequest $request, GalleryPhoto $gallery): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image']);

        if ($request->hasFile('image')) {
            if ($gallery->image_path) {
                $this->media->delete($gallery->image_path);
            }

            $data['image_path'] = $this->media->storeUploadedFile($request->file('image'), 'gallery');
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Gallery photo updated successfully.');
    }

    public function destroy(GalleryPhoto $gallery): RedirectResponse
    {
        $this->media->delete($gallery->image_path);
        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('status', 'Gallery photo deleted successfully.');
    }
}
