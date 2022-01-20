<?php
    Route::resource('/dashboard', 'DashboardController')->middleware('auth');
