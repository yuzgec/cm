@extends('master')
@section('title', 'İnsan Kaynakları Yönetim Paneli | '.config('app.name'))
@section('content')
    {{-- İzin Talepleri   --}}
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" /></svg>
                    İzin Talepleri (4)
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($Personel->slice(0,4) as $item)
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="{{ route('personel.edit', $item->id) }}" title="{{ $item->adsoyad }}">

                               <span class="avatar me-2"
                                     title="{{$item->adsoyad}}"
                                     style="color:white;
                                         background: {{ $item->mesai->mesai_renk }} linear-gradient(135deg,hsla(0,0%,20%,.4),{{ $item->mesai->mesai_renk }});
                                         background-image: url({{$item->getFirstMediaUrl() }});
                                         background-size: cover;
                                         border: 2px solid  {{$item->mesai->mesai_renk}};
                                        ">
                                     {{ (!$item->getFirstMediaUrl()) ? isim($item->adsoyad) : null }}
                                </span>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-between">
                            <a href="{{ route('personel.edit', $item->id) }}" class="text-body  birsatir" title="{{ $item->adsoyad }}">{{ $item->adsoyad }}</a>
                            <div class="text-body birsatir badge">10.02.2022</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Yaklaşan İzinler  --}}
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg>                    Yaklaşan İzinler (4)
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($Personel->slice(0,5) as $item)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('personel.edit', $item->id) }}" title="{{ $item->adsoyad }}">

                               <span class="avatar me-2"
                                     title="{{$item->adsoyad}}"
                                     style="color:white;
                                         background: {{ $item->mesai->mesai_renk }} linear-gradient(135deg,hsla(0,0%,20%,.4),{{ $item->mesai->mesai_renk }});
                                         background-image: url({{$item->getFirstMediaUrl() }});
                                         background-size: cover;
                                         border: 2px solid  {{$item->mesai->mesai_renk}};
                                         ">
                                     {{ (!$item->getFirstMediaUrl()) ? isim($item->adsoyad) : null }}
                                </span>
                                </a>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <a href="{{ route('personel.edit', $item->id) }}" class="text-body  birsatir" title="{{ $item->adsoyad }}">{{ $item->adsoyad }}</a>
                                <div class="text-body birsatir badge">10.02.2022</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Yaklaşan Doğum Günleri --}}
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="8" width="18" height="4" rx="1" /><line x1="12" y1="8" x2="12" y2="21" /><path d="M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7" /><path d="M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5" /></svg>                    Yaklaşan Doğum Günleri (8)
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($Personel->slice(0,8) as $item)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('personel.edit', $item->id) }}" title="{{ $item->adsoyad }}">

                               <span class="avatar me-2"
                                     title="{{$item->adsoyad}}"
                                     style="color:white;
                                         background: {{ $item->mesai->mesai_renk }} linear-gradient(135deg,hsla(0,0%,20%,.4),{{ $item->mesai->mesai_renk }});
                                         background-image: url({{$item->getFirstMediaUrl() }});
                                         background-size: cover;
                                         border: 2px solid  {{$item->mesai->mesai_renk}};
                                         ">
                                     {{ (!$item->getFirstMediaUrl()) ? isim($item->adsoyad) : null }}
                                </span>
                                </a>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <a href="{{ route('personel.edit', $item->id) }}" class="text-body  birsatir" title="{{ $item->adsoyad }}">{{ $item->adsoyad }}</a>
                                <div class="text-body birsatir badge">10.02.2022</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Mesai Talepleri  --}}
    <div class="col-4">

        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><circle cx="18" cy="18" r="4" /><path d="M15 3v4" /><path d="M7 3v4" /><path d="M3 11h16" /><path d="M18 16.496v1.504l1 1" /></svg>
                    Mesai Talepleri  (4)
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($Personel->slice(0,4) as $item)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('personel.edit', $item->id) }}" title="{{ $item->adsoyad }}">

                               <span class="avatar me-2"
                                     title="{{$item->adsoyad}}"
                                     style="color:white;
                                         background: {{ $item->mesai->mesai_renk }} linear-gradient(135deg,hsla(0,0%,20%,.4),{{ $item->mesai->mesai_renk }});
                                         background-image: url({{$item->getFirstMediaUrl() }});
                                         background-size: cover;
                                         border: 2px solid  {{$item->mesai->mesai_renk}};
                                         ">
                                     {{ (!$item->getFirstMediaUrl()) ? isim($item->adsoyad) : null }}
                                </span>
                                </a>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <a href="{{ route('personel.edit', $item->id) }}" class="text-body  birsatir" title="{{ $item->adsoyad }}">{{ $item->adsoyad }}</a>
                                <div class="text-body birsatir badge">10.02.2022</div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{-- Ödeme Talepleri  --}}
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" /><path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" /></svg>
                        Ödeme Talepleri (0)
                    </h3>
                </div>
                <div class="d-flex">
                    <p>Onayınızı bekleyen ödeme talebi yok</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Resmi Tatiller  --}}
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 12a8 8 0 0 1 16 0z" /><path d="M12 12v6a2 2 0 0 0 4 0" /></svg>
                        Resmi Tatiller
                    </h3>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Yılbaşı</p>
                    <p>01.01.2022</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="birsatir">23 Nisan Egemenlik ve Çocuk Bayramı</p>
                    <p>23.04.2022</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="birsatir"> Atatürk'ü Anma ve Gençlik ve Spor Bayramı </p>
                    <p>01.01.2022</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Ramazan Bayramı</p>
                    <p>01.01.2022</p>
                </div>
            </div>
        </div>
    </div>
    {{-- Çalışan Dağılımı   --}}
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="7" cy="7" r="4" /><path d="M7 3v4h4" /><line x1="9" y1="17" x2="9" y2="21" /><line x1="17" y1="14" x2="17" y2="21" /><line x1="13" y1="13" x2="13" y2="21" /><line x1="21" y1="12" x2="21" y2="21" /></svg>
                        Çalışan Dağılımı ({{ $Personel->count() }})
                    </h3>
                    <div class="ms-auto">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Şirket</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#">Şirket</a>
                                <a class="dropdown-item" href="#">Şube</a>
                                <a class="dropdown-item" href="#">Depertman</a>
                                <a class="dropdown-item" href="#">Ünvan</a>
                                <a class="dropdown-item" href="#">Yaş</a>
                                <a class="dropdown-item" href="#">Cinsiyet</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="chart-demo-pie"></div>
            </div>
        </div>
    </div>
@endsection
@section('customJS')
    <script src="/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
                chart: {
                    type: "donut",
                    fontFamily: 'inherit',
                    height: 400,
                    sparkline: {
                        enabled: true
                    },
                    animations: {
                        enabled: false
                    },
                },
                fill: {
                    opacity: 1,
                },
                series: [44, 55, 12, 2, 12, 6],
                labels: ['Hukuk', 'İdari İşler', 'İcra', 'Değer Kaybı', 'Dış Görev', 'Muhasebe', 'Bedeni Hasar'],
                grid: {
                    strokeDashArray: 4,
                },
                colors: ["#e6de00", '#00670a', "#0018ff", "#ff0000",'#999', '#e400ff', '#ff6000' ],
                legend: {
                    show: true,
                    position: 'bottom',
                    offsetY: 12,
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 100,
                    },
                    itemMargin: {
                        horizontal: 8,
                        vertical: 8
                    },
                },
                tooltip: {
                    fillSeriesColor: false
                },
            })).render();
        });
        // @formatter:on
    </script>
@endsection
