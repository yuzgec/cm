@extends('master')
@section('title', 'Callcenter Grup Ekle | '.config('app.name'))
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-1 d-flex justify-content-between">
                    <div></div>
                    <div>
                        <a class="btn btn-danger" href="{{ route('grup.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                            </svg>
                            Grup Listesi
                        </a>
                    </div>
                </div>
                <form action="{{ route('grup.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6 offset-3">
                            <x-form-inputtext label="Grup Adı" name="name"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6  offset-3 text-end">
                            <button class="btn btn-primary mt-2" type="submit" style="">Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
