@extends('master')
@section('title', 'Çalışanlar Listesi | '.config('app.name'))
@section('content')

    <div class="col-12 d-flex justify-content-between">
        <div class="text-muted mt-1 mb-1">Toplam ({{ $Personel->total() }}) personel bulunmaktadır.</div>

            <div class="input-icon">
                <form method="GET" action="{{ route('personel.index') }}">
                    @csrf
                    <input type="text" name="q" class="form-control" placeholder="Personel Arama…" value="{{ request('q') }}">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" /></svg>
                    </span>
                </form>
            </div>

            <a href="{{ route('personel.create')}}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Personel Ekle
            </a>

            {{ $Personel->appends(['siralama' => 'personel'])->links() }}
    </div>

    @foreach($Personel as $item)
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body p-4 text-center">
                <div class="d-flex">
                    <div class="ms-auto">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#" title="İzin Ekle">İzin ekle</a>
                                <a class="dropdown-item" href="#" title="Avans Ekle">Avans Ekle</a>
                                <a class="dropdown-item" href="#" title="Harcama Ekle">Harcama Ekle</a>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{route('personel.edit', $item->id)}}" title="{{$item->adsoyad}}">
                    <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url({{$item->getFirstMediaUrl() }});border: 2px solid {{ $item->mesai->mesai_renk }}" title="{{$item->adsoyad}}">
                        {{ (!$item->getFirstMediaUrl()) ? isim($item->adsoyad) : null }}
                    </span>
                </a>
                <h3 class="m-0 mb-1">
                    <a href="{{route('personel.edit', $item->id)}}" title="{{$item->adsoyad}}">{{$item->adsoyad}}</a>
                </h3>
                <div class="text-muted birsatir" title="{{ $item->email}}">{{ $item->email}}</div>
                <div class="text-muted birsatir">{{ ($item->telefon) ? $item->telefon : null}}</div>
                <div class="mt-3">
                    <span class="badge" style="background: {{ $item->mesai->mesai_renk }}">
                        {{ $item->mesai->mesai_adi}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
