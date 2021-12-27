@extends('master')
@section('title', 'İzin Yönetimi | '.config('app.name'))
@section('content')



    <div class="col-md-12">
        <div class="card">
            <ul class="nav nav-tabs" data-bs-toggle="tabs">
                <li class="nav-item">
                    <a href="#izinler" class="nav-link active" data-bs-toggle="tab"><span class="m-2">İzinler </span></a>
                </li>
                <li class="nav-item">
                    <a href="#raporlar" class="nav-link" data-bs-toggle="tab"><span class="m-2">Raporlar</span></a>
                </li>
                <li class="nav-item">
                    <a href="#kurallar" class="nav-link" data-bs-toggle="tab"><span class="m-2">Kurallar</span></a>
                </li>
                <li class="nav-item">
                    <a href="#onay-surecleri" class="nav-link" data-bs-toggle="tab"><span class="m-2">Onay Süreçleri</span></a>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="izinler">

                        <ul class="nav nav-tabs" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#yaklasanlar" class="nav-link active" data-bs-toggle="tab">Yaklaşanlar <span class="badge m-2"> 4</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#onaybekleyen" class="nav-link" data-bs-toggle="tab">Onay Bekleyen <span class="badge m-2"> 4</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#onayverilen" class="nav-link" data-bs-toggle="tab">Onay Verilen <span class="badge m-2"> 4</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#reddedilenler" class="nav-link" data-bs-toggle="tab">Reddedilenler <span class="badge m-2"> 4</span></a>
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
                                                    <td class="text-muted" data-label="Role" >
                                                        4
                                                    </td>

                                                    <td class="text-muted" data-label="Role" >
                                                        {{ \Carbon\Carbon::today() }}
                                                    </td>

                                                    <td class="text-muted" data-label="Role" >
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
                                                        <td class="text-muted" data-label="Role" >
                                                            4
                                                        </td>

                                                        <td class="text-muted" data-label="Role" >
                                                            {{ \Carbon\Carbon::today() }}
                                                        </td>

                                                        <td class="text-muted" data-label="Role" >
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
                                                        <td class="text-muted" data-label="Role" >
                                                            4
                                                        </td>

                                                        <td class="text-muted" data-label="Role" >
                                                            {{ \Carbon\Carbon::today() }}
                                                        </td>

                                                        <td class="text-muted" data-label="Role" >
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
                                                        <td class="text-muted" data-label="Role" >
                                                            4
                                                        </td>

                                                        <td class="text-muted" data-label="Role" >
                                                            {{ \Carbon\Carbon::today() }}
                                                        </td>

                                                        <td class="text-muted" data-label="Role" >
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

                    <div class="tab-pane" id="raporlar">
                        <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
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
