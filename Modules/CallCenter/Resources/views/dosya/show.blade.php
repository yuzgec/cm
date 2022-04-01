@extends('master')
@section('title', 'Dosya Görüntüle | '.config('app.name'))
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
                                <tr><td>Portföy Sahibi</td><td>&nbsp;</td></tr>
                                <tr><td>Borçlu Kod</td><td></td></tr>
                                <tr><td>Takip Tarihi</td><td>{{Carbon\Carbon::parse($Dosya->takip_tarihi)->format('d.m.Y')}}</td></tr>
                                <tr><td>Form Türü</td><td>{{$Dosya->form_turu}}</td></tr>
                                <tr><td>Müvekkil</td><td>{{$Dosya->alacakli_adi}}</td></tr>
                                <tr><td>İcra Müdürlüğü / Dosya No</td><td>{{$Dosya->icra_mudurlugu. " / " . $Dosya->icra_dosya_no}}</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-striped table-hover table-bordered table-vcenter">
                            <tbody>
                            <tr><td>Karşı Yan İsmi	</td><td>{{$Dosya->borclu_adi}}</td></tr>
                            <tr><td>TC Kimlik</td><td>{{$Dosya->borclu_tc}}</td></tr>
                            <tr><td>Kesinleşme Tarihi</td><td></td></tr>
                            <tr><td>Kesinleşmiş Föy</td><td></td></tr>
                            <tr><td>Kalan Alacak</td><td class="text-end">{{number_format($Dosya->alacak,2)}} {{$Dosya->para_birimi}}</td></tr>
                            <tr><td>İşlem Tipi</td><td></td></tr>
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
    <div class="col-12 mt-5">
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
@endsection
