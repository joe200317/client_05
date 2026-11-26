<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProgramRequest;
use App\Http\Requests\Admin\UpdateProgramRequest;
use App\Models\Program;
use App\Support\MediaStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function __construct(private MediaStorage $media) {}

    public function index(): View
    {
        $programs = Program::query()
            ->orderBy('display_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.programs.index', compact('programs'));
    }

    public function create(): View
    {
        return view('admin.programs.create');
    }

    public function store(StoreProgramRequest $request): RedirectResponse
    {
        $data = $request->safe()->except([
            'thumbnail',
            'remove_thumbnail',
            'category_option',
            'category_other',
            'type_option',
            'type_other',
        ]);

        $data['slug'] = Program::generateUniqueSlug($data['title']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $this->media->storeUploadedFile($request->file('thumbnail'), 'programs');
        }

        Program::create($data);

        return redirect()
            ->route('admin.programs.index')
            ->with('status', 'Program created successfully.');
    }

    public function edit(Program $program): View
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(UpdateProgramRequest $request, Program $program): RedirectResponse
    {
        $data = $request->safe()->except([
            'thumbnail',
            'remove_thumbnail',
            'category_option',
            'category_other',
            'type_option',
            'type_other',
        ]);

        if ($program->title !== $data['title']) {
            $data['slug'] = Program::generateUniqueSlug($data['title'], $program->id);
        } else {
            unset($data['slug']);
        }

        if ($request->boolean('remove_thumbnail') && $program->thumbnail_path) {
            $this->media->delete($program->thumbnail_path);
            $data['thumbnail_path'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            if ($program->thumbnail_path && ! array_key_exists('thumbnail_path', $data)) {
                $this->media->delete($program->thumbnail_path);
            }

            $data['thumbnail_path'] = $this->media->storeUploadedFile($request->file('thumbnail'), 'programs');
        }

        $program->update($data);

        return redirect()
            ->route('admin.programs.index')
            ->with('status', 'Program updated successfully.');
    }

    public function destroy(Program $program): RedirectResponse
    {
        if ($program->thumbnail_path) {
            $this->media->delete($program->thumbnail_path);
        }

        $program->delete();

        return redirect()
            ->route('admin.programs.index')
            ->with('status', 'Program deleted successfully.');
    }
}
