@extends('master')
@section('title', 'Ödeme Al | '.config('app.name'))
@section('customCSS')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
    
@endsection
@section('content')
    <div class="col-6 bg-white justify-content-center align-items-center p-3">

        <form action="{{ route('odemeal')}}" class="card card-md" method="POST">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Online Ödeme Ekranı</h2>

                <div class="form-group">
                    <label for="singin-email-2">Ödeme Alan Personel *</label>
                    <input type="text" name="personel" class="form-control mb-2" value="{{ Auth::user()->name }}" disabled>
                </div>

                <div class="form-group">
                    <label for="singin-email-2">Ödeme Alınacak Tutar *</label>
                    <input type="number" name="tutar" class="form-control mb-2" placeholder="Ödeme Alınacak Tutar">
                </div>

                <div class="form-group">
                    <label for="singin-email-2">İsim Soyisim *</label>
                    <input type="text" name="adsoyad" class="form-control mb-2" placeholder="Kart Üzerinde Yazan İsim Soyisim" value="{{old('adsoyad')}}">
                </div>

                <div class="form-group">
                    <label for="singin-email-2">Kart Numarası *</label>
                    <input type="text" name="kartno" class="form-control mb-2" placeholder="Kart Üzerinde Yazan İsim Soyisim" value="{{old('kartno')}}">
                </div>

                <div class="form-group d-flex justify-content-between">
                    <div class="col-5">
                        <label for="singin-email-2">Kart Son Kullanma Ay *</label>
                        <input type="text" name="kartay" class="form-control mb-2" placeholder="Kart Son Kullanma Ay Örn : 01" value="{{old('kartay')}}">
                    </div>
                    <div class="col-5">
                        <label for="singin-email-2">Kart Son Kullanma Yıl * -</label>
                        <input type="text" name="kartyil" class="form-control mb-2" placeholder="Kart Son Kullanma Ay Örn : 2021" value="{{old('kartyil')}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="singin-email-2">Kart CVC *</label>
                    <input type="text" name="cvc" class="form-control mb-2" placeholder="Kart CVC No" value="{{old('cvc')}}">
                </div>

                <div class="form-group">
                    <label for="singin-email-2">Kart CVC *</label>
                    <textarea type="text" name="aciklama" class="form-control mb-2" placeholder="Kart CVC No" value="{{old('aciklama')}}"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Ödemeyi Gerçekleştir</button>
            </div>
        </form>
    </div>
@endsection
