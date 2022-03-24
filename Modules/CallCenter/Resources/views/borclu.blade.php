@extends('master')
@section('title', 'Callcenter Borçlu Yönetimi | '.config('app.name'))
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-1 d-flex justify-content-between">
                    <div><h3>Borçlu Yönetimi</h3></div>
                    <div>
                        <a class="btn btn-danger" href="{{ route('dosya.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                            </svg>
                            Dosyalar
                        </a>
                        <a class="btn" href="{{ route('alacakli.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                            Alacaklı Yönetimi
                        </a>
                        <a class="btn" href="{{ route('borclu.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                            Borçlu Yönetimi
                        </a>
                        <a class="btn" href="javascript:;" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="4" width="16" height="6" rx="2"></rect><rect x="4" y="14" width="16" height="6" rx="2"></rect></svg>
                            Tanımlamalar
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="{{route('dosya_gruplari.index')}}" class="dropdown-item">Dosya Grupları</a>
                            <a href="{{route('foy_durumlari.index')}}" class="dropdown-item">Föy Durumları</a>
                            <a href="{{route('form_turleri.index')}}" class="dropdown-item">Form Türleri</a>
                            <a href="{{route('icra_mudurlugu.index')}}" class="dropdown-item">İcra Müdürlükleri</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ünvan</th>
                            <th>TC Kimlik/Vergi No</th>
                            <th>İlçe</th>
                            <th>İl</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Liste as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->unvan}}</td>
                                <td>{{$row->tc}}</td>
                                <td>{{$row->ilce}}</td>
                                <td>{{$row->il}}</td>
                                <td>
                                    <a href="{{route('alacakli.edit', $row->id)}}" class="btn btn-sm btn-warning">Düzenle</a>
                                    <a href="javascript:;" class="btn btn-sm btn-danger">Sil</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                @if($item->id > 0)
                    {{Form::model($item, ["route" => ["alacakli.update", $item->id]])}}
                    @method('put')
                @else
                    {{Form::model($item, ["route" => ["alacakli.store"]])}}
                @endif
                    @csrf
                        <div class="form-group mb-2">
                            <x-form-inputtext label="Ünvan" name="unvan" :value="$item->unvan"/>
                        </div>
                        <div class="form-group mb-2">
                            <x-form-inputtext label="TC Kimlik/Vergi No" name="tc" :value="$item->tc"/>
                        </div>
                        <div class="form-group mb-2">
                            <x-form-textarea label="Adres" name="adres" :value="$item->adres"/>
                        </div>
                        <div class="row">
                            <div class="form-group mb-2 col-6">
                                <x-form-inputtext label="İlçe" name="ilce" :value="$item->ilce"/>
                            </div>
                            <div class="form-group mb-2 col-6">
                                <x-form-inputtext label="İl" name="il" :value="$item->il"/>
                            </div>
                        </div>
                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-primary">
                                @if($item->id > 0)
                                    Güncelle
                                @else
                                    Ekle
                                @endif
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
