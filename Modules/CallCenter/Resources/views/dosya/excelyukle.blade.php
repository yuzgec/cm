@extends('master')
@section('title', 'Excel Dosya Ekle | '.config('app.name'))
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-1 d-flex justify-content-between">
                    <div>
                        <div class="card-title">Excel Dosya Ekle</div>
                    </div>
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
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{route('callcenter.dosya.exceloku')}}" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-10">
                        <input type="file" name="upload" class="form-control" accept=".csv,.xlsx,.xls">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary w-full">Yükle</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    @if(@$columns)
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('callcenter.dosya.excelisle') }}" method="POST">
                    <input type="hidden" name="filePath" value="{{$fileName}}">
                    @csrf
                    <div class="form-group mb-3 row">
                        <div class="col-6">
                            <x-form-select label="Klasör" name="klasor" :list="$columns"/>
                            <x-form-select label="Föy NO" name="foy_no" :list="$columns"/>
                            <x-form-select label="Takip Tarihi" name="takip_tarihi" :list="$columns"/>
                            <x-form-select label="Alacaklı İsim" name="alacakli_adi" :list="$columns"/>
                            <x-form-select label="Karşı Yan İsim" name="borclu_adi" :list="$columns"/>
                            <x-form-select label="T.C. Kimlik / Mersis No" name="tc" :list="$columns"/>
                            <x-form-select label="Karşı Yan Vergi No" name="borclu_tc" :list="$columns"/>
                            <x-form-select label="İcra Dosya No" name="icra_dosya_no" :list="$columns"/>
                            <x-form-select label="İcra Müdürlüğü / No" name="icra_mudurlugu" :list="$columns"/>
                        </div>
                        <div class="col-6">
                            <x-form-select label="Form Türü" name="form_turu" :list="$columns"/>
                            <x-form-select label="Kalan Alacak" name="alacak" :list="$columns"/>
                            <x-form-select label="Borçlu Hesabı PB" name="para_birimi" :list="$columns"/>
                            <x-form-select label="Telefon 1" name="telefon_1" :list="$columns"/>
                            <x-form-select label="Telefon 2" name="telefon_2" :list="$columns"/>
                            <x-form-select label="Telefon 3" name="telefon_3" :list="$columns"/>
                            <x-form-select label="Telefon 4" name="telefon_4" :list="$columns"/>
                            <x-form-select label="Telefon 5" name="telefon_5" :list="$columns"/>
                            <x-form-select label="Föy Durumu" name="foy_durumu" :list="$columns"/>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary mt-2" type="submit" style="width: 100%;">Kaydet</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @endif
@endsection
