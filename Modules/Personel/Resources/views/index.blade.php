@extends('master')
@section('title', 'Kullanıcı Listesi | '.config('app.name'))
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                Kullanıcı Yönetimi
                            </h3>
                            <div class="text-muted mt-1 mb-1">Toplam ({{ $Users->count() }}) kullanıcı bulunmaktadır.</div>
                        </div>

                        <div class="col-auto ms-auto d-print-none mb-1">
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="input-icon">
                                        <form method="GET" action="{{ route('personel.index') }}">
                                            @csrf
                                            <input type="text" name="q" class="form-control" placeholder="Arama…" value="{{ request('q') }}">
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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Personel Adı</th>
                                        <th>Email</th>
                                        <th>Telefon</th>
                                        <th>Mesai Grup</th>
                                        <th class="text-center">Durum</th>
                                        <th>Tarih</th>
                                        <th></th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($Users as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <span class="avatar me-2"
                                                      style="background-image: url({{$item->getFirstMediaUrl() }});
                                                      border: 2px solid {{ $item->mesai->mesai_renk }}"
                                                >
                                                    {{ (!$item->getFirstMediaUrl()) ? isim($item->name) : null }}
                                                </span>
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">{{ $item->name}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                                {{ $item->email}}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="text-muted">
                                                {{ ($item->telefon == 0) ? null : $item->telefon}}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="text-muted badge" style="background-color:{{ $item->mesai->mesai_renk}} ">
                                                <span class="text-white">{{ $item->mesai->mesai_adi}}</span>
                                            </div>
                                        </td>

                                        <td class="">
                                            <label class="form-check form-check-single form-switch ">
                                                <input
                                                    class="form-check-input switch"
                                                    active-id="{{ $item->id }}"
                                                    type="checkbox"
                                                    @if ($item->durum == 1) checked @endif
                                                />
                                            </label>
                                        </td>
                                        <td class="text-muted">
                                            {{@$item->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#silmeonayi{{ $item->id }}" class="btn btn-sm btn-square btn-danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                Sil
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm btn-square" href="{{ route('personel.edit', $item->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                                Düzenle
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal modal-blur fade" id="silmeonayi{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Silme Onayı</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Silmek üzeresiniz. Bu işlem geri alınmamaktadır.
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>
                                                    İptal Et
                                                </a>
                                                <form action="{{ route('personel.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm ms-auto">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                        Silmek İstiyorum
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


