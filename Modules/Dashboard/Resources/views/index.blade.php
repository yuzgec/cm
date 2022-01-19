@extends('master')
@section('content')

    {{-- Ödeme --}}
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Ödeme</div>
                    <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Bugün</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#">Bugün</a>
                                <a class="dropdown-item" href="#">Dün</a>
                                <a class="dropdown-item" href="#">Son 1 Hafta</a>
                                <a class="dropdown-item" href="#">Son 1 Ay</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h1 mb-3">{{$GunlukToplam}} ₺</div>

                <div class="progress progress-sm">
                    <div class="progress-bar bg-blue"
                         style="width: 100%"
                         role="progressbar"
                         aria-valuenow="100"
                         aria-valuemin="0"
                         aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Çağrı Durumu --}}
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Çağrı Durumu</div>
                    <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Bugün</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#">Bugün</a>
                                <a class="dropdown-item" href="#">Dün</a>
                                <a class="dropdown-item" href="#">Son 1 Hafta</a>
                                <a class="dropdown-item" href="#">Son 1 Ay</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h1 mb-3">0 Arama</div>

                <div class="progress progress-sm">
                    <div class="progress-bar bg-blue"
                         style="width: 100%"
                         role="progressbar"
                         aria-valuenow="100"
                         aria-valuemin="0"
                         aria-valuemax="100">
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Dosya Sayısı --}}
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Dosya Sayısı</div>
                    <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Bugün</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#">Bugün</a>
                                <a class="dropdown-item" href="#">Dün</a>
                                <a class="dropdown-item" href="#">Son 1 Hafta</a>
                                <a class="dropdown-item" href="#">Son 1 Ay</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h1 mb-3">0 Dosya</div>

                <div class="progress progress-sm">
                    <div class="progress-bar bg-blue"
                         style="width: 100%"
                         role="progressbar"
                         aria-valuenow="100"
                         aria-valuemin="0"
                         aria-valuemax="100">
                    </div>
                </div>

            </div>
        </div>
    </div>
    @can('IK Yönetim')
    {{-- İzin Talepleri --}}
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" /></svg>
                    İzin Talepleri ({{count($Izinler)}})
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($Izinler as $Izin)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('IK.edit', $Izin->user->id) }}" title="{{ $Izin->user->full_name }}">
                                    {!! $Izin->user->avatar !!}
                                </a>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <a href="{{ route('IK.edit', $Izin->user->id) }}" class="text-body  birsatir" title="{{ $Izin->user->full_name }}">{{ $Izin->user->full_name }}</a>
                                <div class="text-body birsatir badge">{{$Izin->baslangic->locale('tr')->translatedFormat('d F Y H:i')}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Avans Talepleri --}}
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><circle cx="18" cy="18" r="4" /><path d="M15 3v4" /><path d="M7 3v4" /><path d="M3 11h16" /><path d="M18 16.496v1.504l1 1" /></svg>
                    Avans Talepleri  ({{count($Avanslar)}})
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($Avanslar as $item)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="javascript:;" title="{{ $item->user->full_name }}" data-toggle="avansDetay" data-id="{{$item->id}}">
                                    {!! $item->user->avatar !!}
                                </a>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <a href="javascript:;" data-toggle="avansDetay" data-id="{{$item->id}}" class="text-body  birsatir" title="{{ $item->user->full_name }}">{{ $item->user->full_name }}</a>
                                <div class="text-body birsatir badge">{{$item->tarih->locale('tr')->translatedFormat('d F Y')}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    @endcan
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <div>
                    <h3 class="card-title">Son Alınan Ödemeler</h3>
                </div>
                <div>
                    {{ $OdemeListesi->appends(['listele' => 'odeme'])->links() }}
                </div>


            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th class="w-1">Dosya No.
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <polyline points="6 15 12 9 18 15"/>
                            </svg>
                        </th>
                        <th>Ad Soyad</th>
                        <th>Ödeme Tutarı</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($OdemeListesi as $item)
                        <tr>
                            <td><span class="text-muted">{{ $item->dosya_no }}</span></td>
                            <td><a href="{{route('dashboard.index')}}" class="text-reset"
                                   tabindex="-1">{{ $item->ad_soyad }}</a></td>
                            <td>
                                {{ $item->odeme_tutari }}
                            </td>

                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                <span
                                    class="badge bg-{{ ($item->odeme_cevap == 1 ) ? 'success' : 'danger' }} me-1"></span> {{ ($item->odeme_cevap == 1 ) ? 'Başarılı' : 'Başarısız' }}
                            </td>
                            <td class="text-end">
                                <button class="btn align-text-top">Görüntüle</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
