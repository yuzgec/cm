<div id="content">
    <div class="d-flex flex-column gap-2">
        <div class="d-flex justify-content-start">
            {!! $Avans->user->avatar !!}
            <div class="bg-muted-lt rounded-3 p-3">
                <p class="p-0 m-0">
                    <span class="font-weight-bold">{{$Avans->user->full_name}}</span> avans talep ediyor.
                </p>
                <small>{{$Avans->aciklama}}</small>
            </div>
        </div>
        @if($Avans->onaylar["Yetkili"] == -1)
            <div class="d-flex justify-content-end">
                <div class="bg-muted-lt rounded-3 p-3 me-2">
                    <p class="p-0 m-0">
                        <span class="font-weight-bold">{{$Avans->user->departman()->first()->yetkili->full_name}}</span>
                    </p>
                    <small>{{$Avans->onaylar["YetkiliMessage"]}}</small>
                </div>
                {!! $Avans->user->departman()->first()->yetkili->avatar !!}
            </div>
        @endif
        @if($Avans->onaylar["Muhasebe"] == -1)
            @php($Muhasebe = \App\Models\User::findOrFail($Avans->onaylar["MuhasebeUser"]))
            <div class="d-flex justify-content-end">
                <div class="bg-muted-lt rounded-3 p-3 me-2">
                    <p class="p-0 m-0">
                        <span class="font-weight-bold">{{$Muhasebe->full_name}}</span>
                    </p>
                    <small>{{$Avans->onaylar["MuhasebeMessage"]}}</small>
                </div>
                {!! $Muhasebe->avatar !!}
            </div>
        @endif
        @if($Avans->durum == -1)
            <div class="d-flex justify-content-end">
                <div class="bg-muted-lt p-2 rounded-3">
                    <!-- Download SVG icon from http://tabler-icons.io/i/x -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                    Bu talep reddedilmiştir.
                </div>
            </div>
        @elseif($Avans->onaylar["Yetkili"] == 0 || $Avans->onaylar["Muhasebe"] == 0)
            <div class="d-flex justify-content-end">
                <div class="bg-muted-lt p-2 rounded-3">
                    <!-- Download SVG icon from http://tabler-icons.io/i/clock -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg>
                    Bu talep için süreç devam ediyor
                </div>
            </div>
        @endif
    </div>
    <div class="mx-4 mt-3">
        <div class="d-flex justify-content-between border-bottom p-1">
            <span>Durum</span>
            @if($Avans->durum == 1)
                <span class="badge bg-success">Onaylandı</span>
            @elseif($Avans->durum == -1)
                <span class="badge bg-danger">Reddedildi</span>
            @elseif($Avans->durum == 0)
                <span class="badge bg-warning">Süreç devam ediyor</span>
            @endif
        </div>
        <div class="d-flex justify-content-between border-bottom p-1">
            <span>Tutar</span><span>{{$Avans->tutar}}</span>
        </div>
        <div class="d-flex justify-content-between border-bottom p-1">
            <span>Tarih</span><span>{{$Avans->tarih->locale('tr')->translatedFormat('d F Y')}}</span>
        </div>
    </div>
    <div class="mt-3 bg-muted-lt py-3 px-5" style="margin-left: -1.5rem; margin-right: -1.5rem">
        <p class="text-blue font-weight-bold">Onay Süreci</p>
        <div class="d-flex">
            {!! $Avans->user->departman()->first()->yetkili->avatar !!}
            <div class="d-flex flex-column flex-grow-1">
                <span class="font-weight-bold">{{$Avans->user->departman()->first()->yetkili->full_name}}</span>
                <span class="font-weight-lighter tracking-tight">{{$Avans->user->departman()->first()->name}}</span>
                @if($Avans->onaylar["Yetkili"] != 0)
                <span class="font-weight-lighter tracking-tight">{{\Carbon\Carbon::parse($Avans->onaylar["YetkiliTarih"])->locale('tr')->translatedFormat('d F Y H:i, l')}}</span>
                @endif
            </div>
            <div>
                @if($Avans->onaylar["Yetkili"] == 1)
                    <span class="badge bg-success">Onaylandı</span>
                @elseif($Avans->onaylar["Yetkili"] == -1)
                    <span class="badge bg-danger">Reddedildi</span>
                @elseif($Avans->onaylar["Yetkili"] == 0)
                    <span class="badge bg-muted-lt">Süreç devam ediyor</span>
                @endif
            </div>
        </div>
        <div class="hr-text hr-text-end">
            <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="18" y1="13" x2="12" y2="19" /><line x1="6" y1="13" x2="12" y2="19" /></svg>
        </div>
        @if($Avans->onaylar["Yetkili"] == 1)
            @if(@$Avans->onaylar["MuhasebeUser"])
                @php($Muhasebe = \App\Models\User::where("id", $Avans->onaylar["MuhasebeUser"]))
                @if($Muhasebe->count())
                    @php($Muhasebe = $Muhasebe->first())
                <div class="d-flex">
                    {!! $Muhasebe->avatar !!}
                    <div class="d-flex flex-column flex-grow-1">
                        <span class="font-weight-bold">{{$Muhasebe->full_name}}</span>
                        <span class="font-weight-lighter tracking-tight">{{$Muhasebe->departman()->first()->name}}</span>
                        <span class="font-weight-lighter tracking-tight">{{\Carbon\Carbon::parse($Avans->onaylar["MuhasebeTarih"])->locale('tr')->translatedFormat('d F Y H:i, l')}}</span>
                    </div>
                    <div>
                        @if($Avans->onaylar["Muhasebe"] == 1)
                            <span class="badge bg-success">Onaylandı</span>
                        @elseif($Avans->onaylar["Muhasebe"] == -1)
                            <span class="badge bg-danger">Reddedildi</span>
                        @elseif($Avans->onaylar["Muhasebe"] == 0)
                            <span class="badge bg-muted-lt">Süreç devam ediyor</span>
                        @endif
                    </div>
                </div>
                @endif
            @endif
        @endif
    </div>
</div>
<div id="footer">
    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Kapat</button>
    @if($Avans->user->departman()->first()->yetkili->id == auth()->user()->id)
        @if($Avans->onaylar["Yetkili"] == 0)
            <button type="button" class="btn btn-danger" id="btnAvansDetayAvansReddet"  data-id="{{$Avans->id}}" data-type="Yetkili">Reddet</button>
            <button type="button" class="btn btn-success" id="btnAvansDetayAvansOnayla" data-id="{{$Avans->id}}" data-type="Yetkili">Onayla</button>
        @endif
    @endif
    @if(auth()->user()->departman()->first()->name == 'Muhasebe')
        @if($Avans->onaylar["Yetkili"] == 1 && $Avans->onaylar["Muhasebe"] == 0)
            <button type="button" class="btn btn-danger" id="btnAvansDetayAvansReddet"  data-id="{{$Avans->id}}" data-type="Muhasebe">Reddet</button>
            <button type="button" class="btn btn-success" id="btnAvansDetayAvansOnayla" data-id="{{$Avans->id}}" data-type="Muhasebe">Onayla</button>
        @endif
    @endif
</div>
