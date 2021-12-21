<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
       //dd(DB::table('role_has_permissions')->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')->get());
        Paginator::useBootstrap();
        Carbon::setLocale(config('app.locale'));
        if(env('APP_ENV') != 'local')
            URL::forceScheme('https');
    }
}
