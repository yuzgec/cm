@extends('master')
@section('title', 'Excel Dosya Ekle | '.config('app.name'))
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
                            Dosya Listesi
                        </a>
                    </div>
                </div>

                <form action="{{ route('dosya.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <label class="form-label">  İcra Dairesi</label>
                            <select class="form-select" name="sozlemeturu">
                                <option value="1" selected="">Satır 1 </option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <label class="form-label"> Dosya Numarası</label>
                            <select class="form-select" name="sozlemeturu">
                                <option value="1" selected="">Satır 1 </option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                                <option value="2">Satır 2</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
