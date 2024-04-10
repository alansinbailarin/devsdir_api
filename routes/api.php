<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserStatusController;

Route::get('user/{userId}', [UserController::class, 'user']);

// Auth
Route::post('auth/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');

// Directory
Route::get('directory/developer/info/{uuid}', [DirectoryController::class, 'getDeveloper']);
Route::get('directory/developers/{userId}', [DirectoryController::class, 'getDevelopers']);
Route::get('directory/developer/{userId}', [DirectoryController::class, 'getDeveloperInformation']);
Route::get('directory/last-twenty-developers', [DirectoryController::class, 'getLastTwentyDevelopers']);

// Company
Route::get('company/companies', [CompanyController::class, 'getCompanies']);

// Status
Route::get('status/{statusId}', [UserStatusController::class, 'getStatusById']);

// Job types
Route::get('job-types', [JobTypeController::class, 'getJobTypes']);
Route::get('job-type/{jobTypeId}', [JobTypeController::class, 'getJobType']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('auth/logout', [AuthController::class, 'logout']);
});
