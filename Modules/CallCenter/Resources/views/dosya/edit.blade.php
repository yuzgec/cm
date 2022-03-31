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

                {{Form::model($Dosya, ["route" => "dosya.store"])}}
{{--                <form action="{{ route('dosya.store') }}" method="POST">--}}
                    @csrf
                    <div class="row">
                        <div class="col-6 mb-2"><x-form-inputtext label="Klasör" name="klasor"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Föy No" name="foy_no"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Takip Tarihi" name="takip_tarihi"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Alacaklı Adı" name="alacakli_adi"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Borçlu Adı" name="borclu_adi"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="TC" name="tc"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Borçlu TC" name="borclu_tc"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="İcra Dosya No" name="icra_dosya_no"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="İcra Müdürlüğü" name="icra_mudurlugu"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Form Türü" name="form_turu"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Alacak" name="alacak"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Para Birimi" name="para_birimi"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Telefon 1" name="telefon1"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Telefon 2" name="telefon2"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Telefon 3" name="telefon3"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Telefon 4" name="telefon4"/></div>
                        <div class="col-6 mb-2"><x-form-inputtext label="Telefon 5" name="telefon5"/></div>

                    </div>
                    <button class="btn btn-primary mt-2" type="submit" style="width: 100%;">Kaydet</button>
                </form>
            </div>
        </div>
    </div>

@endsection
