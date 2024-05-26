<?php

use App\Http\Controllers\AddTeamToLeagueController;
use App\Http\Controllers\CreateFixtureController;
use App\Http\Controllers\CreateLeagueController;
use App\Http\Controllers\CreateTeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Views\ViewDashboardController;
use App\Http\Controllers\Views\ViewLeagueController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', ViewDashboardController::class)->name('dashboard');

        Route::post('/', CreateTeamController::class)->name('dashboard.create-team');
        Route::post('/', CreateLeagueController::class)->name('dashboard.create-league');
    });

    Route::prefix('leagues')->as('league.')->group(function () {
        Route::get('/{league_id}', ViewLeagueController::class)->name('view');

        Route::post('/{league_id}/add-team', AddTeamToLeagueController::class)->name('add-team');
        Route::post('/{league_id}/create-fixture', CreateFixtureController::class)->name('create-fixture');
    });
});

// --- User related stuff

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
