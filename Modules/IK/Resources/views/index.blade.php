@extends('master')
@section('title', 'İnsan Kaynakları Yönetim Paneli | '.config('app.name'))
@section('content')


    {{-- İzin Talepleri   --}}
    <div class="col-4">

        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" /></svg>
                    İzin Talepleri
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($personel->slice(0,4) as $item)
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-auto"><span class="badge bg-success"></span></div>
                        <div class="col-auto">
                            <a href="#">
                               <span class="avatar me-2" style="background-image: url({{'/images/personel/50/'.$item->foto}})">
                                    {{ ($item->foto == "") ? isim($item->adsoyad) : null }}
                                </span>
                            </a>
                        </div>
                        <div class="col d-flex justify-content-between">
                            <a href="#" class="text-body  birsatir" title="{{ $item->adsoyad }}">{{ $item->adsoyad }}</a>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><circle cx="18" cy="18" r="4" /><path d="M15 3v4" /><path d="M7 3v4" /><path d="M3 11h16" /><path d="M18 16.496v1.504l1 1" /></svg>
                    Yaklaşan İzinler
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($personel->slice(5,8) as $item)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto"><span class="badge bg-success"></span></div>
                            <div class="col-auto">
                                <a href="#">
                                    <span class="avatar me-2" style="background-image: url({{'/images/personel/50/'.$item->foto}})">
                                        {{ ($item->foto == "") ? isim($item->adsoyad) : null }}
                                    </span>
                                </a>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <a href="#" class="text-body  birsatir" title="{{ $item->adsoyad }}">{{ $item->adsoyad }}</a>
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
                    Mesai Talepleri
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($personel->slice(5,6) as $item)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto"><span class="badge bg-success"></span></div>
                            <div class="col-auto">
                                <a href="#">
                                    <span class="avatar me-2" style="background-image: url({{'/images/personel/50/'.$item->foto}})">
                                        {{ ($item->foto == "") ? isim($item->adsoyad) : null }}
                                    </span>
                                </a>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <a href="#" class="text-body  birsatir" title="{{ $item->adsoyad }}">{{ $item->adsoyad }}</a>
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
                        Ödeme Talepleri
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
                    <p>Yılbaşı</p>
                    <p>01.01.2022</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Yılbaşı</p>
                    <p>01.01.2022</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Yılbaşı</p>
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
                        Çalışan Dağılımı
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
                    height: 240,
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
                series: [44, 55, 12, 2],
                labels: ["Direct", "Affilliate", "E-mail", "Other"],
                grid: {
                    strokeDashArray: 4,
                },
                colors: ["#206bc4", "#79a6dc", "#d2e1f3", "#e9ecf1"],
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
