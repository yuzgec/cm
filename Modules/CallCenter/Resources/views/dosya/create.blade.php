@extends('master')
@section('title', 'Dosya Ekle | '.config('app.name'))
@section('content')
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <div class="mb-1 d-flex justify-content-between">
                    <div></div>
                    <div>
                        <a class="btn btn-danger" href="{{ route('dosya.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                            </svg>
                            Dosya Listesi
                        </a>
                    </div>
                </div>

                <form action="{{ route('dosya.store') }}" method="POST">
                    @csrf
                    <x-form-inputtext label="Klasör" name="klasor"/>
                    <x-form-inputtext label="Föy NO" name="foy_no"/>
                    <x-form-inputtext label="Takip Tarihi" name="takip_tarihi"/>
                    <x-form-inputtext label="Alacaklı İsim" name="alacakli_isim"/>
                    <x-form-inputtext label="Karşı Yan İsim" name="karsi_yan_isim"/>
                    <x-form-inputtext label="T.C. Kimlik / Mersis No" name="tckn"/>
                    <x-form-inputtext label="İcra Dosya No" name="icra_dosya_no"/>
                    <x-form-inputtext label="İcra Müdürlüğü / No" name="icra_mudurlugu"/>
                    <x-form-inputtext label="Form Türü" name="form_turu"/>
                    <x-form-inputtext label="Kalan Alacak" name="kalan_alacak"/>
                    <x-form-inputtext label="Borçlu Hesabı PB" name="borclu_hesabi"/>
                    <x-form-inputtext label="Telefon 1" name="telefon_1"/>
                    <x-form-inputtext label="Telefon 2" name="telefon_2"/>
                    <x-form-inputtext label="Telefon 3" name="telefon_3"/>
                    <x-form-inputtext label="Telefon 4" name="telefon_4"/>
                    <x-form-inputtext label="Telefon 5" name="telefon_5"/>
                    <x-form-inputtext label="Föy Durumu" name="foy_durumu"/>
                    <button class="btn btn-primary mt-2" type="submit" style="width: 100%;">Kaydet</button>
                </form>
            </div>
        </div>
    </div>

@endsection
