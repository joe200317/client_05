<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Support\MediaStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function __construct(private MediaStorage $media) {}

    public function index(): View
    {
        $testimonials = Testimonial::query()
            ->orderBy('display_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['photo', 'remove_photo']);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $this->media->storeUploadedFile($request->file('photo'), 'testimonials');
        }

        Testimonial::create($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('status', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->safe()->except(['photo', 'remove_photo']);

        if ($request->boolean('remove_photo') && $testimonial->photo_path) {
            $this->media->delete($testimonial->photo_path);
            $data['photo_path'] = null;
        }

        if ($request->hasFile('photo')) {
            if ($testimonial->photo_path && ! array_key_exists('photo_path', $data)) {
                $this->media->delete($testimonial->photo_path);
            }

            $data['photo_path'] = $this->media->storeUploadedFile($request->file('photo'), 'testimonials');
        }

        $testimonial->update($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('status', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->photo_path) {
            $this->media->delete($testimonial->photo_path);
        }

        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('status', 'Testimonial deleted successfully.');
    }
}
