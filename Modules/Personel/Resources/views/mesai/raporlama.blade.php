@extends('master')
@section('title', 'Personel Mesai Raporlama | '.config('app.name'))

@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="page-header ">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                Personel Giriş - Çıkış Listesi <span class="badge" style="margin-left:20px">{{ $RaporTarih }}</span>
                            </h3>
                        </div>

                        <div class="col-2" >
                           {{-- <div class="d-flex justify-content-between" style="float: right;">
                                <div class="col-12 p-1">
                                    <label><small>Puantaj Periyod</small></label>
                                    <select class="form-select" name="ay" id="ay" onchange="changeDate()">
                                        @foreach($Aylar as $ay)
                                            <option value="{{$ay["id"]}}" {{($ay["id"] == request()->get('ay')) ? 'selected=""':''}}>{{$ay["label"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>--}}
                        </div>
                        <div class="col-4" style="text-align: right">
                            <a href="{{route('mesairaporexcel')}}" class="btn btn-primary">Excel'e Aktar</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                <tr>
                                    <th>Personel ID</th>
                                    <th>Personel Adı</th>
                                    <th>Tarih</th>
                                    <th class="text-center">Eksik Çalışma (Dakika)</th>
                                    <th class="text-center">Fazla Mesai (Dakika)</th>
                                    <th></th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($MesaiRapor as $item)
                                    <tr>
                                        <td>
                                            <div class="text-muted">
                                                {{ $item->getUser->remote_id }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                                    {{ $item->getUser->adsoyad }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                                {{ substr($item->gun, 0 , 10) }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-muted">
                                                @if($item->gec_mesai > 0)
                                                <span class="badge bg-danger">{{ $item->gec_mesai }} dk.</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-muted">
                                                @if($item->fazla_calisma > 0)
                                                <span class="badge bg-success">{{ $item->fazla_calisma }} dk.</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                            @endforeach
                        </div>

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
