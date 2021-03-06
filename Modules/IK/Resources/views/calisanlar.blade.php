@extends('master')
@section('title', 'Çalışanlar Listesi | '.config('app.name'))
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="col-3 justify-content-center align-items-center ">
                <p class="pt-2">Toplam <b>({{ $Users->total() }})</b> personel bulunmaktadır.</p>
            </div>
            <div class="col-3 justify-content-center align-items-center">
                <div class="input-icon">
                    <form method="GET" action="{{ route('IK.calisanlar') }}">
                        @csrf
                        <input type="text" name="q" class="form-control" placeholder="Personel Arama…"
                               value="{{ request('q') }}">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="10" cy="10" r="7"/>
                                <line x1="21" y1="21" x2="15" y2="15"/></svg>
                        </span>
                    </form>
                </div>
            </div>
            <div class="col-6 d-flex gap-2 justify-content-end align-items-center">
                <a href="{{route('IK.create')}}" class="btn btn-secondary" style="margin-left:50px">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Çalışan Ekle
                </a>
                <a href="{{route('IK.OzlukIndir')}}" class="btn btn-info">
                    Özlük İndir
                </a>
                @if(\Illuminate\Support\Facades\Route::currentRouteName() == "IK.pasifcalisanlar")
                    <a href="{{route('IK.calisanlar')}}" class="btn btn-success">
                        Aktif Çalışanlar
                    </a>
                @else
                    <a href="{{route('IK.pasifcalisanlar')}}" class="btn btn-danger">
                        Pasif Çalışanlar
                    </a>
                @endif
            </div>
        </div>
        <div class="row">
            @foreach($Users as $item)
                <div class="col-md-6 col-lg-3 mb-2">
                    <div class="card">
                        <div class="card-body p-4 text-center">
                            @if(auth()->user()->departman())
                                @if(auth()->user()->departman()->first()->name == 'Muhasebe')
                                    <div class="d-flex">
                                        <div class="ms-auto">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                                   aria-haspopup="true" aria-expanded="false"></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="javascript:;" data-user="{{$item->id}}" data-toggle="userIzinEkle" title="İzin Ekle">İzin ekle</a>
                                                    <a class="dropdown-item" href="javascript:;" data-user="{{$item->id}}" data-toggle="userPassive" title="Pasifleştir">
                                                        Kullanıcıyı
                                                        @if($item->durum == 1)
                                                            Pasifleştir
                                                        @else
                                                            Aktifleştir
                                                        @endif
                                                    </a>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->email == env('ADMIN_MAIL'))
                                                        <a class="dropdown-item" href="{{route('IK.LoginWithUser', $item->id)}}" title="Bu Kullanıcı İle Giriş">Bu Kullanıcı İle Giriş</a>
                                                    @endif
                                                    <a class="dropdown-item d-none" href="javascript:;" data-user="{{$item->id}}" data-toggle="userAvansEkle" title="Avans Ekle">Avans Ekle</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <a href="{{route('IK.edit', $item->id)}}" title="{{$item->full_name}}">
                    <span class="avatar avatar-xl mb-3 avatar-rounded"
                          style="background-image: url({{$item->getFirstMediaUrl() }});border: 2px solid {{ @$item->departman()->first()->renk }}"
                          title="{{$item->name}}">
                        {{ (!$item->getFirstMediaUrl()) ? $item->profile_photo : null }}
                    </span>
                            </a>
                            <h3 class="m-0 mb-1">
                                <a href="{{route('IK.edit', $item->id)}}" title="{{$item->full_name}}">{{$item->full_name}}</a>
                            </h3>
                            <div class="text-muted birsatir" title="{{ $item->email}}">{{ $item->email}}</div>
                            <div class="text-muted birsatir">{{ ($item->telefon) ? $item->telefon : null}}</div>
                            <div class="mt-3">
                                @if($item->departman()->count())
                                    <span class="badge" style="background: {{ $item->departman()->first()->renk }}">
                        {{$item->departman()->first()->name}}
                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $Users->appends(['siralama' => 'personel'])->links() }}
        </div>
    </div>
</div>
@endsection
