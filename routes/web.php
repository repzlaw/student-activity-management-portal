<?php

use App\Livewire\Task\GetTask;
use App\Livewire\Task\EditTask;
use App\Livewire\Task\ShowTask;
use App\Livewire\Event\GetEvent;
use App\Livewire\Event\EditEvent;
use App\Livewire\Event\ShowEvent;
use App\Livewire\Task\CreateTask;
use App\Livewire\Event\CreateEvent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Activity\GetActivity;
use App\Livewire\Activity\EditActivity;
use App\Livewire\Activity\ShowActivity;
use App\Livewire\Activity\CreateActivity;
use App\Livewire\Credential\GetCredential;
use App\Http\Controllers\GeneralController;
use App\Livewire\Credential\EditCredential;
use App\Livewire\Credential\ShowCredential;
use App\Livewire\Credential\CreateCredential;
use App\Livewire\Dashboard\GetDashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/', GetDashboard::class)->name('dashboard');
    

    Route::prefix('activity')->name('activity.')->group(function () {
        Route::get('/', GetActivity::class)->name('list');
        Route::get('/create', CreateActivity::class)->name('create');
        Route::get('/{activity}/edit', EditActivity::class)->name('edit');
        Route::get('/{activity}/details', ShowActivity::class)->name('details');
    });

    Route::prefix('credential')->name('credential.')->group(function () {
        Route::get('/', GetCredential::class)->name('list');
        Route::get('/create', CreateCredential::class)->name('create');
        Route::get('/{credential}/edit', EditCredential::class)->name('edit');
        Route::get('/{credential}/details', ShowCredential::class)->name('details');
    });

    Route::prefix('event')->name('event.')->group(function () {
        Route::get('/', GetEvent::class)->name('list');
        Route::get('/create', CreateEvent::class)->name('create');
        Route::get('/{event}/edit', EditEvent::class)->name('edit');
        Route::get('/{event}/details', ShowEvent::class)->name('details');
    });

    Route::prefix('task')->name('task.')->group(function () {
        Route::get('/', GetTask::class)->name('list');
        Route::get('/create', CreateTask::class)->name('create');
        Route::get('/{task}/edit', EditTask::class)->name('edit');
        Route::get('/{task}/details', ShowTask::class)->name('details');
    });

    Route::post('/approval', [GeneralController::class, 'approval'])->name('approval');

});
