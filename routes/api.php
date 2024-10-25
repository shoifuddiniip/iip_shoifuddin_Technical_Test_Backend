<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\UsersController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(UsersController::class)->group(function () {
    Route::post('/restrict-salesperson/{id}', 'restrict')->middleware('role:Super Admin');
});

Route::controller(LeadsController::class)->group(function () {
    Route::get('/leads', 'index')->middleware('role:Customer Service,Super Admin'); // Get All for CS
    Route::get('/leads', 'store')->middleware('role:Customer Service,Super Admin'); // Inset for CS
});
