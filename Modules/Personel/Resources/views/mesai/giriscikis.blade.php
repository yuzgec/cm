@extends('master')
@section('title', 'Personel Giriş Çıkış Listesi | '.config('app.name'))

@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="page-header ">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <h3 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                Personel Giriş - Çıkış Listesi
                            </h3>
                        </div>

                        <div class="col-6" >
                            <div class="d-flex justify-content-between" style="float: right;">
                                <div class="col-12 p-1">
                                    <label><small>Puantaj Periyod</small></label>
                                    <select class="form-select" name="ay" id="ay" onchange="changeDate()">
                                        @foreach($Aylar as $ay)
                                            <option value="{{$ay["id"]}}" {{($ay["id"] == request()->get('ay')) ? 'selected=""':''}}>{{$ay["label"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                        <th>Çalışma Gün Sayısı</th>
                                        <th>Eksik Çalışma (Dakika)</th>
                                        <th>Fazla Mesai (Dakika)</th>
                                        <th></th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($personeller as $personel)
                                    <tr>
                                      <td>
                                        <div class="text-muted">
                                            <a href="{{ route('giriscikisdetay', $personel->id) }}" title="Personel Adı">
                                                {{$personel->adsoyad}}
                                            </a>
                                        </div>
                                      </td>
                                        <td>
                                            <div class="text-muted">
{{--                                                {{$personel->fazla_mesai}}--}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                                {{$personel->eksik_mesai}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                                {{$personel->fazla_mesai}}
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </div>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('customJS')
    <script>
        function changeDate(){
            val = document.getElementById('ay').value;
            document.location = "?ay=" + val;
        }
    </script>
@endsection
