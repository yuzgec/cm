@extends('master')
@section('title', 'Sms Şablonları')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('smssablon.update', $sablon->id) }}" method="POST">

                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Sms Sablon Adı</label>
                        <div class="col">
                            <input type="text" class="form-control" name="sms_sablon_adi" placeholder="Sms Sablon Adı Giriniz...." value="{{ $sablon->sms_sablon_adi }}">
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Sms Şablonu</label>
                        <div class="col">
                            <textarea type="text" name="sms_sablon" class="form-control mesaj" rows="10">{{ $sablon->sms_sablon }}</textarea>
                            <div class="badge bg-success">
                                <span id="smssayisi">1</span>/<span id="smsboyut">5</span>
                            </div>
                            <small>1 SMS 160 Karakter İçermektedir.</small>
                        </div>
                    </div>


                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Durumu</label>
                        <div class="col">
                            <select class="form-select" name="durum">
                                <option value="1" {{ ($sablon->durum ==1) ? 'selected' : null}}>Aktif</option>
                                <option value="2" {{ ($sablon->durum ==2) ? 'selected' : null}}>Pasif</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label"></label>
                        <div class="col">
                            <button class="btn btn-primary" type="submit">Kaydet</button>
                        </div>
                    </div>


                </form>


            </div>
        </div>
    </div>
@endsection
