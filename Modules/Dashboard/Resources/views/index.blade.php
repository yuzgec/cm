@extends('master')
@section('content')

    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Ödeme</div>
                    <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bugün</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#">Bugün</a>
                                <a class="dropdown-item" href="#">Dün</a>
                                <a class="dropdown-item" href="#">Son 1 Hafta</a>
                                <a class="dropdown-item" href="#">Son 1 Ay</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h1 mb-3">{{$GunlukToplam}} ₺</div>

                <div class="progress progress-sm">
                    <div class="progress-bar bg-blue"
                    style="width: 100%"
                    role="progressbar"
                    aria-valuenow="100"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Çağrı Durumu</div>
                    <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bugün</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#">Bugün</a>
                                <a class="dropdown-item" href="#">Dün</a>
                                <a class="dropdown-item" href="#">Son 1 Hafta</a>
                                <a class="dropdown-item" href="#">Son 1 Ay</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h1 mb-3">0 Arama</div>

                <div class="progress progress-sm">
                    <div class="progress-bar bg-blue"
                    style="width: 100%"
                    role="progressbar"
                    aria-valuenow="100"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Dosya Sayısı</div>
                    <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bugün</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#">Bugün</a>
                                <a class="dropdown-item" href="#">Dün</a>
                                <a class="dropdown-item" href="#">Son 1 Hafta</a>
                                <a class="dropdown-item" href="#">Son 1 Ay</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h1 mb-3">0 Dosya</div>

                <div class="progress progress-sm">
                    <div class="progress-bar bg-blue"
                    style="width: 100%"
                    role="progressbar"
                    aria-valuenow="100"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-blue text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 11l2 2l4 -4" /></svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                        Kullanıcı Sayısı
                        </div>
                        <div class="text-muted">
                        Toplam {{$UserCount}} Kullanıcı
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-blue text-white avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                        Personel Sayısı
                        </div>
                        <div class="text-muted">
                        Toplam {{$PersonelCount}} Personel
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-blue text-white avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 11l2 2l4 -4" /></svg>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                        Kullanıcı Sayısı
                        </div>
                        <div class="text-muted">
                        Toplam 25 Kullanıcı
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-blue text-white avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                        Personel Sayısı
                        </div>
                        <div class="text-muted">
                        Toplam 25 Personel
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <div class="col-12">
    <div class="card">
      <div class="card-header justify-content-between">
          <div>
              <h3 class="card-title">Son Alınan Ödemeler</h3>
          </div>
          <div>
              {{ $OdemeListesi->appends(['listele' => 'odeme'])->links() }}
          </div>


      </div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr>
              <th class="w-1">Dosya No.
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
              </th>
              <th>Ad Soyad</th>
              <th>Ödeme Tutarı</th>
              <th>Tarih</th>
              <th>Durum</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($OdemeListesi as $item)
            <tr>
              <td><span class="text-muted">{{ $item->dosya_no }}</span></td>
              <td><a href="{{route('dashboard.index')}}" class="text-reset" tabindex="-1">{{ $item->ad_soyad }}</a></td>
              <td>
                  {{ $item->odeme_tutari }}
              </td>

              <td>
                  {{ $item->created_at }}
              </td>
              <td>
                <span class="badge bg-{{ ($item->odeme_cevap == 1 ) ? 'success' : 'danger' }} me-1"></span> {{ ($item->odeme_cevap == 1 ) ? 'Başarılı' : 'Başarısız' }}
              </td>
              <td class="text-end">
                  <button class="btn align-text-top" >Görüntüle</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
  @endsection
