<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::permanentRedirect('/', 'login');

Route::middleware('auth')->group(function () {
    Route::get('welcome', [\App\Http\Controllers\PageController::class, 'welcome'])->name('welcome');
    Route::get('consultation', [\App\Http\Controllers\PageController::class, 'consultation'])->name('consultation');
    Route::get('checklists/{checklist}', [\App\Http\Controllers\User\ChecklistController::class, 'show'])->name('user.checklists.show');

    Route::middleware('is_admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class)->only(['edit', 'update']);
        Route::resource('groups', \App\Http\Controllers\Admin\GroupController::class)->except('index', 'show');
        Route::resource('groups.checklists', \App\Http\Controllers\Admin\ChecklistController::class);
        Route::resource('checklists.tasks', \App\Http\Controllers\Admin\TaskController::class);
        Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    });
});

