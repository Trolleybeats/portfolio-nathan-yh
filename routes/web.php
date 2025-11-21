<?php

use App\Http\Controllers\ProjetController;
use App\Http\Controllers\TechnologieController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('projets', ProjetController::class)->middleware(['auth', 'verified']);

Route::resource('technologies', TechnologieController::class)->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
