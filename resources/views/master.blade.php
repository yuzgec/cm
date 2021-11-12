<!doctype html>

<html lang="tr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>@yield('title', config('app.name'))</title>
        @include('layouts.css')
        @yield('customCSS')
    </head>
    <body class="antialiased">
        <div class="wrapper">

            @include('layouts.sidebar')
            @include('layouts.header')

            <div class="page-wrapper">
                
                <div class="container-xl">
                    <div class="page-header d-print-none">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="page-pretitle">
                                    Yönetim Paneli
                                </div>
                                <h2 class="page-title">
                                    Çağrı Merkezi Sistemi
                                </h2>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <span class="d-none d-sm-inline">
                                        <a href="#" class="btn btn-white">
                                        Duyurular
                                        </a>
                                    </span>
                                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                        Destek Talebi Oluştur
                                    </a>
                                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="container-xl">
                        <div class="row row-deck row-cards">
                            
                            @yield('content')
                        </div>
                    </div>
                </div>
              
                @include('layouts.footer')

            </div>
        </div>
   
        @include('layouts.js')
        @yield('customJS')

    </body>
</html>