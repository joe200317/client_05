<?php

namespace App\Providers;

use App\Models\Program;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('components.modals.book-session', function ($view): void {
            $bookingPrograms = collect();

            if (Schema::hasTable('programs')) {
                $bookingPrograms = Program::query()->visible()->get(['id', 'title', 'category', 'type']);
            }

            $view->with('bookingPrograms', $bookingPrograms);
        });
    }
}
