@extends('master')
@section('title', 'Kullanıcı Düzenle | '.config('app.name'))
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
                            <a href="{{ route('kullanici.create')}}" class="btn btn-primary ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Kullanıcı Listesi
                            </a>
                            <a href="{{ route('roles.create')}}" class="btn btn-primary ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Kullanıcı Grupları
                            </a>
                            
                        </div>
                    </div>
                </div>
                <form action="{{ route('kullanici.update', $detay->id )}}" method="POST" enctype="multipart/form-data">
                    @csrf   
                    @method('PUT')
                    <div class="row">
                        
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h3 class="card-title text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                        Kullanıcı Düzenle - {{ $detay->name}}
                                    </h3>
                                </div>
                
                                <div class="card-body">
                
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Adı Soyadı </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="name" placeholder="Kullanıcı Adı Soyadı Giriniz...." value="{{ $detay->name}}">
                                        </div>
                                    </div>
                
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Email Adresi </label>
                                        <div class="col">
                                            <input type="email" class="form-control" name="email" placeholder="Kullanıcı Email Adresi Giriniz...." value="{{ $detay->email}}">
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Telefon Numarası </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="telefon" placeholder="Kullanıcı Telefon Numarası Giriniz...." value="{{ $detay->telefon}}">
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Depertman</label>
                                        <div class="col">
                                            <select class="form-select" name="depertman">
                                                <option value="" disabled>Depertman Seçiniz...</option>
                                                <option value="1">Depertman Adı</option>
                                                <option value="1">Depertman Adı</option>
                                                <option value="1">Depertman Adı</option>
                                                <option value="1">Depertman Adı</option>
                                                <option value="1">Depertman Adı</option>
                                                <option value="1">Depertman Adı</option>
                                            </select>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Şifre </label>
                                        <div class="col">
                                            <input type="password" class="form-control" name="password" placeholder="Kullanıcı Şifresi Giriniz...." value="{{ $detay->password}}">
                                        </div>
                                    </div>
                                
        
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Şifre Tekrar</label>
                                        <div class="col">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Kullanıcı Şifresi  Giriniz...." value="{{ $detay->password}}">
                                        </div>
                                    </div>
                                
                                
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Kaydet</button>
                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-dark" style="justify-content:space-between; ">
                                    <h3 class="card-title text-white ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8v-2a2 2 0 0 1 2 -2h2" /><path d="M4 16v2a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v2" /><path d="M16 20h2a2 2 0 0 0 2 -2v-2" /><circle cx="12" cy="12" r="3" /></svg>
                                        Multimedya
                                    </h3>
                                    <a href="{{ route('dashboard.index') }}">
                                        <h3 class="card-title text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>
                                            Geri
                                        </h3>
                                    </a>
                                </div>
                                <div class="card-body">
                
                                    <div class="form-group mb-3 ">
                                        <label class="form-label">Kullanıcı Resim</label>
                                        <input type="file" class="form-control" name="profil_foto">
                                    </div>
                
                                </div>
                            </div>
                
                            <div class="card mt-2">
                                <div class="card-header bg-dark">
                                    <h3 class="card-title text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="3.6" y1="9" x2="20.4" y2="9" /><line x1="3.6" y1="15" x2="20.4" y2="15" /><path d="M11.5 3a17 17 0 0 0 0 18" /><path d="M12.5 3a17 17 0 0 1 0 18" /></svg>
                                        Yetki Ayarları
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3 row">
                                        <div class="col">
                                            <select class="form-select" multiple name="role" size="5">
                                                @foreach ($roles as $item)
                                                    <option value="{{ $item->name }}" {{ $detay->hasRole($item->name) ? 'selected' : null }}> {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection