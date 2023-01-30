<?php

use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
});


require __DIR__ . '/auth.php';
