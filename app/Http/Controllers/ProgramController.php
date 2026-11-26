<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        $programs = Program::query()->visible()->get();

        return view('pages.programs', compact('programs'));
    }
}
