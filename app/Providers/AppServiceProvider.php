<?php

namespace App\Providers;

use App\View\Components\Form\Date;
use App\View\Components\Form\InputEMail;
use App\View\Components\Form\InputPassword;
use App\View\Components\Form\InputText;
use App\View\Components\Form\SelectBox;
use App\View\Components\Form\TextArea;
use App\View\Components\Widget\AvansTalepleri;
use App\View\Components\Widget\AvansTaleplerim;
use App\View\Components\Widget\CagriDurumu;
use App\View\Components\Widget\DosyaSayisi;
use App\View\Components\Widget\IzinTalepleri;
use App\View\Components\Widget\IzinTaleplerim;
use App\View\Components\Widget\MesaiBilgileri;
use App\View\Components\Widget\SonOdemeler;
use App\View\Components\Widget\ToplamOdemeler;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

        /**
         * Form Componentler
         */
        Blade::component('form-inputtext', InputText::class);
        Blade::component('form-password', InputPassword::class);
        Blade::component('form-email', InputEMail::class);
        Blade::component('form-date', Date::class);
        Blade::component('form-select', SelectBox::class);
        Blade::component('form-textarea', TextArea::class);


        /**
         * Widgetler
         */
        Blade::component('widget-avanstalepleri', AvansTalepleri::class);
        Blade::component('widget-avanstaleplerim', AvansTaleplerim::class);
        Blade::component('widget-izintalepleri', IzinTalepleri::class);
        Blade::component('widget-izintaleplerim', IzinTaleplerim::class);
        Blade::component('widget-mesaibilgileri', MesaiBilgileri::class);
        Blade::component('widget-sonodemeler', SonOdemeler::class);
        Blade::component('widget-toplamodemeler', ToplamOdemeler::class);
        Blade::component('widget-cagridurumu', CagriDurumu::class);
        Blade::component('widget-dosyasayisi', DosyaSayisi::class);


        Blade::if('departmanyonetici', function (){
            return \auth()->user()->DepartmanYonetici()->count() || \auth()->user()->email == "ceyda.demir@mecitkahraman.com.tr";
        });

    }
}
