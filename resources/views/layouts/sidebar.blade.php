<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{route('dashboard.index')}}" title="Dashboard">
                <img src="{{url('assets/images/logo.png')}}" width="250"  alt="{{config('app.name')}}" class="navbar-brand-image">
            </a>
        </h1>
     
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">

                <li class="nav-item  {{ menu_is_active('dashboard') }}">
                    <a class="nav-link" href="{{route('dashboard.index')}}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
             
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
                                <a class="dropdown-item" href="{{route('roller.index')}}" title="Kullanıcı Rolleri">
                                    Kullanıcı Rolleri
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
              
                <li class="nav-item {{ menu_is_active('sms') }} dropdown">
                    <a class="nav-link dropdown-toggle {{ menu_is_active('rapor', 'show') }}" href="#sms" data-bs-toggle="dropdown" role="button" aria-expanded="{{ menu_is_active('sms', 'true') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                            </svg>
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
                        <a class="dropdown-item" href="{{route('smssablon')}}" title="SMS Şablonları">
                            SMS Şablonları
                        </a>
                        <a class="dropdown-item" href="{{route('smsraporlama')}}" title="SMS Raporlama">
                            SMS Raporlama
                        </a>
                    </div>
                </li>
                
                <li class="nav-item  {{ menu_is_active('rapor') }} dropdown">
                    <a class="nav-link dropdown-toggle {{ menu_is_active('rapor', 'show') }}" href="#rapor" data-bs-toggle="dropdown" role="button" aria-expanded="{{ menu_is_active('rapor', 'true') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                            </svg>
                        </span>
                        <span class="nav-link-title {{ menu_is_active('rapor') }}">
                            Rapor Yönetimi
                        </span>
                    </a>
                    <div class="dropdown-menu {{ menu_is_active('rapor', 'show') }}">
                        <a class="dropdown-item" href="{{ route('rapor.index') }}" >
                            Rapor Anasayfa
                        </a>
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Personel Raporlama
                        </a>
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Çağrı Raporlama
                        </a>
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Ödeme Raporlama
                        </a>
                    </div>
                </li>

                <li class="nav-item  {{ menu_is_active('personel') }} dropdown">
                    <a class="nav-link dropdown-toggle" href="#sms" data-bs-toggle="dropdown" role="button" aria-expanded="{{ menu_is_active('personel', 'true') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                        </svg>
                        </span>
                        <span class="nav-link-title {{ menu_is_active('personel') }}">
                            Personel Yönetimi
                        </span>
                    </a>

                    <div class="dropdown-menu {{ menu_is_active('personel', 'show') }}">
                        <a class="dropdown-item" href="{{route('personel.index')}}" title="Personel Listesi">
                            Personel Listesi
                        </a>
                        <a class="dropdown-item" href="{{route('mesai.index')}}" >
                            Personel Çalışma Grupları
                        </a>
                       
                        <a class="dropdown-item" href="{{route('giriscikis')}}" >
                            Personel Giriş-Çıkış
                        </a>
                        <a class="dropdown-item" href="{{route('mesairaporlama')}}" >
                            Personel Raporlama
                        </a>
                    </div>
                </li>
            
                <li class="nav-item  {{ menu_is_active('ayar') }} dropdown">
                    <a class="nav-link dropdown-toggle" href="#sms" data-bs-toggle="dropdown" role="button" aria-expanded="{{ menu_is_active('ayar', 'true') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                        </span>
                        <span class="nav-link-title {{ menu_is_active('ayar') }}">
                            Ayar Yönetimi
                        </span>
                    </a>

                    <div class="dropdown-menu {{ menu_is_active('ayar', 'show') }}">
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Ayar 1
                        </a>
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Ayar 2
                        </a>
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Ayar 3
                        </a>
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Ayar 4
                        </a>
                        <a class="dropdown-item" href="{{route('dashboard.index')}}" >
                            Ayar 5
                        </a>
                    </div>
                </li>

                <li class="nav-item  {{ menu_is_active('odeme') }}">
                    <a class="nav-link" href="{{route('odeme.index')}}" title="Ödeme Al">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <line x1="9" y1="9" x2="10" y2="9" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="9" y1="17" x2="15" y2="17" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Ödeme Al
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./docs/index.html" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <line x1="9" y1="9" x2="10" y2="9" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="9" y1="17" x2="15" y2="17" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Kullanım Kılavuzu
                        </span>
                    </a>
                </li>
            
            </ul>
        </div>
    </div>
</aside>