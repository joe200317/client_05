<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $photos = GalleryPhoto::query()->visible()->get();

        return view('pages.gallery', compact('photos'));
    }
}
