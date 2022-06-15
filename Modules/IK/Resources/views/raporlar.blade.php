@extends('master')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <ul class="nav nav-tabs" data-bs-toggle="tabs" id="tab">
                <li class="nav-item">
                    <a href="#mesai" class="nav-link active" data-bs-toggle="tab"><span class="m-2">Mesai</span></a>
                </li>
                <li class="nav-item">
                    <a href="#mesaitarih" class="nav-link" data-bs-toggle="tab"><span class="m-2">Mesai Tarih Aralığı</span></a>
                </li>
                <li class="nav-item">
                    <a href="#izinler" class="nav-link " data-bs-toggle="tab"><span class="m-2">İzinler </span></a>
                </li>
                <li class="nav-item">
                    <a href="#avanslar" class="nav-link" data-bs-toggle="tab"><span class="m-2">Avanslar </span></a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="mesai">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h3 class="page-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                    Personel Giriş - Çıkış Listesi <span class="badge bg-primary" style="margin-left:20px">{{ $RaporTarih }}</span>
                                </h3>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="?tarih={{ Carbon\Carbon::parse($HaftaBaslangic)->subWeek()->format('Y-m-d') }}" class="btn btn-warning">Önceki Hafta</a>
                                <a href="?tarih={{ Carbon\Carbon::parse($HaftaBaslangic)->addWeek()->format('Y-m-d') }}" class="btn btn-info">Sonraki Hafta</a>
                                <a href="{{route('mesairaporexcel')}}?tarih={{request()->get('tarih')}}" class="btn btn-primary">Excel'e Aktar</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table  class="table display table-vcenter card-table table-hover table-striped  text-center table-fixed">
                                <colgroup span="1" style="border: 1px solid black"></colgroup>
                                <colgroup span="5" style="border: 1px solid black"></colgroup>
                                <colgroup span="5" style="border: 1px solid black"></colgroup>
                                <colgroup span="5" style="border: 1px solid black"></colgroup>
                                <colgroup span="5" style="border: 1px solid black"></colgroup>
                                <colgroup span="5" style="border: 1px solid black"></colgroup>
                                <colgroup span="5" style="border: 1px solid black"></colgroup>
                                <colgroup span="5" style="border: 1px solid black"></colgroup>
                                <thead>
                                <tr>
                                    <th>Personel ID</th>
                                    @foreach($Period as $gun)
                                        <th colspan="5" class="text-center">{{$gun->translatedFormat('d F Y l')}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody style="font-size: 12px !important;">
                                @foreach($Kullanicilar as $name => $item)
                                    @php($Tarihler = $Period->toArray())
                                    @php($Icerik = collect($item))
                                    <tr>
                                        <td>
                                            <div class="text-muted">
                                                {{ $name }}
                                            </div>
                                        </td>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-start">
                                                @php($Pazartesi = $Icerik->where('gun', $Tarihler[0]))
                                                @if($Pazartesi->count() > 0)
                                                    <span>{{\Carbon\Carbon::parse($Pazartesi->first()->mesai_giris)->format('H:i')}} - </span>
                                                    <span>{{$Pazartesi->first()->gec_mesai}} - </span>
                                                    <span>{{\Carbon\Carbon::parse($Pazartesi->first()->mesai_cikis)->format('H:i')}} - </span>
                                                    <span>{{$Pazartesi->first()->fazla_calisma}}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-start">
                                                @php($Sali = $Icerik->where('gun', $Tarihler[1]))
                                                @if($Sali->count() > 0)
                                                    <span>{{\Carbon\Carbon::parse($Sali->first()->mesai_giris)->format('H:i')}} - </span>
                                                    <span>{{$Sali->first()->gec_mesai}} - </span>
                                                    <span>{{\Carbon\Carbon::parse($Sali->first()->mesai_cikis)->format('H:i')}} - </span>
                                                    <span>{{$Sali->first()->fazla_calisma}}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-start">
                                                @php($Carsamba = $Icerik->where('gun', $Tarihler[2]))
                                                @if($Carsamba->count() > 0)
                                                    <span>{{\Carbon\Carbon::parse($Carsamba->first()->mesai_giris)->format('H:i')}} - </span>
                                                    <span>{{$Carsamba->first()->gec_mesai}} - </span>
                                                    <span>{{\Carbon\Carbon::parse($Carsamba->first()->mesai_cikis)->format('H:i')}} - </span>
                                                    <span>{{$Carsamba->first()->fazla_calisma}}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-start">
                                                @php($Persembe = $Icerik->where('gun', $Tarihler[3]))
                                                @if($Persembe->count() > 0)
                                                    <span>{{\Carbon\Carbon::parse($Persembe->first()->mesai_giris)->format('H:i')}} - </span>
                                                    <span>{{$Persembe->first()->gec_mesai}} - </span>
                                                    <span>{{\Carbon\Carbon::parse($Persembe->first()->mesai_cikis)->format('H:i')}} - </span>
                                                    <span>{{$Persembe->first()->fazla_calisma}}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-start">
                                                @php($Cuma = $Icerik->where('gun', $Tarihler[4]))
                                                @if($Cuma->count() > 0)
                                                    <span>{{\Carbon\Carbon::parse($Cuma->first()->mesai_giris)->format('H:i')}} - </span>
                                                    <span>{{$Cuma->first()->gec_mesai}} - </span>
                                                    <span>{{\Carbon\Carbon::parse($Cuma->first()->mesai_cikis)->format('H:i')}} - </span>
                                                    <span>{{$Cuma->first()->fazla_calisma}}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-start">
                                                @php($Cumartesi = $Icerik->where('gun', $Tarihler[5]))
                                                @if($Cumartesi->count() > 0)
                                                    <span>{{\Carbon\Carbon::parse($Cumartesi->first()->mesai_giris)->format('H:i')}} - </span>
                                                    <span>{{$Cumartesi->first()->gec_mesai}} - </span>
                                                    <span>{{\Carbon\Carbon::parse($Cumartesi->first()->mesai_cikis)->format('H:i')}} - </span>
                                                    <span>{{$Cumartesi->first()->fazla_calisma}}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td colspan="5">
                                            <div class="d-flex justify-content-start">
                                                @php($Pazar = $Icerik->where('gun', $Tarihler[6]))
                                                @if($Pazar->count() > 0)
                                                    <span>{{\Carbon\Carbon::parse($Pazar->first()->mesai_giris)->format('H:i')}} - </span>
                                                    <span>{{$Pazar->first()->gec_mesai}} - </span>
                                                    <span>{{\Carbon\Carbon::parse($Pazar->first()->mesai_cikis)->format('H:i')}} - </span>
                                                    <span>{{$Pazar->first()->fazla_calisma}}</span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="mesaitarih">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h3 class="page-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                    Personel Giriş - Çıkış Listesi
                                </h3>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <select id="mesai_kullanici" class="form-select">
                                            <option value="0">Tüm Kullanıcılar</option>
                                            @foreach(\App\Models\User::all() as $user)
                                                <option value="{{$user->id}}">{{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" id="baslangic_tarihi" class="form-control" value="">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" id="bitis_tarihi" class="form-control" value="">
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-primary btn-block" id="mesaigetir">Getir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter" id="liste">
                                <thead>
                                    <tr>
                                        <th>Personel</th>
                                        <th>Tarih</th>
                                        <th>Mesai Giriş</th>
                                        <th>Geç Giriş</th>
                                        <th>Mesai Çıkış</th>
                                        <th>Fazla Mesai</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="izinler">
                        <div class="row mb-3">
                            <div class="col-3">
                                <input type="text" name="IzinBaslangic" id="IzinBaslangic" class="form-control" value="{{$IzinBaslangic}}">
                            </div>
                            <div class="col-3">
                                <input type="text" name="IzinBitis" id="IzinBitis" class="form-control" value="{{$IzinBitis}}">
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary" id="btnIzinFiltre">Filtrele</button>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#yaklasanlar" class="nav-link active" data-bs-toggle="tab">Yaklaşanlar <span class="badge m-2"> {{count($YaklasanIzinler)}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#onaybekleyen" class="nav-link" data-bs-toggle="tab">Onay Bekleyen <span class="badge m-2"> {{count($OnayBekleyenler)}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#onayverilen" class="nav-link" data-bs-toggle="tab">Onay Verilen <span class="badge m-2"> {{count($Onaylananlar)}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#reddedilenler" class="nav-link" data-bs-toggle="tab">Reddedilenler <span class="badge m-2"> {{count($Reddedilenler)}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#kalanlar" class="nav-link" data-bs-toggle="tab">Kalan İzinler</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="yaklasanlar">

                                <div class="col-12 mt-2">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter table-mobile-md card-table">
                                                <thead>
                                                <tr>
                                                    <th>İsim Soyisim</th>
                                                    <th>İzin Türü</th>
                                                    <th>Gün</th>
                                                    <th>Başlangıç Tarihi</th>
                                                    <th>Bitiş Tarihi</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($YaklasanIzinler as $item)
                                                    <tr>
                                                        <td data-label="Name" >
                                                            <div class="d-flex py-1 align-items-center">
                                                                <a href="#">
                                                                    {!! @$item->user->avatar !!}
                                                                </a>
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">{{$item->user->full_name}}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>{{$item->izin_turu->name}}</div>
                                                        </td>
                                                        <td class="text-muted" >
                                                            {{$item->gun}}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ $item->baslangic->locale('tr')->translatedFormat('d F Y H:i') }}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ $item->bitis->locale('tr')->translatedFormat('d F Y H:i') }}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-toggle="izinDetay" data-id="{{$item->id}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="onaybekleyen">

                                <div class="col-12 mt-2">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter table-mobile-md card-table">
                                                <thead>
                                                <tr>
                                                    <th>İsim Soyisim</th>
                                                    <th>İzin Türü</th>
                                                    <th>Gün</th>
                                                    <th>Başlangıç Tarihi</th>
                                                    <th>Bitiş Tarihi</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($OnayBekleyenler as $item)
                                                    <tr>
                                                        <td data-label="Name" >
                                                            <div class="d-flex py-1 align-items-center">
                                                                <a href="#">
                                                                    {!! $item->user->avatar !!}
                                                                </a>
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">{{$item->user->full_name}}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>{{$item->izin_turu->name}}</div>
                                                        </td>
                                                        <td class="text-muted" >
                                                            {{$item->gun}}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ $item->baslangic->locale('tr')->translatedFormat('d F Y H:i') }}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ $item->bitis->locale('tr')->translatedFormat('d F Y H:i') }}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-toggle="izinDetay" data-id="{{$item->id}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="onayverilen">
                                <div class="col-12 mt-2">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter table-mobile-md card-table">
                                                <thead>
                                                <tr>
                                                    <th>İsim Soyisim</th>
                                                    <th>İzin Türü</th>
                                                    <th>Gün</th>
                                                    <th>Başlangıç Tarihi</th>
                                                    <th>Bitiş Tarihi</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($Onaylananlar as $item)
                                                    <tr>
                                                        <td data-label="Name" >
                                                            <div class="d-flex py-1 align-items-center">
                                                                <a href="#">
                                                                    {!! $item->user->avatar !!}
                                                                </a>
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">{{$item->user->full_name}}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>{{$item->izin_turu->name}}</div>
                                                        </td>
                                                        <td class="text-muted" >
                                                            {{$item->gun}}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ $item->baslangic->locale('tr')->translatedFormat('d F Y H:i') }}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ $item->bitis->locale('tr')->translatedFormat('d F Y H:i') }}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-toggle="izinDetay" data-id="{{$item->id}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="reddedilenler">

                                <div class="col-12 mt-2">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter table-mobile-md card-table">
                                                <thead>
                                                <tr>
                                                    <th>İsim Soyisim</th>
                                                    <th>İzin Türü</th>
                                                    <th>Gün</th>
                                                    <th>Başlangıç Tarihi</th>
                                                    <th>Bitiş Tarihi</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($Reddedilenler as $item)
                                                    <tr>
                                                        <td data-label="Name" >
                                                            <div class="d-flex py-1 align-items-center">
                                                                <a href="#">
                                                                    {!! $item->user->avatar !!}
                                                                </a>
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">{{$item->user->full_name}}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>{{$item->izin_turu->name}}</div>
                                                        </td>
                                                        <td class="text-muted" >
                                                            {{$item->gun}}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ $item->baslangic->locale('tr')->translatedFormat('d F Y H:i') }}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ $item->bitis->locale('tr')->translatedFormat('d F Y H:i') }}
                                                        </td>
                                                        <td>
                                                            <a href="javascript:;" data-toggle="izinDetay" data-id="{{$item->id}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="kalanlar">
                                <div class="col-12 mt-2">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter table-mobile-md card-table">
                                                <thead>
                                                <tr>
                                                    <th>İsim Soyisim</th>
                                                    <th>İzin Hakkı</th>
                                                    <th>Kullanılan İzin</th>
                                                    <th>Kalan İzin Hakkı</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($KalanIzinler as $item)
                                                    <tr>
                                                        <td data-label="Name" >
                                                            <div class="d-flex py-1 align-items-center">
                                                                <a href="#">
                                                                    {!! @$item->avatar !!}
                                                                </a>
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">{{@$item->full_name}}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>{{$item->izin_hakedis}}</div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>{{$item->kullanilan}}</div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>{{$item->kalan_izin}}</div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="avanslar">
                        <ul class="nav nav-tabs" data-bs-toggle="tabs">
                            <li class="nav-item"><a href="#onayBekleyenAvanslar" class="nav-link active" data-bs-toggle="tab">Onay Bekleyenler</a></li>
                            <li class="nav-item"><a href="#onaylananAvanslar" class="nav-link" data-bs-toggle="tab">Onaylananlar</a></li>
                            <li class="nav-item"><a href="#reddedilenAvanslar" class="nav-link" data-bs-toggle="tab">Reddilenler</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="onayBekleyenAvanslar">
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>Personel</th>
                                                <th>Departman</th>
                                                <th>Tutar</th>
                                                <th>Tarih</th>
                                                <th>Durum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(\Modules\IK\Entities\Avans::query()->has('user')->where('durum',0)->get() as $Item)
                                                <tr>
                                                    <td class="d-flex py-1 align-items-center">{!! @$Item->user->avatar !!} {{ @$Item->user->full_name}}</td>
                                                    <td>{{$Item->user->departman()->first()->name}}</td>
                                                    <td>{{$Item->tutar}}</td>
                                                    <td>{{$Item->tarih->locale('tr')->translatedFormat('d F Y')}}</td>
                                                    <td><span class="badge bg-warning">Onay Bekliyor</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="onaylananAvanslar">
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                        <tr>
                                            <th>Personel</th>
                                            <th>Departman</th>
                                            <th>Tutar</th>
                                            <th>Tarih</th>
                                            <th>Durum</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\Modules\IK\Entities\Avans::query()->where('durum',1)->get() as $Item)
                                            <tr>
                                                <td class="d-flex py-1 align-items-center">{!! $Item->user->avatar !!} {{$Item->user->full_name}}</td>
                                                <td>{{$Item->user->departman()->first()->name}}</td>
                                                <td>{{$Item->tutar}}</td>
                                                <td>{{$Item->tarih->locale('tr')->translatedFormat('d F Y')}}</td>
                                                <td><span class="badge bg-success">Onaylandı</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="reddedilenAvanslar">
                                <div class="table-responsive">
                                    <table class="table table-vcenter">
                                        <thead>
                                        <tr>
                                            <th>Personel</th>
                                            <th>Departman</th>
                                            <th>Tutar</th>
                                            <th>Tarih</th>
                                            <th>Durum</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\Modules\IK\Entities\Avans::query()->where('durum',-1)->get() as $Item)
                                            <tr>
                                                <td class="d-flex py-1 align-items-center">{!! $Item->user->avatar !!} {{$Item->user->full_name}}</td>
                                                <td>{{$Item->user->departman()->first()->name}}</td>
                                                <td>{{$Item->tutar}}</td>
                                                <td>{{$Item->tarih->locale('tr')->translatedFormat('d F Y')}}</td>
                                                <td><span class="badge bg-danger">Reddedildi</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJS')
