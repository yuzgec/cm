<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('roles', \App\Http\Controllers\RoleController::class)->middleware('auth');
