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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JoinRequestController; // Penambahan import controller baru

// Rute Publik
Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute-rute yang Membutuhkan Login
Route::middleware('auth')->group(function () {
    
    // Rute untuk MELIHAT profil publik
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    
    // Rute untuk MENGEDIT profil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Rute untuk UPDATE dan DELETE profil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute resource lainnya (Tidak diubah)
    Route::resource('categories', CategoryController::class)->except(['create', 'store']);
    Route::resource('teams', TeamController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('events', EventController::class);
    Route::resource('proposals', ProposalController::class);
    Route::resource('progress', ProgressController::class);
    Route::resource('discussions', DiscussionController::class);
    Route::resource('attachments', AttachmentController::class);

    // --- PENAMBAHAN RUTE BARU UNTUK FITUR PERMOHONAN BERGABUNG ---
    
    // Rute untuk user mengirim permohonan bergabung ke sebuah tim
    Route::post('/teams/{team}/join-request', [JoinRequestController::class, 'store'])->name('join-requests.store');
    
    // Rute untuk leader melihat daftar permohonan yang masuk
    Route::get('/join-requests', [JoinRequestController::class, 'index'])->name('join-requests.index');
    
    // Rute untuk leader menyetujui permohonan
    Route::post('/join-requests/{joinRequest}/approve', [JoinRequestController::class, 'approve'])->name('join-requests.approve');
    
    // Rute untuk leader menolak permohonan
    Route::post('/join-requests/{joinRequest}/reject', [JoinRequestController::class, 'reject'])->name('join-requests.reject');

});

// Rute otentikasi
require __DIR__.'/auth.php';