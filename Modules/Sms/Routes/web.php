<?php

Route::resource('/sms', 'SmsController')->middleware('auth');
