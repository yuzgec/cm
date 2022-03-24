@extends('master')
@section('title', 'Callcenter Grup Yönetimi | '.config('app.name'))
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-1 d-flex justify-content-between">
                    <div></div>
                    <div>
                        <a class="btn btn-danger" href="{{ route('dosya.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                            </svg>
                            Dosyalar
                        </a>
                        <a class="btn btn-success" href="{{ route('grup.create') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Grup Ekle
                        </a>
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
                            <th>Adı</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Liste as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>
                                    <a href="{{route('foy_durumlari.edit', $row->id)}}" class="btn btn-sm btn-warning">Düzenle</a>
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
                    {{Form::model($item, ["route" => ["foy_durumlari.update", $item->id]])}}
                    @method('put')
                @else
                    {{Form::model($item, ["route" => ["foy_durumlari.store"]])}}
                @endif
                    @csrf
                        <div class="form-group mb-2">
                            <x-form-inputtext label="Adı" name="name" :value="$item->name"/>
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
