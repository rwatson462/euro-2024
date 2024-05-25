<?php

use App\Http\Controllers\CreateLeagueController;
use App\Http\Controllers\CreateTeamController;
use App\Http\Controllers\ProfileController;
use App\Models\League;
use App\Models\Team;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard', [
            'teams' => Team::all(),
            'leagues' => League::all(),
        ]);
    })->name('dashboard');

    Route::post('/', CreateTeamController::class)->name('dashboard.create-team');
    Route::post('/', CreateLeagueController::class)->name('dashboard.create-league');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
