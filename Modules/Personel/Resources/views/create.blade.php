@extends('master')
@section('title', 'Personel Ekle | '.config('app.name'))
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('personel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        @include('layouts.validate')

                        <div class="col-md-8">
                            <div class="card">
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
