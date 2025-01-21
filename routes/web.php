<?php

use App\Http\Controllers\MenubarController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::name('menubar.')->prefix('menubar')->group(function () {
    Route::get('', [MenubarController::class, 'index'])->name('index');
    Route::post('break', [MenubarController::class, 'storeBreak'])->name('storeBreak');
    Route::post('work', [MenubarController::class, 'storeWork'])->name('storeWork');
    Route::post('stop', [MenubarController::class, 'storeStop'])->name('storeStop');
    Route::get('open-setting', [MenubarController::class, 'openSetting'])->name('openSetting');
    Route::get('open-overview', [MenubarController::class, 'openOverview'])->name('openOverview');
});

Route::name('settings.')->prefix('settings')->group(function () {
    Route::get('edit', [SettingsController::class, 'edit'])->name('edit');
    Route::patch('', [SettingsController::class, 'update'])->name('update');
});

Route::name('overview.')->prefix('overview')->group(function () {
    Route::get('', [OverviewController::class, 'index'])->name('index');
    Route::get('{date}', [OverviewController::class, 'show'])->name('show');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
