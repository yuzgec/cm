<!doctype html>
<html lang="tr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Giriş Yap</title>
        <link href="/assets/css/tabler.min.css" rel="stylesheet"/>
    </head>
    <body class="antialiased border-top-wide border-primary d-flex flex-column">
        <div class="page page-center">
            <div class="container-tight py-4">

                <div class="text-center mb-4">
                    <a href="javascript:void()">
                        <img src="{{ url('assets/images/logo2.png')}}" width="400" alt="{{ config('app.name')}}">
                    </a>
                </div>

                <form class="card card-md" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Yeni Kullanıcı Oluştur</h2>
                
                    <div class="form-group mb-1">
                        <label for="singin-email-2">Adınız Soyadınız *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="singin-email-2">Telefon Numaranız *</label>
                        <input type="text" class="form-control @error('telefon') is-invalid @enderror" name="telefon" value="{{ old('telefon') }}"  autocomplete="telefon" autofocus>
                        @error('telefon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="singin-email-2">Kullanıcı Adı veya Email *</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="singin-password-2">Şifreniz *</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="singin-password-2">Tekrar Şifre *</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100%">
                            Kayıt Ol
                        </button>
                    
                    </div>
                </form>
            </div>    
        </div>

        <script src="/assets/js/tabler.min.js"></script>
    </body>
</html>



                   