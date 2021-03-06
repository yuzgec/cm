@extends('master')
@section('title', $Personel->name.' | Personel Düzenle | '.config('app.name'))
@section('customJS')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script>
        $(document).ready(function(){
            $('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            console.log(activeTab);
            if(activeTab){
                $('#tab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
@endsection
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                    <div class="row">
{{--
                        <form action="{{ route('personel.update', $Personel->id) }}" method="POST" enctype="multipart/form-data">
--}}
                        {{Form::model($Personel, ["route" => ["personel.update", $Personel->id]])}}
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$Personel->id}}">

                        @include('layouts.validate')
                        <div class="d-flex mb-2 justify-content-between">
                            <div class="d-flex">
                                 <span class="avatar mb-3 avatar-rounded"
                                       style="background-image: url({{$Personel->getFirstMediaUrl() }});border: 2px solid {{ @$Personel->mesai->mesai_renk }}"
                                       title="{{$Personel->name}}">
                                     {{ (!$Personel->getFirstMediaUrl()) ? isim($Personel->name) : null }}
                                </span>

                                <div class="ps-2">
                                    <div><b>{{$Personel->name}}</b></div>
                                    <div class="small text-muted">{{$Personel->email}}</div>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs mb-2" data-bs-toggle="tabs" id="tab">
                            <li class="nav-item">
                                <a href="#genel" class="nav-link active" data-bs-toggle="tab">Genel</a>
                            </li>
                            <li class="nav-item">
                                <a href="#kisisel-bilgiler" class="nav-link" data-bs-toggle="tab">Kişisel Bilgiler</a>
                            </li>
                            <li class="nav-item">
                                <a href="#diger-bilgiler" class="nav-link" data-bs-toggle="tab">Diğer Bilgiler</a>
                            </li>
                            <li class="nav-item">
                                <a href="#kariyer" class="nav-link" data-bs-toggle="tab">Kariyer</a>
                            </li>
                            <li class="nav-item">
                                <a href="#izin" class="nav-link" data-bs-toggle="tab">İzin</a>
                            </li>
                            <li class="nav-item">
                                <a href="#odemeler" class="nav-link" data-bs-toggle="tab">Ödemeler</a>
                            </li>
                            <li class="nav-item">
                                <a href="#mesai" class="nav-link" data-bs-toggle="tab">Mesai</a>
                            </li>
                            <li class="nav-item">
                                <a href="#bodro" class="nav-link" data-bs-toggle="tab">Bodro</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Diğer</a>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="#">
                                        Zimmetler
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        Eğitimler
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        Dosyalar
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        Vize Belgesi Talepleri
                                    </a>
                                </div>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="genel">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="form-group mb-3 text-center ">
                                                    <label class="form-label">Personel Resim</label>
                                                    <span class="avatar avatar-xl mb-3 avatar-rounded"
                                                          style="background-image: url({{$Personel->getFirstMediaUrl() }});
                                                            border: 2px solid {{ @$Personel->mesai->mesai_renk }}" title="{{$Personel->name}}">
                                                        {{ (!$Personel->getFirstMediaUrl()) ? isim($Personel->name) : null }}
                                                    </span>
                                                    <input type="file" class="form-control" name="image" id="images">
                                                    <div class="text-center mt-4">
                                                        <div id="preview"></div>
                                                    </div>
                                                    @if($Personel->durum == 1)
                                                        <span class="badge bg-success">Aktif Çalışan</span>
                                                    @else
                                                        <span class="badge bg-danger">Eski Çalışan</span>
                                                    @endif
                                                </div>
                                                <hr>

                                                <div class="d-flex justify-content-between">
                                                    <p>Adı Soyadı</p>
                                                    <p>{{ $Personel->name }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Yönetici</p>
                                                    <p>{{ @$Personel->name }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Ünvan</p>
                                                    <p>{{ @$Personel->mesai->name }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Depertman</p>
                                                    <p>{{ @$Personel->mesai->mesai_adi }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>E-Posta</p>
                                                    <p>{{ @$Personel->email }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <p>Telefon</p>
                                                    <p>{{ @$Personel->telefon}}</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title"><h3>Genel Bilgiler</h3></div>
                                                <div class="form-group mb-3">
                                                    <x-form-inputtext label="Adı Soyadı" name="name"/>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-6">
                                                        <x-form-email label="Email (İş)" name="email"/>
                                                    </div>
                                                    <div class="col-6">
                                                        <x-form-email label="Email (Kişisel)" name="kisisel_eposta"/>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-6">
                                                        <x-form-inputtext label="Telefon (İş)" name="telefon"/>
                                                    </div>
                                                    <div class="col-6">
                                                        <x-form-inputtext label="Telefon (Kişisel)" name="kisisel_telefon"/>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-6">
                                                        <label class="form-label">Sözleşme Türü</label>
                                                        <select class="form-select" name="sozlemeturu">
                                                            <option value="1" selected="">Süreli</option>
                                                            <option value="2">Süresiz</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Erişim Türü</label>
                                                        <select class="form-select" name="erisim_turu">
                                                            <option value="">Seçiniz...</option>
                                                            @foreach($Varyant->where('parent_id', 1) as $item)
                                                                <option value="{{$item->id}}" {{ ($item->id == $Personel->Bilgiler->erisim_turu ) ? 'selected' : null }}>
                                                                    {{$item->varyant_adi}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-6">
                                                        {{--<label class="form-label" for="isebaslama">İşe Başlama Tarihi</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                {{\Carbon\Carbon::parse($Personel->Bilgiler->ise_baslama_tarihi)->diffForHumans()}}
                                                            </span>
                                                            <input type="date" class="form-control" name="pb[ise_baslama_tarihi]" id="isebaslama" value="{{$Personel->Bilgiler->ise_baslama_tarihi}}">
                                                        </div>--}}
                                                        <x-form-inputtext label="İşe Başlama Tarihi" name="pb[ise_baslama_tarihi]"/>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Personel Grubu</label>
                                                        <select class="form-select" name="mesai_id">
                                                            <option value="">Personel Grubu Seçiniz...</option>
                                                            @foreach ($Mesai as $item)
                                                                <option value="{{ $item->id }}" {{ ($item->id == $Personel->mesai_id) ? 'selected' : null }}>
                                                                    {{ $item->mesai_adi}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <button type="submit" class="btn btn-primary">Kaydet</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="kisisel-bilgiler">

                                <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row mb-3">
                                                <div class="col-6">
                                                    <label class="form-label">Doğum Tarihi</label>
                                                    <input type="date" class="form-control" name="dogum_tarihi" value="{{@$Personel->Bilgiler->dogum_tarihi}}">
                                                </div>
                                                <div class="col-6">
                                                    <x-form-inputtext label="TC Klimlik No" name="tckn"/>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <div class="col-6">
                                                    <label class="form-label">Medeni Hal</label>
                                                    <select class="form-select" name="medeni_hal">
                                                        <option value="">Seçiniz...</option>
                                                        @foreach($Varyant->where('parent_id', 8) as $item)
                                                            <option value="{{ $item->id }}" {{ ($item->id == $Personel->Bilgiler->medeni_hal) ? 'selected' : null }}>
                                                            {{$item->varyant_adi}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Cinsiyet</label>
                                                    <select class="form-select" name="cinsiyet">
                                                        <option value="">Seçiniz...</option>
                                                        @foreach($Varyant->where('parent_id', 14) as $item)
                                                            <option value="{{ $item->id }}" {{ ($item->id == $Personel->Bilgiler->cinsiyet) ? 'selected' : null }}>
                                                                {{$item->varyant_adi}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <div class="col-6">
                                                    <label class="form-label">Engel Derecesi</label>
                                                    <select class="form-select" name="engel_derecesi">
                                                        <option value="">Seçiniz...</option>
                                                        @foreach($Varyant->where('parent_id', 19) as $item)
                                                            <option value="{{ $item->id }}" {{ ($item->id == $Personel->Bilgiler->engel_derecesi) ? 'selected' : null }}>
                                                                {{$item->varyant_adi}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Uyruğu</label>
                                                    <select class="form-select" name="uyrugu">
                                                        <option value="1">Türkiye</option>
                                                        <option value="2">Diğer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">

                                                <div class="col-6">
                                                    <label class="form-label">Cocuk Sayısı</label>
                                                    <select class="form-select" name="cocuk_sayisi">
                                                        <option value="">Seçiniz...</option>
                                                        @foreach($Varyant->where('parent_id', 24) as $item)
                                                            <option value="{{ $item->id }}" {{ ($item->id == $Personel->Bilgiler->cocuk_sayisi) ? 'selected' : null }}>
                                                                {{$item->varyant_adi}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-6">
                                                    <label class="form-label">Askerlik Durumu</label>
                                                    <select class="form-select" name="askerlik_durumu">
                                                        <option value="">Seçiniz...</option>
                                                        @foreach($Varyant->where('parent_id', 31) as $item)
                                                            <option value="{{ $item->id }}" {{ ($item->id == $Personel->Bilgiler->askerlik_durumu) ? 'selected' : null }}>
                                                                {{$item->varyant_adi}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group row mb-3">

                                                <div class="col-6">
                                                    <label class="form-label">Kan Grubu</label>
                                                    <select class="form-select" name="kan_grubu">
                                                        <option value="">Seçiniz...</option>
                                                        @foreach($Varyant->where('parent_id', 38) as $item)
                                                            <option value="{{ $item->id }}" {{ ($item->id == $Personel->Bilgiler->kan_grubu) ? 'selected' : null }}>
                                                                {{$item->varyant_adi}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-6">
                                                    <label class="form-label">Eğitim Durumu</label>
                                                    <select class="form-select" name="egitim_durumu">
                                                        <option value="">Seçiniz...</option>
                                                        @foreach($Varyant->where('parent_id', 47) as $item)
                                                            <option value="{{ $item->id }}" {{ ($item->id == $Personel->Bilgiler->egitim_durumu) ? 'selected' : null }}>
                                                                {{$item->varyant_adi}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">

                                                <div class="col-6">
                                                    <label class="form-label">Tamamlanan En Yüksek Eğitim Seviyesi</label>
                                                    <select class="form-select" name="mezuniyet">
                                                        @foreach($Varyant->where('parent_id', 50) as $item)
                                                            <option value="{{ $item->id }}" {{ ($item->id == $Personel->Bilgiler->mezuniyet) ? 'selected' : null }}>
                                                                {{$item->varyant_adi}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Son Tamamlanan Eğitim Kurumu</label>
                                                    <input type="text" class="form-control" name="mezun_okul" value="{{ @$Personel->Bilgiler->mezun_okul }}">
                                                </div>
                                            </div>
                                        </div>

                                    <button type="submit" class="btn btn-primary">Kaydet</button>

                                </div>

                            </div>
                            <div class="tab-pane" id="diger-bilgiler">
                                <div class="card mb-3">
                                    <div class="card-header font-weight-bold">Adres Bilgileri</div>
                                    <div class="card-body">

                                        <div class="form-group row mb-3">
                                            <div class="col-12">
                                                <label class="form-label">Adres Bilgileri</label>
                                                <textarea type="text" class="form-control" name="adres">{{ @$Personel->Bilgiler->adres }}</textarea>
                                            </div>

                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <x-form-inputtext label="Ev Telefonu" name="adres_telefon"/>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Ülke</label>
                                                <select class="form-select" name="adres_ulke">
                                                    <option value="1">Türkiye</option>
                                                    <option value="2">Diğer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Şehir</label>
                                                <input type="text" class="form-control" name="adres_sehir" value="{{ @$Personel->Bilgiler->adres_sehir }}">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Posta Kodu</label>
                                                <input type="text" class="form-control" name="adres_postakodu" value="{{ @$Personel->Bilgiler->adres_postakodu }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card mb-3">
                                    <div class="card-header font-weight-bold">Banka Bilgileri</div>

                                    <div class="card-body">
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Banka Adı</label>
                                                <input type="text" class="form-control" name="banka_adi" value="{{ @$Personel->Bilgiler->banka_adi }}">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Hesap Tipi</label>
                                                <select class="form-select" name="banka_hesap_tipi">
                                                    <option value="">Seçiniz...</option>
                                                    @foreach($Varyant->where('parent_id', 60) as $item)
                                                        <option value="{{ $item->id }}" {{ ($item->id == @$Personel->banka_hesap_tipi) ? 'selected' : null }}>
                                                            {{$item->varyant_adi}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Hesap No</label>
                                                <input type="text" class="form-control" name="banka_hesap_no" value="{{@$Personel->Bilgiler->banka_hesap_no}}">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">IBAN</label>
                                                <input type="text" class="form-control" name="banka_iban" value="{{@$Personel->Bilgiler->banka_iban}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header font-weight-bold">Acil Durum Bilgileri</div>

                                    <div class="card-body">
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Acil Durumda Aranacak Kişi</label>
                                                <input type="text" class="form-control" name="acil_kisi" value="{{$Personel->Bilgiler->acil_kisi}}">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Acil Durumda Aranacak Kişi Yakınlık Derecesi</label>
                                                <input type="text" class="form-control" name="acil_yakinlik" value="{{$Personel->Bilgiler->acil_yakinlik}}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Acil Durumda Aranacak Kişi Telefon</label>
                                                <input type="text" class="form-control" name="acil_telefon" value="{{$Personel->Bilgiler->acil_telefon}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header font-weight-bold">Bağlantılar ve Sosyal Medya Hesapları</div>

                                    <div class="card-body">

                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Bağlantı Adı</label>
                                                <input type="text" class="form-control" name="sosyalmedya_adi" value="{{$Personel->Bilgiler->sosyalmedya_adi}}">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Bağlantı Adresi</label>
                                                <input type="text" class="form-control" name="sosyalmedya_baglanti" value="{{$Personel->Bilgiler->sosyalmedya_baglanti}}">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kaydet</button>

                                </div>
                            </div>
                            <div class="tab-pane" id="kariyer">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /><path d="M9 14l2 2l4 -4" /></svg>
                                                <h3>Kariyer</h3>
                                            </div>
                                            <div>
                                                <a class="btn btn-primary" href="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                    Pozisyon Ekle
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="izin">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label">Yıllık Hakkı / İzin Hakkı</label>
                                                <div class="progress mb-2">
                                                    <div class="progress-bar" style="width: 38%" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="visually-hidden">38% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="small">0 Gün</span>
                                                    <span  class="small">0 Gün</span>
                                                </div>
                                            </div>
                                            <div class="col-9 d-flex justify-content-end">
                                             <div class="col-2 m-1">
                                                 <select class="form-select" name="durum" width="300px">
                                                     <option value="">İzin Türü</option>
                                                     <option value="2">Doğum Sonrası İzin</option>
                                                     <option value="2">Yıllık İzin</option>
                                                     <option value="2">Vefat İzni</option>
                                                     <option value="2">Süt İzni</option>
                                                     <option value="2">Mazeret İzni</option>
                                                     <option value="2">İş Arama İzni</option>
                                                     <option value="2">EVlilik İzni</option>
                                                 </select>
                                             </div>
                                                <div class="col-2 m-1">
                                                    <select class="form-select" name="durum" width="300px">
                                                        <option value="">Tümü</option>
                                                        <option value="2">2022</option>
                                                        <option value="2">2021</option>
                                                        <option value="2">2020</option>
                                                        <option value="2">2019</option>
                                                        <option value="2">2018</option>
                                                        <option value="2">2017</option>

                                                    </select>
                                                </div>
                                                <div class="col-2 m-1">
                                                    <select class="form-select" name="durum" width="300px">
                                                        <option value="1">Vadeli</option>
                                                        <option value="2">Vadesiz</option>
                                                        <option value="2">Çek</option>
                                                        <option value="2">Diğer</option>
                                                    </select>
                                                </div>


                                        </div>
                                        </div>

                                        <img src="https://kolayik.com/app/assets/images/icons/undraw-no-data.svg">
                                        <div>Kayıtlı izin bilgisi bulunamadı.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="odemeler">
                                <div class="card">
                                    <div class="card-body">
                                        <div>Ödemeler</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="mesai">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div>
                                            <img src="https://kolayik.com/app/assets/images/icons/undraw-no-data.svg">
                                            <div>Kayıtlı izin bilgisi bulunamadı.</div>
                                            <p>Tüm mesai kayıtlarını bu ekranda görüntüleyebilirsiniz.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="bodro">
                                <div class="card">
                                    <div class="card-body">
                                        <div>Bodro</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
