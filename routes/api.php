<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('user/{userId}', [UserController::class, 'user']);

Route::post('auth/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');

Route::get('directory/developers/{userId}', [DirectoryController::class, 'getDevelopers']);
Route::get('directory/developer/{userId}', [DirectoryController::class, 'getDeveloperInformation']);
Route::get('directory/last-twenty-developers', [DirectoryController::class, 'getLastTwentyDevelopers']);

Route::get('company/companies', [CompanyController::class, 'getCompanies']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('auth/logout', [AuthController::class, 'logout']);
});
