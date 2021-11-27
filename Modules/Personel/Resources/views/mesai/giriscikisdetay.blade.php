@extends('master')
@section('title', $Personel->adsoyad.' | Personel Detay')
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="cart-title">
                    <div class="d-flex justify-content-between">
                        <div>
                            {{ $Personel->adsoyad.' - ' .$Personel->remote_id }}<br />
        {{--                    Fazla Mesai : {{$ToplamArti}} Dk. <br />--}}
        {{--                    Eksi Mesai : {{$ToplamEksi}}--}}
                        </div>
                        <div>
                            <label><small>Puantaj Periyod</small></label>
                            <select class="form-select" name="ay" id="ay" onchange="changeDate()">
                                @foreach($Aylar as $ay)
                                    <option value="{{$ay["id"]}}" {{($ay["id"] == request()->get('ay')) ? 'selected=""':''}}>{{$ay["label"]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                                @foreach ($Kayitlar as $item)
                                    <tr>
                                        <td><div class="text-muted">{{\Carbon\Carbon::parse($item->gun)->locale('tr')->translatedFormat('d F Y l')}}</div></td>
                                        <td><div class="text-muted">{{$item->mesai_giris->format('H:i')}}</div></td>
                                        <td><div class="text-muted">{{($item->gec_mesai > 0)?$item->gec_mesai." dk.":"-"}}</div></td>
                                        <td><div class="text-muted">{{$item->mesai_cikis->format('H:i')}}</div></td>
                                        <td><div class="text-muted">{{($item->fazla_calisma>0)?$item->fazla_calisma." dk":"-"}}</div></td>
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
@section('customJS')
    <script>
        function changeDate(){
            val = document.getElementById('ay').value;
            document.location = "?ay=" + val;
        }
    </script>
@endsection
