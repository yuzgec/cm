<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{route('dashboard.index')}}" title="Anasayfa">
                <img src="{{url('assets/images/logo.png')}}" width="250"  alt="{{config('app.name')}}" class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item  {{ menu_is_active('dashboard') }}">
                    <a class="nav-link" href="{{route('dashboard.index')}}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
                @can('Kullanıcı Yönetimi')
                <li class="nav-item  {{ menu_is_active('kullanici') }} dropdown">
                        <a class="nav-link dropdown-toggle" href="#kullanici" data-bs-toggle="dropdown" role="button" aria-expanded="{{ menu_is_active('kullanici', 'true') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /><line x1="16" y1="5.25" x2="8" y2="9.75" /></svg>
                        </span>
                        <span class="nav-link-title {{ menu_is_active('kullanici') }}">
                            Kullanıcı Yönetimi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ menu_is_active('kullanici', 'show') }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{route('kullanici.index')}}" title="Kullanıcıları Listele">
                                    Kullanıcıları Listele
                                </a>
                                @can('Kullanıcı Rol Yönetimi')
                                <a class="dropdown-item" href="{{route('roller.index')}}" title="Kullanıcı Rolleri">
                                    Kullanıcı Rolleri
                                </a>
                                @endcan
                                @can('Personel Çalışma Grupları')
                                    <a class="dropdown-item" href="{{route('mesai.index')}}" >
                                        Kullanici Çalışma Grupları
                                    </a>
                                @endcan
                                @can('Personel Giriş-Çıkış')
                                    <a class="dropdown-item" href="{{route('giriscikis')}}" >
                                        Kullanici Giriş-Çıkış
                                    </a>
                                @endcan
                                @can('Personel Raporlama')
                                    <a class="dropdown-item" href="{{route('mesairaporlama')}}" >
                                        Kullanici Raporlama
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </li>
                @endcan
                @can('SMS')
                <li class="nav-item {{ menu_is_active('sms') }} dropdown">
                    <a class="nav-link dropdown-toggle {{ menu_is_active('rapor', 'show') }}" href="#sms" data-bs-toggle="dropdown" role="button" aria-expanded="{{ menu_is_active('sms', 'true') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 3h10v8h-3l-4 2v-2h-3z" /><path d="M15 16v4a1 1 0 0 1 -1 1h-8a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h2" /><path d="M10 18v.01" /></svg>
                        </span>
                        <span class="nav-link-title {{ menu_is_active('sms') }}">
                            SMS Yönetimi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ menu_is_active('sms', 'show') }}">
                        <a class="dropdown-item" href="{{ route('sms.index') }}" title="SMS Dashboard">
                            SMS Dashboard
                        </a>

                        <a class="dropdown-item" href="{{route('smsgonder')}}" title="SMS Gönder">
                            SMS Gönder
                        </a>
                        <a class="dropdown-item" href="{{route('toplusmsgonder')}}" title="Toplu SMS Gönder">
                            Toplu SMS Gönder
                        </a>
                        <a class="dropdown-item" href="{{route('excelsmsgonder')}}" title="Excel ile SMS Gönder">
                            Excel ile SMS Gönder
                        </a>
                        <a class="dropdown-item" href="{{route('smssablon.index')}}" title="SMS Şablonları">
                            SMS Şablonları
                        </a>

                        @can('SMS Raporlama')
                        <a class="dropdown-item" href="{{route('smsraporlama')}}" title="SMS Raporlama">
                            SMS Raporlama
                        </a>
                        @endcan
                    </div>
                </li>
                @endcan
                @can('Rapor Yönetimi')
                <li class="nav-item  {{ menu_is_active('rapor') }} dropdown">
                    <a class="nav-link dropdown-toggle {{ menu_is_active('rapor', 'show') }}" href="#rapor" data-bs-toggle="dropdown" role="button" aria-expanded="{{ menu_is_active('rapor', 'true') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h4l3 8l4 -16l3 8h4" /></svg>
                        </span>
                        <span class="nav-link-title {{ menu_is_active('rapor') }}">
                            Rapor Yönetimi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ menu_is_active('rapor', 'show') }}">
                        <a class="dropdown-item" href="{{ route('rapor.index') }}" >
                            Rapor Anasayfa
                        </a>
                        @can('Personel Raporlama')
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Personel Raporlama
                        </a>
                        @endcan
                        @can('Çağrı Raporlama')
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Çağrı Raporlama
                        </a>
                        @endcan
                        @can('Ödeme Raporlama')
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Ödeme Raporlama
                        </a>
                        @endcan
                    </div>
                </li>
                @endcan
                @can('CallCenter')
                    <li class="nav-item  {{ menu_is_active('callcenter') }} dropdown">
                        <a class="nav-link dropdown-toggle" href="#sms" data-bs-toggle="dropdown" role="button" aria-expanded="{{ menu_is_active('callcenter', 'true') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="13" rx="2" width="4" height="6" /><rect x="16" y="13" rx="2" width="4" height="6" /><path d="M4 15v-3a8 8 0 0 1 16 0v3" /><path d="M18 19a6 3 0 0 1 -6 3" /></svg>
                        </span>
                            <span class="nav-link-title {{ menu_is_active('callcenter') }}">
                            Callcenter Yönetimi
                        </span>
                        </a>

                        <div class="dropdown-menu {{ menu_is_active('callcenter', 'show') }}">
                            <a class="dropdown-item" href="{{route('callcenter.index')}}" title="CallCenter Dashboard">
                                CallCenter Dashboard
                            </a>
                        </div>
                    </li>
                @endcan
                @can('Ayar Yönetimi')
                <li class="nav-item  {{ menu_is_active('ayar') }}">
                    <a class="nav-link" href="{{route('Ayarlar.index')}}" title="Agent Dashboard">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Ayarlar
                        </span>
                    </a>
                </li>
                @endcan
                @can('IK Yönetim')
                <li class="nav-item  {{ menu_is_active('ik') }} dropdown">
                    <a class="nav-link dropdown-toggle" href="#sms" data-bs-toggle="dropdown" role="button" aria-expanded="{{ menu_is_active('ik', 'true') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="13 3 13 10 19 10 11 21 11 14 5 14 13 3" /></svg>
                        </span>
                            <span class="nav-link-title {{ menu_is_active('ik') }}">
                             İK Yönetimi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ menu_is_active('ik', 'show') }}">
                        <a class="dropdown-item" href="{{route('IK.calisanlar')}}" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                                Çalışanlar
                        </a>
                        <a class="dropdown-item" href="{{route('harcamalar')}}" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" /><path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" /></svg>
                             Harcamalar
                        </a>
                        <a class="dropdown-item" href="{{route('IK.raporlar')}}" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" /><path d="M18 14v4h4" /><path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" /><rect x="8" y="3" width="6" height="4" rx="2" /><circle cx="18" cy="18" r="4" /><path d="M8 11h4" /><path d="M8 15h3" /></svg>
                             Raporlar
                        </a>
                        <a class="dropdown-item" href="{{route('takvim')}}" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                             Takvim
                        </a>
                    </div>
                </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;" id="btnIzinTalepEt">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z"></path></svg>
                        </span>
                        <span class="nav-link-title">
                            İzin Talep Et
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;" id="btnAvansTalepEt">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" /><path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Avans Talep Et
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;" id="btnIzinMutabakat">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 3h10v8h-3l-4 2v-2h-3z" /><path d="M15 16v4a1 1 0 0 1 -1 1h-8a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h2" /><path d="M10 18v.01" /></svg>
                        </span>
                        <span class="nav-link-title">
                            İzin Mutabakat Formu
                        </span>
                    </a>
                </li>

                @can('Ödeme Al')
                <li class="nav-item  {{ menu_is_active('odeme') }}">
                    <a class="nav-link" href="{{route('odeme.index')}}" title="Ödeme Al">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="3" /><line x1="3" y1="10" x2="21" y2="10" /><line x1="7" y1="15" x2="7.01" y2="15" /><line x1="11" y1="15" x2="13" y2="15" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Ödeme Al
                        </span>
                    </a>
                </li>
                @endcan
{{--                <hr>--}}
{{--                @include('layouts.agentsidebar')--}}
{{--                <hr>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{route('dashboard.index')}}" >--}}
{{--                        <span class="nav-link-icon d-md-none d-lg-inline-block">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" />--}}
{{--                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />--}}
{{--                                <line x1="9" y1="9" x2="10" y2="9" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="9" y1="17" x2="15" y2="17" />--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                        <span class="nav-link-title">--}}
{{--                            Kullanım Kılavuzu--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>


        </div>

    </div>
</aside>

