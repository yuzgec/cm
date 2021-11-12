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

                <form class="card card-md" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-body">

                        <div class="form-group mb-2">
                            <label for="singin-email-2">Email Adresiniz*</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="singin-password-2">Şifreniz *</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-footer">

                            <button type="submit" class="btn btn-primary btn-block" style="width: 100%">
                                Giriş Yap
                            </button>
                            <div class="d-flex justify-content-between mt-3">    
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" id="signin-remember-2" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="signin-remember-2">Beni Hatırla</label>
                                </div>
                                <div>
                                    <a href="{{ route('register') }}">
                                        Hesap Oluştur
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>    
                </form>
                
            </div>
        </div>
        <script src="/assets/js/tabler.min.js"></script>
    </body>
</html>