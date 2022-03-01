@extends('master')
@section('title', 'İzin Yönetimi | '.config('app.name'))
@section('customJS')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script>
        $(document).ready(function(){
            $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            console.log(activeTab);
            if(activeTab){
                $('#tab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <ul class="nav nav-tabs" data-bs-toggle="tabs" id="tab">
                <li class="nav-item">
                    <a href="#izinler" class="nav-link active" data-bs-toggle="tab"><span class="m-2">İzinler </span></a>
                </li>
                <li class="nav-item">
                    <a href="#raporlar" class="nav-link" data-bs-toggle="tab"><span class="m-2">Raporlar</span></a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="izinler">
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

                    <div class="tab-pane" id="raporlar">
                        <ul class="nav nav-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#kalanizinler" class="nav-link active" data-bs-toggle="tab">Kalan İzinler <span class="badge m-2"> 4</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#aylikizinraporu" class="nav-link" data-bs-toggle="tab">Aylık İzin raporu<span class="badge m-2"> 4</span></a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active show" id="kalanizinler">

                                <div class="col-12 mt-2">
                                    <div class="card">
                                        <div class="table-responsive">
                                            <table class="table table-vcenter table-mobile-md card-table">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>İsim Soyad</th>
                                                    <th>Kimlik Numarası</th>
                                                    <th>Şirket</th>
                                                    <th>Depertman</th>
                                                    <th>Ünvan</th>
                                                    <th>İşe Giriş</th>
                                                    <th>Extra İzin Günleri</th>
                                                    <th>Devir Kayıpları</th>
                                                    <th>Toplam Hah Edilen</th>
                                                    <th>Kullanılan</th>
                                                    <th>Kalan</th>
                                                    <th>Çalışma Durumu</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($Personel->slice(1) as $item)
                                                    <tr>
                                                        <td data-label="Title" >
                                                            <div>{{$item->id}}</div>
                                                        </td>
                                                        <td data-label="Name" >
                                                            <div class="d-flex py-1 align-items-center">
                                                                <a href="#">
                                                            <span class="avatar me-2" style="background-image: url({{'/images/personel/50/'.$item->foto}})">
                                                                {{ ($item->foto == "") ? isim($item->adsoyad) : null }}
                                                            </span>
                                                                </a>
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">{{$item->adsoyad}}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>Yıllık İzin</div>
                                                        </td>
                                                        <td class="text-muted" >
                                                            4
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ \Carbon\Carbon::today() }}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ \Carbon\Carbon::yesterday() }}
                                                        </td>

                                                        <td class="text-muted" >
                                                            İçerik
                                                        </td>

                                                        <td class="text-muted" >
                                                            İçerik
                                                        </td>


                                                        <td class="text-muted" >
                                                            İçerik
                                                        </td>


                                                        <td class="text-muted" >
                                                            İçerik
                                                        </td>


                                                        <td class="text-muted" >
                                                            İçerik
                                                        </td>


                                                        <td class="text-muted" >
                                                            İçerik
                                                        </td>

                                                        <td class="text-muted" >
                                                            <span class="badge bg-success">Aktif Çalışan </span>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="aylikizinraporu">

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

                                                @foreach($Personel->slice(1) as $item)
                                                    <tr>
                                                        <td data-label="Name" >
                                                            <div class="d-flex py-1 align-items-center">
                                                                <a href="#">
                                                            <span class="avatar me-2" style="background-image: url({{'/images/personel/50/'.$item->foto}})">
                                                                {{ ($item->foto == "") ? isim($item->adsoyad) : null }}
                                                            </span>
                                                                </a>
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">{{$item->adsoyad}}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="Title" >
                                                            <div>Yıllık İzin</div>
                                                        </td>
                                                        <td class="text-muted" >
                                                            4
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ \Carbon\Carbon::today() }}
                                                        </td>

                                                        <td class="text-muted" >
                                                            {{ \Carbon\Carbon::yesterday() }}
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

                    <div class="tab-pane" id="kurallar">
                        <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
                    </div>

                    <div class="tab-pane" id="onay-surecleri">
                        <div>onay-surecleriFringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