<script>
    new Litepicker({
        element: document.getElementById('baslangic_tarihi'),
        elementEnd: document.getElementById('bitis_tarihi'),
        singleMode: false,
        allowRepick: true,
        format: 'DD.MM.YYYY',
        lang: 'tr-TR'
    });
    new Litepicker({
        element: document.getElementById('IzinBaslangic'),
        elementEnd: document.getElementById('IzinBitis'),
        singleMode: false,
        allowRepick: true,
        format: 'DD.MM.YYYY',
        lang: 'tr-TR'
    });
    $(document).on('click', 'button#mesaigetir', function (){
        var baslangic = $('#baslangic_tarihi').val(),
            bitis = $('#bitis_tarihi').val(),
            kullanici = $('#mesai_kullanici').val();
        $.ajax({
            type: 'GET',
            url: "{{route('IK.raporlar.mesaitariharaligi')}}",
            data: 'page=1&baslangic=' + baslangic + '&bitis=' + bitis + '&kullanici=' + kullanici,
            success: function (result){
                moment.locale('tr');
                var table = $('#mesaitarih table#liste tbody');
                table.html('');
                $.each(result.Liste, function (i,v){
                    table.append(
                        '<tr>' +
                            '<td>'+v.user.name + ' ' + v.user.last_name +'</td>' +
                            '<td>'+ moment(v.gun).utc().format('DD.MM.YYYY') +'</td>' +
                            '<td>'+ moment(v.mesai_giris).utc().format('LT') +'</td>' +
                            '<td>'+ v.gec_mesai +' dk.</td>' +
                            '<td>'+ moment(v.mesai_cikis).utc().format('LT') +'</td>' +
                            '<td>'+ v.fazla_calisma +' dk.</td>' +
                        '</tr>'
                    );
                })
            }
        })
    });
    $(document).on('click', '#btnIzinFiltre', function(){
        document.location = '?IzinBaslangic=' + $('#IzinBaslangic').val() + '&IzinBitis=' + $('#IzinBitis').val() + '#izinler';
    })
</script>
@endsection
@section('css')

@endsection
