@extends('master')
@section('title', 'Dosya Görüntüle | '.config('app.name'))
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-1 d-flex justify-content-between">
                    <div>
                        <a href="javascript:;" class="btn btn-success">SMS Gönder</a>
                        <a href="javascript:;" class="btn btn-primary">Ödeme Al</a>
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
    <div class="col-lg-8 col-md-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <table class="table table-striped table-hover table-bordered table-vcenter">
                            <tbody>
                                <tr><td>Vaka Türü</td><td>{{$Dosya->vaka_turu}}</td></tr>
                                <tr><td>Şube</td><td>{{$Dosya->sube}}</td></tr>
                                <tr><td>Hastane</td><td>{{$Dosya->hastane}}</td></tr>
                                <tr><td>Yetkili</td><td>{{$Dosya->yetkili}}</td></tr>
                                <tr><td>M.Tarihi</td><td>{{Carbon\Carbon::parse($Dosya->m_tarihi)->format('d.m.Y')}}</td></tr>
                                <tr><td>Hasta Adı Soyadı</td><td>{{$Dosya->hasta}}</td></tr>
                                <tr><td>TC</td><td>{{$Dosya->tc}}</td></tr>
                                <tr><td>Cep Telefon 1</td><td>{{$Dosya->telefon1}}</td></tr>
                                <tr><td>Cep Telefon 2</td><td>{{$Dosya->telefon2}}</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-striped table-hover table-bordered table-vcenter">
                            <tbody>
                            <tr><td>Bilgi</td><td>{{$Dosya->bilgi}}</td></tr>
                            <tr><td>Adli Muayene</td><td>{{$Dosya->adli_muayene}}</td></tr>
                            <tr><td>Parti İsmi</td><td>{{$Dosya->parti_ismi}}</td></tr>
                            <tr><td>İl</td><td>{{$Dosya->il}}</td></tr>
                            <tr><td>Kaynak</td><td>{{$Dosya->kaynak}}</td></tr>
                            <tr><td>Hastane Bölüm</td><td>{{$Dosya->hastane_bolum}}</td></tr>
                            <tr><td>Tedavi Türü</td><td>{{$Dosya->tedavi_turu}}</td></tr>
                            <tr><td>İkamet Adresi</td><td>{{$Dosya->ikamet_adresi}}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 mt-5">
        <div class="card">
            {{Form::model($Gorusme, ["route" => ["callcenter.dosya.gorusmekaydet", $Dosya->id]])}}
            <div class="card-header">
                <h3 class="card-title">Görüşme & Detay Bilgileri</h3>
            </div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <x-form-inputtext name="telefon" label="Telefon"/>
                </div>
                <div class="form-group mb-3">
                    <x-form-textarea name="detay" label="Görüşme Detayı"/>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Tarih</label>
                    <input type="datetime-local" class="form-control {{(($errors->has("tarih"))?" is-invalid":"")}}" name="tarih" value="{{old('tarih')}}">
                    @if($errors->has("tarih"))
                        <div class="invalid-feedback">{{$errors->first("tarih")}}</div>
                    @endif
                </div>
                <div class="form-group mb-3">
                        <x-form-select
                            name="sonuc"
                            label="Sonuç"
                            :list="$SonucListe" />
                    </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
    <div class="col-6 mt-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Görüşme Kayıtları</div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tarih</th>
                            <th>Personel</th>
                            <th>Telefon</th>
                            <th>Detay</th>
                            <th>Sonuç</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\Modules\CallCenter\Entities\Gorusme::query()->where('dosya_id', $Dosya->id)->get() as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{Carbon\Carbon::parse($row->tarih)->format('d.m.Y H:i')}}</td>
                                <td>{{$row->Personel->full_name}}</td>
                                <td>{{$row->telefon}}</td>
                                <td>{{$row->detay}}</td>
                                <td>{{getGorusmeSonuc($row->sonuc)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6 mt-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Ses Kayıtları</div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-vcenter">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tarih</th>
                        <th>Telefon</th>
                        <th>Görüşme Süresi</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach([] as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{Carbon\Carbon::parse($row->tarih)->format('d.m.Y H:i')}}</td>
                            <td>{{$row->Personel->full_name}}</td>
                            <td>{{$row->telefon}}</td>
                            <td>{{$row->detay}}</td>
                            <td>{{getGorusmeSonuc($row->sonuc)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
