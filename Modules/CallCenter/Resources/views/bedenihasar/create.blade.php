@extends('master')
@section('title', 'Dosya Ekle | '.config('app.name'))
@section('content')
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <div class="mb-1 d-flex justify-content-between">
                    <div></div>
                    <div>
                        <a class="btn btn-danger" href="{{ route('bedenihasar.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                            </svg>
                            Dosya Listesi
                        </a>
                    </div>
                </div>

                {{Form::model($Dosya, ["route" => "bedenihasar.store"])}}
{{--                <form action="{{ route('dosya.store') }}" method="POST">--}}
                    @csrf
                    <div class="row">
                        <div class="col-6 mb-2"><x-form-inputtext label="Vaka Türü" name="vaka_turu"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Şube" name="sube"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Hastane" name="hastane"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Yetkili" name="yetkili"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="M. Tarihi" name="m_tarihi"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Hasta Adı Soyadı" name="hasta"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="TC" name="tc"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Telefon 1" name="telefon1"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Telefon 2" name="telefon2"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Bilgi" name="bilgi"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Adli Muayene" name="adli_muayene"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Parti İsmi" name="parti_ismi"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="İl" name="il"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Kaynal" name="kaynak"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Hastane Bölüm" name="hastane_bolum"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Tedavi Türü" name="tedavi_turu"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="İkamet Adresi" name="ikamet_adresi"/></div>

                    </div>
                    <button class="btn btn-primary mt-2" type="submit" style="width: 100%;">Kaydet</button>
                </form>
            </div>
        </div>
    </div>

@endsection
