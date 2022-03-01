<div class="col-4">
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" /></svg>
                İzin Taleplerim ({{count($Izinlerim)}})
            </h3>
        </div>
        <div class="list-group list-group-flush list-group-hoverable">
            @foreach($Izinlerim as $Izin)
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col d-flex justify-content-between align-items-center">
                            <p>{{$Izin->izin_turu->name}}</p>
                            <p>{{$Izin->gun}} Gün</p>
                            <p>{{$Izin->baslangic->format('d.m.Y')}}</p>
                            <p>
                                @switch($Izin->durum)
                                    @case(0)
                                    <span class="badge bg-warning">Bekliyor</span>
                                    @break
                                    @case(1)
                                    <span class="badge bg-success">Onaylandı</span>
                                    @break
                                    @case(-1)
                                    <span class="badge bg-danger">Reddedildi</span>
                                    @break
                                @endswitch
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
