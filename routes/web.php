<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AdminCmsController;
use App\Http\Controllers\Admin\AdminPsbController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PsbController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\SystemSetupController;
use Illuminate\Support\Facades\Route;

// --- Public Landing Page ---
Route::get('/', HomeController::class)->name('home');

// --- Public News (CMS) ---
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

// --- Public Gallery (CMS) ---
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// --- Public PSB Online Portal ---
Route::prefix('psb')->name('psb.')->group(function () {
    Route::get('/', [PsbController::class, 'index'])->name('index');
    Route::post('/daftar', [PsbController::class, 'store'])->name('store');
    Route::get('/sukses/{registration_number}', [PsbController::class, 'success'])->name('success');
    Route::get('/bukti/{registration_number}', [PsbController::class, 'downloadProof'])->name('proof');
    Route::get('/status', [PsbController::class, 'statusForm'])->name('status');
    Route::post('/status', [PsbController::class, 'checkStatus'])->middleware('throttle:10,60')->name('check-status');
    Route::put('/edit/{registration_number}', [PsbController::class, 'update'])->name('edit');
});

// --- System Setup Helper (Deployment) ---
Route::match(['GET', 'POST'], '/system-setup', [SystemSetupController::class, 'handle'])->middleware('throttle:5,1')->name('system.setup');

// --- Authenticated Dashboard ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Admin CMS Routes
    Route::middleware('can:manage-cms')->prefix('admin/cms')->name('admin.cms.')->group(function () {
        Route::get('/', [AdminCmsController::class, 'dashboard'])->name('dashboard');

        // Posts
        Route::get('/posts', [AdminCmsController::class, 'indexPosts'])->name('posts.index');
        Route::get('/posts/create', [AdminCmsController::class, 'createPost'])->name('posts.create');
        Route::post('/posts', [AdminCmsController::class, 'storePost'])->name('posts.store');
        Route::get('/posts/{id}/edit', [AdminCmsController::class, 'editPost'])->name('posts.edit');
        Route::put('/posts/{id}', [AdminCmsController::class, 'updatePost'])->name('posts.update');
        Route::delete('/posts/{id}', [AdminCmsController::class, 'destroyPost'])->name('posts.destroy');

        // Categories
        Route::get('/categories', [AdminCmsController::class, 'indexCategories'])->name('categories.index');
        Route::post('/categories', [AdminCmsController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{id}', [AdminCmsController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{id}', [AdminCmsController::class, 'destroyCategory'])->name('categories.destroy');

        // Galleries & Photos
        Route::get('/galleries', [AdminCmsController::class, 'indexGalleries'])->name('galleries.index');
        Route::post('/galleries', [AdminCmsController::class, 'storeGallery'])->name('galleries.store');
        Route::get('/galleries/{id}', [AdminCmsController::class, 'showGallery'])->name('galleries.show');
        Route::put('/galleries/{id}', [AdminCmsController::class, 'updateGallery'])->name('galleries.update');
        Route::delete('/galleries/{id}', [AdminCmsController::class, 'destroyGallery'])->name('galleries.destroy');
        Route::post('/galleries/{id}/photos', [AdminCmsController::class, 'storeGalleryPhoto'])->name('galleries.photos.store');
        Route::delete('/galleries/photos/{id}', [AdminCmsController::class, 'destroyGalleryPhoto'])->name('galleries.photos.destroy');

        // Teachers
        Route::get('/teachers', [AdminCmsController::class, 'indexTeachers'])->name('teachers.index');
        Route::post('/teachers', [AdminCmsController::class, 'storeTeacher'])->name('teachers.store');
        Route::put('/teachers/{id}', [AdminCmsController::class, 'updateTeacher'])->name('teachers.update');
        Route::delete('/teachers/{id}', [AdminCmsController::class, 'destroyTeacher'])->name('teachers.destroy');

        // Settings
        Route::middleware('can:manage-settings')->group(function () {
            Route::get('/settings', [AdminCmsController::class, 'indexSettings'])->name('settings.index');
            Route::post('/settings', [AdminCmsController::class, 'updateSettings'])->name('settings.update');
        });
    });

    // Admin PSB Routes
    Route::middleware('can:manage-psb')->prefix('admin/psb')->name('admin.psb.')->group(function () {
        Route::get('/', [AdminPsbController::class, 'dashboard'])->name('dashboard');
        Route::get('/applicants', [AdminPsbController::class, 'indexApplicants'])->name('applicants.index');
        Route::get('/applicants/{id}', [AdminPsbController::class, 'showApplicant'])->name('applicants.show');
        Route::patch('/applicants/{id}/status', [AdminPsbController::class, 'updateStatus'])->name('applicants.update-status');
        Route::get('/export', [AdminPsbController::class, 'export'])->name('export');
    });
});

require __DIR__.'/settings.php';
