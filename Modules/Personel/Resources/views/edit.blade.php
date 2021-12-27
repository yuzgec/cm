@extends('master')
@section('title', 'Personel Düzenle | '.config('app.name'))
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('personel.update', $personel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        @include('layouts.validate')
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group mb-3 text-center ">
                                        <label class="form-label">Personel Resim</label>

                                        <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url({{'/images/personel/50/'.$personel->foto}})" title="{{$personel->adsoyad}}">
                                            {{ ($personel->foto == "") ? isim($personel->adsoyad) : null }}
                                        </span>

                                        <input type="file" class="form-control" name="foto" id="images">

                                        <div class="text-center mt-4">
                                            <div id="preview"></div>
                                        </div>
                                        @if($personel->durum == 1)
                                            <span class="badge bg-success ">Aktif Çalışan</span>
                                        @else
                                            <span class="badge bg-danger ">Eski Çalışan</span>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <p>Adı Soyadı</p>
                                        <p>{{ $personel->adsoyad }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Yönetici</p>
                                        <p>{{ @$personel->mesai->adsoyad }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Ünvan</p>
                                        <p>{{ @$personel->mesai->adsoyad }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Depertman</p>
                                        <p>{{ @$personel->mesai->mesai_adi }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>E-Posta</p>
                                        <p>{{ @$personel->email }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Telefon</p>
                                        <p>{{ @$personel->telefon}}</p>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Adı Soyadı </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="adsoyad" value="{{ $personel->adsoyad}}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Email Adresi </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="email"  value="{{ $personel->email}}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Telefon Numarası </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="telefon" value="{{ $personel->telefon}}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">TC Kimlik Numrası </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="tckn" value="{{ $personel->tckn}}">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Personel Grubu</label>
                                        <div class="col">
                                            <select class="form-select" name="mesai_id">
                                                <option value="">Personel Grubu Seçiniz...</option>
                                                @foreach ($mesai as $item)
                                                    <option value="{{ $item->id }}" {{ ($item->id == $personel->mesai_id) ? 'selected' : null }}>{{ $item->mesai_adi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Durumu</label>
                                        <div class="col">
                                            <select class="form-select" name="durum">
                                                <option value="1" {{ ($personel->durum == 1 ) ? 'selected' : null }}>Aktif</option>
                                                <option value="2" {{ ($personel->durum == 2 ) ? 'selected' : null }}>Pasif</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Kaydet</button>

                            </div>
                        </div>


                    </div>
            </form>
            </div>
        </div>
    </div>
@endsection
