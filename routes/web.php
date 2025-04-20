<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->name('home');

Route::get('/users', [UserController::class, 'getUsers'])->name('users.data');

Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/save', [UserController::class, 'save'])->name('users.save');

Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');

Route::get('/users/export', [UserController::class, 'export'])->name('users.export');

Route::get('/audio', [AudioController::class, 'index'])->name('audio');

Route::post('/audio/get-duration', [AudioController::class, 'getAudioDuration'])->name('audio.get-duration');

Route::get('/distance', [DistanceController::class, 'index'])->name('distance');

Route::post('/distance/get-distance', [DistanceController::class, 'calculateDistance'])->name('distance.get-distance');