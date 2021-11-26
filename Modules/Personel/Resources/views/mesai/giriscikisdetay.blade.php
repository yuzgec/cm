@extends('master')
@section('title', $Personel->adsoyad.' | Personel Detay')
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="cart-title">
                    {{ $Personel->adsoyad.' - ' .$Personel->remote_id }}<br />
                    Fazla Mesai : {{$ToplamArti}} Dk. <br />
                    Eksi Mesai : {{$ToplamEksi}}
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Tarih</th>
                                        <th>Mesai Giriş</th>
                                        <th>Geç Giriş</th>
                                        <th>Mesai Çıkış</th>
                                        <th>Fazla Mesai</th>
                                        <th></th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($Gunler as $item)
                                    <tr>
                                        <td><div class="text-muted">{{\Carbon\Carbon::parse($item["Tarih"])->locale('tr_TR')->format('d F Y')}}</div></td>
                                        <td><div class="text-muted">{{$item["IseGirisSaati"]}}</div></td>
                                        <td><div class="text-muted">{{$item["GirisFark"]}}</div></td>
                                        <td><div class="text-muted">{{$item["CikisSaati"]}}</div></td>
                                        <td><div class="text-muted">{{$item["CikisFark"]}}</div></td>
                                    </tr>
                                </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
