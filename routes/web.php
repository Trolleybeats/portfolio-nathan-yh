<?php

use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\TechnologieController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
        'profil' => \App\Models\Profil::first(),
        'technologies' => \App\Models\Technologie::all(),
        'projets' => \App\Models\Projet::all(),
        'education' => \App\Models\Education::all(),
        'experiences' => \App\Models\Experience::all(),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('projets', ProjetController::class)->middleware(['auth', 'verified']);

Route::resource('technologies', TechnologieController::class)->middleware(['auth', 'verified']);

Route::resource('education', EducationController::class)->middleware(['auth', 'verified']);

Route::resource('experiences', ExperienceController::class)->middleware(['auth', 'verified']);

Route::resource('profil', \App\Http\Controllers\ProfilController::class)->middleware(['auth', 'verified']);

require __DIR__.'/settings.php';
