@extends('master')
@section('title', 'Varyant Oluştur | '.config('app.name'))
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('varyant.store')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Varyant Adı </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="varyant_adi" placeholder="Varyant Adı Giriniz...." value="{{ old('varyant_adi') }}" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Varyant</label>
                                        <div class="col">
                                            <select class="form-select" name="parent_id">
                                                <option value="">Ana Varyant</option>
                                                @foreach($Varyant as $item)
                                                    <option value="{{ $item->id }}">{{ $item->varyant_adi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block">Kaydet</button>

                            </div>
                        </div>

                    </div>

            </div>
            </form>
        </div>
    </div>
    </div>
@endsection

