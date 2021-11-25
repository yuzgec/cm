@extends('master')
@section('title', 'SMS')
@section('content')
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="subheader">Sms Bakiye</div>
            </div>
                
            <div class="h1 mb-3">10.0000 <span style="font-size:10px">Adet</span></div>
        
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

<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="subheader">Atılan SMS</div>
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
                
            <div class="h1 mb-3">155 Sms</div>
           
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

<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="subheader">Başarılı SMS Sayısı</div>
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
                
            <div class="h1 mb-3">1259 Sms</div>
           
            <div class="progress progress-sm">
                <div class="progress-bar bg-green"
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
<div class="col-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="subheader">Başarısız SMS Sayısı</div>
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
                
            <div class="h1 mb-3">15 Sms</div>
           
            <div class="progress progress-sm">
                <div class="progress-bar bg-red"
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


<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Son Atılan SMS'ler</h3>
      </div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr>
              <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
              <th class="w-1">Dosya No.
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 15 12 9 18 15" /></svg>
              </th>
              <th>Ad Soyad</th>
              <th>Personel</th>
              <th>Tarih</th>
              <th>Durum</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">001401</span></td>
                <td><a href="{{route('dashboard.index')}}" class="text-reset" tabindex="-1">Ahmet Yılmaz</a></td>
                <td>
                    Salih Arık
                </td>
                <td>
                    22.11.2021
                </td>
                <td>
                    <span class="badge bg-success me-1"></span> Başarılı
                </td>
                <td class="text-end">
                  <button class="btn align-text-top" >SMS Görüntüle</button>
                </td>
            </tr>
            <tr>
                <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                <td><span class="text-muted">032154</span></td>
                <td><a href="{{route('dashboard.index')}}" class="text-reset" tabindex="-1">Hakan Güngör</a></td>
                <td>
                    Salih Arık
                </td>
                <td>
                    22.11.2021
                </td>
                <td>
                    <span class="badge bg-danger me-1"></span> Başarısız
                </td>
                <td class="text-end">
                  <button class="btn align-text-top" >SMS Görüntüle</button>
                </td>
            </tr>
               
          </tbody>
        </table>
      </div>
    
    </div>
  </div>
@endsection
