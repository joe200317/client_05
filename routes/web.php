<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryPhotoController as AdminGalleryPhotoController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\SessionBookingController as AdminSessionBookingController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SessionBookingController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::get('/programs', [ProgramController::class, 'index'])->name('programs');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('prevent.duplicate')
    ->name('contact.store');
Route::post('/session-bookings', [SessionBookingController::class, 'store'])
    ->middleware('prevent.duplicate')
    ->name('session-bookings.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/create-admin', [AdminAuthController::class, 'createAdminForm'])->name('admins.create');
        Route::post('/create-admin', [AdminAuthController::class, 'storeAdmin'])->name('admins.store');

        Route::get('/account', [AdminAuthController::class, 'editAccount'])->name('account.edit');
        Route::put('/account', [AdminAuthController::class, 'updateAccount'])->name('account.update');

        Route::resource('programs', AdminProgramController::class)
            ->except(['show'])
            ->middleware('prevent.duplicate');
        Route::resource('testimonials', AdminTestimonialController::class)
            ->except(['show'])
            ->middleware('prevent.duplicate');
        Route::resource('blogs', AdminBlogPostController::class)
            ->except(['show'])
            ->middleware('prevent.duplicate')
            ->parameters(['blogs' => 'blog']);
        Route::resource('gallery', AdminGalleryPhotoController::class)
            ->except(['show'])
            ->middleware('prevent.duplicate')
            ->parameters(['gallery' => 'gallery']);

        Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('/bookings', [AdminSessionBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [AdminSessionBookingController::class, 'show'])->name('bookings.show');
        Route::put('/bookings/{booking}', [AdminSessionBookingController::class, 'update'])->name('bookings.update');
        Route::delete('/bookings/{booking}', [AdminSessionBookingController::class, 'destroy'])->name('bookings.destroy');
    });
});
