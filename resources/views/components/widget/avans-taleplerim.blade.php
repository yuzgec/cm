<div class="col-4">
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><circle cx="18" cy="18" r="4" /><path d="M15 3v4" /><path d="M7 3v4" /><path d="M3 11h16" /><path d="M18 16.496v1.504l1 1" /></svg>
                Avans Taleplerim  ({{count($AvansTaleplerim)}})
            </h3>
        </div>
        <div class="list-group list-group-flush list-group-hoverable">
            @foreach($AvansTaleplerim as $item)
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col d-flex justify-content-between align-items-center">
                            <p>{{number_format($item->tutar,2,".",",")}} ₺</p>
                            <p>{{$item->tarih->format('d.m.Y')}}</p>
                            <p>
                                @switch($item->durum)
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
