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
                    <div class="row">
                        <div class="col-6 mb-2">
                            <x-form-select label="Dosya Grubu" name="grup" :list="$Gruplar"/>
                        </div>
                        <div class="col-6 mb-2">
                            <x-form-select label="Form Türü" name="form_turu" :list="$FormTurleri"/>
                        </div>
                        <div class="col-6 mb-2">
                            <x-form-select label="Alacaklı" name="alacakli_id" :list="$Alacaklilar"/>
                        </div>
                        <div class="col-6 mb-2">
                            <x-form-select label="Borçlu" name="borclu_id" :list="$Borclular"/>
                        </div>
                        <div class="col-6 mb-2">
                            <x-form-inputtext label="Föy No" name="foy_no"/>
                        </div>
                        <div class="col-6 mb-2">
                            <x-form-inputtext label="İcra Dosya No" name="icra_dosya_no"/>
                        </div>
                        <div class="col-6 mb-2">
                            <x-form-select label="İcra Müdürlüğü" name="icra_mudurlugu" :list="$IcraMudurlukleri"/>
                        </div>
                        <div class="col-6 mb-2">
                            <x-form-select label="Föy Durumu" name="foy_durumu" :list="$FoyDurumlari"/>
                        </div>
                        <div class="col-6 mb-2">
                            <x-form-inputtext label="Tutar" name="tutar"/>
                        </div>
                        <div class="col-6 mb-2">
                            <x-form-date label="Takip Tarihi" name="takip_tarihi"/>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-2" type="submit" style="width: 100%;">Kaydet</button>
                </form>
            </div>
        </div>
    </div>

@endsection
