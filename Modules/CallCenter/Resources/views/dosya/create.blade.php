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
                    <x-form-inputtext label="İcra Dairesi" name="telefon"/>
                    <x-form-inputtext label="Dosya Numarası" name="telefon"/>
                    <x-form-inputtext label="Föy" name="telefon"/>
                    <x-form-inputtext label="Alacaklı İsim" name="telefon"/>
                    <x-form-inputtext label="Borçlu İsim" name="telefon"/>
                    <x-form-inputtext label="Borçlu TCKN" name="telefon"/>
                    <x-form-inputtext label="Telefon NO" name="telefon"/>
                    <x-form-inputtext label="Borçlu TCKN" name="telefon"/>
                    <x-form-inputtext label="Borç Konusu (Senete Cari Kazanç Kaybı)" name="telefon"/>
                    <x-form-inputtext label="Toplam Borç Tutarı" name="telefon"/>


                    <button class="btn btn-primary mt-2" type="submit" style="width: 100%;">Kaydet</button>
                </form>
            </div>
        </div>
    </div>

@endsection
