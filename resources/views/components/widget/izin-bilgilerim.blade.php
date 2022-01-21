<div class="col-4">
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" /></svg>
                İzin Bilgilerim
            </h3>
            <div class="d-flex justify-content-between">
                <div>
                    <p>Kalan</p>
                    <h2 class="text-blue">{{$Kalan}} Gün</h2>
                </div>
                <div class="d-flex flex-column align-items-end">
                    <p>Kullanılan</p>
                    <h2 class="text-muted">{{$Kullanilan}} Gün</h2>
                </div>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-blue"
                     style="width: {{$Yuzde}}%"
                     role="progressbar"
                     aria-valuemin="0"
                     aria-valuemax="100">
                </div>
            </div>
            <div class="mt-3">
                <h5>Son kullanılan izinler:</h5>
                <div class="d-flex flex-column gap-0">
                    @foreach($Izinler as $row)
                    <div class="d-flex justify-content-start w-full gap-2">
                        @switch($row->durum)
                            @case(1)
                                <span class="text-green">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M9 12l2 2l4 -4" /></svg>
                                </span>
                            @break
                            @case(0)
                                <span class="text-orange">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg>
                                </span>
                            @break
                            @case(-1)
                                <span class="text-red">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>
                                </span>
                            @break
                        @endswitch
                        <span class="flex-grow-1"><small>{{$row->baslangic->translatedFormat('d F Y')}} ({{$row->izin_turu}})</small></span>
                        <a href="javascript:;" data-toggle="izinDetay" data-id="{{$row->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="5" cy="12" r="1" /><circle cx="12" cy="12" r="1" /><circle cx="19" cy="12" r="1" /></svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
