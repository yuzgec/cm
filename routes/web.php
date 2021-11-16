<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('roles', RoleController::class)->middleware('auth');
