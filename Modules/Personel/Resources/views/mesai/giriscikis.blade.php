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
                                <div class="col-5 p-1">
                                    <label><small>Başlangıç Tarihi</small></label>
                                    <input type="date" name="baslangic" value="" class="form-control">
                                </div>
                                <div class="col-5 p-1">
                                    <label><small>Bitiş Tarihi</small></label>
                                    <input type="date" name="baslangic" value="" class="form-control">
                                </div>
                                <div class="col-5 p-1">
                                    <label><small>Personel Listesi</small></label>
                                    <select type="text" class="form-select" placeholder="Personel Seçiniz" name="personel">
                                        <option value="">Personel Seçiniz</option>
                                            @foreach ($personel as $item)
                                                <option value="{{ $item->id }}">{{ $item->adsoyad }}</option>
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
                                        <th>Mesai Giriş</th>
                                        <th>Mesai Çıkış</th>
                                        <th>Mesai Çıkış</th>
                                        <th>Geç Kalma</th>
                                        <th>Mesai</th>
                                        <th></th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php $mesai = ['Mesai Yok', '+60dk Mesai', '+150dk Mesai', '+45dk Mesai']; @endphp
                                  @php $isim = ['Salih Arık', 'Ahmet Yılmaz', 'Selim Şahin', 'Ayşe Güngör']; @endphp
                                  @for ($i = 0; $i < 100; $i++)
                                    <tr>
                                      <td>
                                        <div class="text-muted">
                                          {{ $i+1 }}
                                        </div>
                                      </td>
                                        <td>
                                            <div class="text-muted">
                                             <a href="{{ route('giriscikisdetay', $i+1) }}" title="Personel Adı">
                                               @php $ra= rand(1,3); $r=array_rand($isim,4);echo $isim[$r[$ra]]; @endphp
                                             </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                              23.11.2021 09:00
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                              23.11.2021 18:00
                                            </div>
                                        </td>

                                        <td>
                                            <div class="text-muted">
                                              {{rand(1,99)}}DK Geç
                                            </div>
                                        </td>

                                        <td>
                                            <div class="text-muted badge">
                                                @php $ra= rand(1,3); $r=array_rand($mesai,4);echo $mesai[$r[$ra]]; @endphp
                                            </div>
                                        </td>
                                    </tr>
                              
                                    @endfor
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
