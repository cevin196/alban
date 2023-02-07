<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Admin\Criteria;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    notify()->success('Laravel Notify is awesome!');
    return view('test');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [NavigationController::class, 'dashboard'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::post('role/changePermission', [RoleController::class, 'changePermission'])->name('role.changePermission');
    Route::get('permission/', [PermissionController::class, 'index'])->name('permission.index');
    Route::resource('criteria', CriteriaController::class)->except(['show', 'destroy']);
    Route::resource('alternative', AlternativeController::class)->except('destroy');
});

require __DIR__ . '/auth.php';
