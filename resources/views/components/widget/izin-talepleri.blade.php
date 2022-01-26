@departmanyonetici
<div class="col-4">
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" /></svg>
                İzin Talepleri ({{count($Izinler)}})
            </h3>
        </div>
        <div class="list-group list-group-flush list-group-hoverable overflow-hidden" style="max-height: 250px; overflow-y: scroll!important;">
            @foreach($Izinler as $Izin)
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="{{ route('IK.edit', $Izin->user->id) }}" title="{{ $Izin->user->full_name }}">
                                {!! $Izin->user->avatar !!}
                            </a>
                        </div>
                        <div class="col d-flex justify-content-between">
                            <a href="javascript:;" data-toggle="izinDetay" data-id="{{$Izin->id}}" class="text-body  birsatir" title="{{ $Izin->user->full_name }}">{{ $Izin->user->full_name }}</a>
                            <div class="text-body birsatir badge">{{$Izin->baslangic->locale('tr')->translatedFormat('d F Y H:i')}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@enddepartmanyonetici
