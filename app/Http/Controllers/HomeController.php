<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $programs = Program::query()->visible()->take(6)->get();
        $homeTestimonials = Testimonial::query()->forHome()->take(3)->get();

        return view('pages.home', compact('programs', 'homeTestimonials'));
    }
}
