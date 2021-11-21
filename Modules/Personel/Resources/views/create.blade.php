@extends('master')
@section('title', 'Personel Ekle | '.config('app.name'))
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
                                Personel Listesi
                            </a>
                            <a href="{{ route('roles.create')}}" class="btn btn-primary ml-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Personel Grupları
                            </a>
                            
                        </div>
                    </div>
                </div>
                <form action="{{ route('personel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="row">

                        @include('layouts.validate')

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-dark">
                                    <h3 class="card-title text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                        Personel Oluştur
                                    </h3>
                                </div>
                
                                <div class="card-body">
                
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Adı Soyadı </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="adsoyad" placeholder="Personel Adı Soyadı Giriniz...." value="{{ old('adsoyad') }}">
                                        </div>
                                    </div>
                
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Email Adresi </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="email" placeholder="Personel Email Adresi Giriniz...." value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Telefon Numarası </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="telefon" placeholder="Personel Telefon Numarası Giriniz...." value="{{ old('telefon') }}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">TC Kimlik Numrası </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="tckn" placeholder="T.C Kimlik Numarası Giriniz...." value="{{ old('tckn') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Personel Grubu</label>
                                        <div class="col">
                                            <select class="form-select" name="mesai_id">
                                                <option value="">Personel Grubu Seçiniz...</option>
                                                @foreach ($mesai as $item)
                                                    <option value="{{ $item->id }}">{{ $item->mesai_adi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Durumu</label>
                                        <div class="col">
                                            <select class="form-select" name="durum">
                                                <option value="" disabled>Durum Seçiniz...</option>
                                                <option value="1">Aktif</option>
                                                <option value="2">Pasif</option>
                                            </select>
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
                                        <label class="form-label">Personel Resim</label>
                                        <input type="file" class="form-control" name="foto" id="images">

                                        <div class="text-center mt-4">
                                            <div id="preview"></div>
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