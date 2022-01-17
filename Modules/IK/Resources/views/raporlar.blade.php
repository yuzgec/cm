@extends('master')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <ul class="nav nav-tabs" data-bs-toggle="tabs" id="tab">
                <li class="nav-item">
                    <a href="#mesai" class="nav-link active" data-bs-toggle="tab"><span class="m-2">Mesai</span></a>
                </li>
                <li class="nav-item">
                    <a href="#izinler" class="nav-link " data-bs-toggle="tab"><span class="m-2">İzinler </span></a>
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
                                <a href="{{route('mesairaporexcel')}}" class="btn btn-primary">Excel'e Aktar</a>
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
                                    @foreach($Gunler as $gun)
                                        <th colspan="5" class="text-center">{{$gun}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody style="font-size: 12px !important;">
                                @foreach($Personeller as $item)
                                    <tr>
                                        <td>
                                            <div class="text-muted">
                                                {{ $item[0]->user->full_name }}
                                            </div>
                                        </td>
                                        <td class="text-center yazi">
                                            <th>{{$item[0]->fazla_calisma}}</th>
                                            <th>{{$item[0]->gec_mesai}}</th>
                                            <th>{{substr($item[0]->mesai_giris, -8)}}</th>
                                            <th>{{substr($item[0]->mesai_cikis, -8)}}</th>
                                        </td>
                                        <td class="text-center yazi">
                                        <th>{{@$item[1]->fazla_calisma}}</th>
                                        <th>{{@$item[1]->gec_mesai}}</th>
                                        <th>{{substr(@$item[1]->mesai_giris, -8)}}</th>
                                        <th>{{substr(@$item[1]->mesai_cikis, -8)}}</th>
                                        </td>
                                        <td class="text-center yazi">
                                        <th>{{@$item[2]->fazla_calisma}}</th>
                                        <th>{{@$item[2]->gec_mesai}}</th>
                                        <th>{{substr(@$item[2]->mesai_giris, -8)}}</th>
                                        <th>{{substr(@$item[2]->mesai_cikis, -8)}}</th>
                                        </td>
                                        <td class="text-center yazi">
                                        <th>{{@$item[3]->fazla_calisma}}</th>
                                        <th>{{@$item[3]->gec_mesai}}</th>
                                        <th>{{substr(@$item[3]->mesai_giris, -8)}}</th>
                                        <th>{{substr(@$item[3]->mesai_cikis, -8)}}</th>
                                        </td>
                                        <td class="text-center yazi">
                                        <th>{{@$item[4]->fazla_calisma}}</th>
                                        <th>{{@$item[4]->gec_mesai}}</th>
                                        <th>{{substr(@$item[4]->mesai_giris, -8)}}</th>
                                        <th>{{substr(@$item[4]->mesai_cikis, -8)}}</th>
                                        </td>
                                        <td class="text-center yazi">
                                        <th>{{@$item[5]->fazla_calisma}}</th>
                                        <th>{{@$item[5]->gec_mesai}}</th>
                                        <th>{{substr(@$item[5]->mesai_giris, -8)}}</th>
                                        <th>{{substr(@$item[5]->mesai_cikis, -8)}}</th>
                                        </td>
                                        <td class="text-center yazi">
                                        <th>{{@$item[6]->fazla_calisma}}</th>
                                        <th>{{@$item[6]->gec_mesai}}</th>
                                        <th>{{substr(@$item[6]->mesai_giris, -8)}}</th>
                                        <th>{{substr(@$item[6]->mesai_cikis, -8)}}</th>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="izinler">
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
                                                                    {!! $item->user->avatar !!}
                                                                </a>
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">{{$item->user->full_name}}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>{{$item->izin_turu}}</div>
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
                                                            <div>{{$item->izin_turu}}</div>
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
                                                            <div>{{$item->izin_turu}}</div>
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
                                                            <div>{{$item->izin_turu}}</div>
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
        </div>
    </div>
@endsection
@section('js')

@endsection
@section('css')

@endsection
