@extends('master')
@section('title', 'İnsan Kaynakları Yönetim Paneli | '.config('app.name'))
@section('content')
    {{-- İzin Talepleri   --}}


    {{-- Yaklaşan İzinler  --}}
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg>
                    Yaklaşan İzinler (0)
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">

            </div>
        </div>
    </div>
    {{-- Yaklaşan Doğum Günleri --}}
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="8" width="18" height="4" rx="1" /><line x1="12" y1="8" x2="12" y2="21" /><path d="M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7" /><path d="M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5" /></svg>
                    Yaklaşan Doğum Günleri (0)
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">

            </div>
        </div>
    </div>
    {{-- Avans Talepleri  --}}

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
@endsection
@section('customJS')
    <script src="/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
    <script>
        // @formatter:off
        // document.addEventListener("DOMContentLoaded", function () {
        //     window.ApexCharts && (new ApexCharts(document.getElementById('chart-demo-pie'), {
        //         chart: {
        //             type: "donut",
        //             fontFamily: 'inherit',
        //             height: 400,
        //             sparkline: {
        //                 enabled: true
        //             },
        //             animations: {
        //                 enabled: false
        //             },
        //         },
        //         fill: {
        //             opacity: 1,
        //         },
        //         series: [44, 55, 12, 2, 12, 6],
        //         labels: ['Hukuk', 'İdari İşler', 'İcra', 'Değer Kaybı', 'Dış Görev', 'Muhasebe', 'Bedeni Hasar'],
        //         grid: {
        //             strokeDashArray: 4,
        //         },
        //         colors: ["#e6de00", '#00670a', "#0018ff", "#ff0000",'#999', '#e400ff', '#ff6000' ],
        //         legend: {
        //             show: true,
        //             position: 'bottom',
        //             offsetY: 12,
        //             markers: {
        //                 width: 10,
        //                 height: 10,
        //                 radius: 100,
        //             },
        //             itemMargin: {
        //                 horizontal: 8,
        //                 vertical: 8
        //             },
        //         },
        //         tooltip: {
        //             fillSeriesColor: false
        //         },
        //     })).render();
        // });
        // @formatter:on
    </script>
@endsection
