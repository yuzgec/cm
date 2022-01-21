@departmanyonetici
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
@enddepartmanyonetici
