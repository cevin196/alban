<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\ConditionReportController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobPriorityController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsappController;
use App\Models\Admin\Job;
use App\Models\Admin\Service;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

    Route::get('jobPriority', [JobPriorityController::class, 'index'])->name('jobPriority.index');
    Route::resource('job', JobController::class)->except('destroy');

    Route::resource('conditionReport', ConditionReportController::class)->only(['store', 'edit']);

    Route::get('condition/send/{conditionReport}', [ConditionReportController::class, 'send'])->name('conditionReport.send');
    Route::get('condition/create/{job}', [ConditionReportController::class, 'create'])->name('conditionReport.create');

    Route::resource('finance', FinanceController::class)->except(['show', 'destroy']);
});

Route::get('condition/print/{conditionReport}', [ConditionReportController::class, 'print'])->name('conditionReport.print');
Route::get('job/print/{job}', [JobController::class, 'print'])->name('job.print');
Route::get('monitoring/', [NavigationController::class, 'monitoring'])->name('monitoring');

// Route::get('testRequest', [WhatsappController::class, 'testRequest']);


require __DIR__ . '/auth.php';
