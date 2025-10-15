<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\AttachmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* Rute Publik */
Route::get('/', function () {
    return view('welcome');
});

/* Rute Dashboard (Membutuhkan Login & Verifikasi Email) */
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/* Rute-rute yang Dilindungi (Hanya bisa diakses setelah login) */
Route::middleware('auth')->group(function () {
    
    // Rute khusus untuk Profile
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menggunakan Route::resource untuk menyederhanakan rute CRUD
    // Satu baris ini setara dengan 7 baris rute (index, create, store, show, edit, update, destroy)
    Route::resource('teams', TeamController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('events', EventController::class);
    Route::resource('proposals', ProposalController::class);
    Route::resource('progress', ProgressController::class);
    Route::resource('discussions', DiscussionController::class);
    Route::resource('attachments', AttachmentController::class);

});

/* Auth routes dari Breeze */
require __DIR__.'/auth.php';