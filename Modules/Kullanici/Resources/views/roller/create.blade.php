@extends('master')
@section('title', 'Kullanıcı Rol Ekle | '.config('app.name'))
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
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

                        <div class="col-auto ms-auto d-print-none mb-1">
                            <a href="{{ route('dashboard.index')}}" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Yönetim Anasayfa
                            </a>
                            <a href="{{ route('kullanici.index')}}" class="btn btn-primary ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Kullanıcı Listesi
                            </a>
                            <a href="{{ route('roller.index')}}" class="btn btn-primary ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Rol Listesi
                            </a>

                        </div>
                    </div>
                </div>
                <form action="{{ route('roller.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h3 class="card-title text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                        Kullanıcı Rol Oluştur
                                    </h3>
                                </div>

                                <div class="card-body">

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Rol Adı </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="name" placeholder="Rol Adı Giriniz...." value="{{ old('name') }}" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-selectgroup">
                                        @foreach($Permission as $p)
                                            <label class="form-selectgroup-item">
                                                <input type="checkbox" name="permission[]" value="{{ $p->name }}" class="form-selectgroup-input">
                                                <span class="form-selectgroup-label">{{ $p->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Kaydet</button>

                            </div>
                        </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
