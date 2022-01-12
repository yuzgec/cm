<?php

namespace App\Providers;

use App\View\Components\Form\Date;
use App\View\Components\Form\InputEMail;
use App\View\Components\Form\InputPassword;
use App\View\Components\Form\InputText;
use App\View\Components\Form\SelectBox;
use App\View\Components\Form\TextArea;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
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

        Blade::component('form-inputtext', InputText::class);
        Blade::component('form-password', InputPassword::class);
        Blade::component('form-email', InputEMail::class);
        Blade::component('form-date', Date::class);
        Blade::component('form-select', SelectBox::class);
        Blade::component('form-textarea', TextArea::class);
    }
}
