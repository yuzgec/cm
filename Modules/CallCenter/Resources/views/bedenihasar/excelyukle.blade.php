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
                        <a class="btn btn-danger" href="{{ route('bedenihasar.index') }}">
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
                <form method="post" action="{{route('callcenter.bedenihasar.exceloku')}}" enctype="multipart/form-data">
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
                <form action="{{ route('callcenter.bedenihasar.excelisle') }}" method="POST">
                    <input type="hidden" name="filePath" value="{{$fileName}}">
                    @csrf
                    <div class="form-group mb-3 row">
                        <div class="col-6">
                            <x-form-select label="Vaka Türü" name="vaka_turu" :list="$columns"/>
                            <x-form-select label="Şube" name="sube" :list="$columns"/>
                            <x-form-select label="Hastane" name="hastane" :list="$columns"/>
                            <x-form-select label="Yetkili" name="yetkili" :list="$columns"/>
                            <x-form-select label="M.Tarihi" name="m_tarihi" :list="$columns"/>
                            <x-form-select label="Hasta Adı Soyadı" name="hasta" :list="$columns"/>
                            <x-form-select label="T.C." name="tc" :list="$columns"/>
                            <x-form-select label="Cep Telefonu 1" name="telefon1" :list="$columns"/>
                            <x-form-select label="Cep Telefonu 2" name="telefon2" :list="$columns"/>
                        </div>
                        <div class="col-6">
                            <x-form-select label="Bilgi" name="bilgi" :list="$columns"/>
                            <x-form-select label="Adli Muayene" name="adli_muayene" :list="$columns"/>
                            <x-form-select label="Parti İsmi" name="parti_ismi" :list="$columns"/>
                            <x-form-select label="İL" name="il" :list="$columns"/>
                            <x-form-select label="Kaynak" name="kaynak" :list="$columns"/>
                            <x-form-select label="Hastane Bölüm" name="hastane_bolum" :list="$columns"/>
                            <x-form-select label="Tedavi Türü" name="tedavi_turu" :list="$columns"/>
                            <x-form-select label="İkamet Adresi" name="ikamet_adresi" :list="$columns"/>
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
