@extends('master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Mesailerim</h2>
            <div>
                <div class="table-responsive">
                    <table class="table table-vcenter">
                        <thead>
                        <tr>
                            <th>TARİH</th>
                            <th>MESAİ GİRİŞ</th>
                            <th>GEÇ GİRİŞ</th>
                            <th>MESAİ ÇIKIŞ</th>
                            <th>FAZLA MESAİ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Kayitlar as $Row)
                            <tr>
                                <td>{{$Row->gun->locale('tr')->translatedFormat('d F Y, l')}}</td>
                                <td>{{$Row->mesai_giris->format('H:i')}}</td>
                                <td>{{$Row->gec_mesai}} dk.</td>
                                <td>{{$Row->mesai_cikis->format('H:i')}}</td>
                                <td>{{$Row->fazla_calisma}} dk.</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            {{\Carbon\Carbon::parse($MesaiAy)->locale('tr')->translatedFormat('F Y')}} için Toplam Fazla Mesai <span class="text-success">{{$FazlaMesai}}</span> dk. Toplam geç giriş <span class="text-danger">{{$ToplamEksi}}</span> dk.
                        </div>
                        <div>
                            <select class="form-select" onchange="changeDate()" id="ay">
                                @foreach($Aylar as $Ay)
                                    <option value="{{$Ay["id"]}}" {{(request()->get('ay') == $Ay["id"])?'selected':''}}>{{$Ay["label"]}}</option>
                                @endforeach
                            </select>
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
        document.location = "?ay=" + val + '#mesai';
    }
</script>
@endsection
@section('css')

@endsection
