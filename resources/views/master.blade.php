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
{{--                 
                <div class="container-xl">
                    <div class="page-header d-print-none">
                        <div class="row align-items-center">
                            {{-- <div class="col">
                                <div class="page-pretitle">
                                    Yönetim Paneli
                                </div>
                                <h2 class="page-title">
                                    Çağrı Merkezi Sistemi
                                </h2>
                            </div> 
                           
                        </div>
                    </div>
                </div> --}}

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