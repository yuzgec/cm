@extends('master')
@section('title', 'Dosya Yönetimi | '.config('app.name'))
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-1 d-flex justify-content-between">
                    <div>
                        <div class="input-icon">
                            <form method="GET" action="">
                                @csrf
                                <input type="text" name="q" class="form-control" placeholder="Dosya Arama…" value="">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="10" cy="10" r="7"></circle>
                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                    </svg>
                                </span>
                            </form>
                        </div>
                    </div>
                    <div>
                        <a class="btn" href="{{route('dosyaexcelyukle')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" /></svg>
                            Excel ile Yükle
                        </a>

                        <a class="btn" href="{{ route('dosya.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" /></svg>
                            Dosya Ekle
                        </a>
                       <a class="btn" href="{{ route('grup.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                           Grup Ekle
                       </a>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable table-bordered">
                    <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Dosya Adı</th>
                        <th>Dosya Grup</th>
                        <th>Tutar</th>
                        <th>Tarih</th>
                        <th>Durumu</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><span class="text-muted">1</span></td>
                            <td>
                               Test 1
                            </td>
                            <td class="">
                                Test 2
                            </td>
                            <td class="">
                                Test 3
                            </td>
                            <td class="">
                               Yükleme Tarihi
                            </td>
                            <td class="">
                                Durumu
                            </td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#silmeonayi1" class="btn btn-sm btn-square btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    Sil
                                </a>
                                <a class="btn btn-primary btn-sm btn-square" href="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                    Düzenle
                                </a>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

@endsection
