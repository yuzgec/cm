@extends('master')
@section('title', 'Varyant Düzenle | '.config('app.name'))
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('varyant.update', $Varyant->id)}}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Varyant Adı </label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="varyant_adi" value="{{ $Varyant->varyant_adi }}" autocomplete="off">
                                        </div>
                                    </div>
                                    @if($Varyant->parent_id == null)
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-3 col-form-label">Varyant</label>
                                        <div class="col">
                                            <select class="form-select" name="parent_id">
                                                <option value="">Ana Varyant</option>
                                                @foreach($VaryantListesi as $item)
                                                    <option value="{{ $item->id }}" {{ ($item->id == $Varyant->id) ? 'selected' : null }}>
                                                        {{ $item->varyant_adi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    <button type="submit" class="btn btn-primary btn-block">Kaydet</button>

                                </div>
                            </div>

                        </div>
                        @if($Varyantlar->count() > 0)
                        <div class="col-lg-12 mt-3">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                        <tr>
                                            <th>Varyant Adı</th>
                                            <th></th>
                                            <th class="w-1"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($Varyantlar as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex py-1 align-items-center">
                                                        <div class="flex-fill">
                                                            <div class="font-weight-medium">{{ $item->varyant_adi}}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal" data-bs-target="#silmeonayi{{ $item->id }}" class="btn btn-sm btn-square btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                        Sil
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm btn-square" href="{{ route('varyant.edit', $item->id) }}">
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
                                                            <form action="{{ route('varyant.destroy', $item->id) }}" method="POST">
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
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

