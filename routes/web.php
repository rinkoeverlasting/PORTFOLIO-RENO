<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;

Route::get('/', [ProfileController::class, 'index'])->name('home');
Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload');
Route::post('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete-photo');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/skills', function() { return redirect()->route('projects.index'); });
Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
Route::post('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
Route::post('/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('projects.delete');
