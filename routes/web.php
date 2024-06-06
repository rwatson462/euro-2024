<?php

use App\Http\Controllers\AddTeamToLeagueController;
use App\Http\Controllers\CreateFixtureController;
use App\Http\Controllers\CreateLeagueController;
use App\Http\Controllers\CreateTeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecalculateLeagueTableController;
use App\Http\Controllers\StoreResultController;
use App\Http\Controllers\Views\AddResultController;
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
        Route::get('/{league_id}/recalculate-table', RecalculateLeagueTableController::class)->name('recalculate-table');
    });

    Route::prefix('results')->as('results.')->group(function () {
        Route::get('/{fixture_id}', AddResultController::class)->name('add');
        Route::post('/{fixture_id}', StoreResultController::class)->name('store');
    });
});

// --- User related stuff

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
