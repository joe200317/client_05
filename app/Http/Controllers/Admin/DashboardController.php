<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\GalleryPhoto;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'programs_total' => Program::query()->count(),
            'programs_visible' => Program::query()->where('is_visible', true)->count(),
            'testimonials_total' => Testimonial::query()->count(),
            'testimonials_published' => Testimonial::query()->where('is_published', true)->count(),
            'blogs_total' => BlogPost::query()->count(),
            'blogs_published' => BlogPost::query()->where('is_published', true)->count(),
            'gallery_total' => GalleryPhoto::query()->count(),
            'gallery_visible' => GalleryPhoto::query()->where('is_visible', true)->count(),
            'admins_total' => User::query()->where('role', 'admin')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
