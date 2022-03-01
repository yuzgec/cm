@extends('master')
@section('title', 'Personel Düzenle | ' . config('app.name'))
@section('content')
    {{Form::model($Personel, ["route" => ["IK.update", $Personel->id]])}}
    @method('PUT')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>{{$Personel->full_name}}</h2>
                        <p>{{$Personel->email}}</p>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-primary">Kaydet</button>
                    </div>
                </div>
                <ul class="nav nav-tabs mb-2" data-bs-toggle="tabs" id="tab">
                    <li class="nav-item"><a href="#genel" class="nav-link active" data-bs-toggle="tab">Genel</a></li>
                    <li class="nav-item"><a href="#kisisel" class="nav-link" data-bs-toggle="tab">Kişisel Bilgiler</a></li>
                    <li class="nav-item"><a href="#diger" class="nav-link" data-bs-toggle="tab">Diğer Bilgiler</a></li>
                    <li class="nav-item"><a href="#kariyer" class="nav-link" data-bs-toggle="tab">Kariyer</a></li>
                    <li class="nav-item"><a href="#izin" class="nav-link" data-bs-toggle="tab">İzin</a></li>
                    <li class="nav-item"><a href="#odemeler" class="nav-link" data-bs-toggle="tab">Ödemeler</a></li>
                    <li class="nav-item"><a href="#mesai" class="nav-link" data-bs-toggle="tab">Mesai</a></li>
                    <li class="nav-item"><a href="#bordro" class="nav-link" data-bs-toggle="tab">Bordro</a></li>
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
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group mb-3 text-center">
                                            <a href="javascript:;">
                                                <span class="avatar avatar-xl mb-3 avatar-rounded"
                                                style="border: 2px solid {{@$Personel->departman()->first()->renk}};"
                                                >
                                                    {{$Personel->profile_photo}}
                                                </span>
                                            </a>
                                        </div>
                                        <div class="mb-3 text-center font-weight-bold">
                                            <p>{{$Personel->full_name}}<br />
                                                <span class="font-weight-normal">{{@$Personel->departman()->first()->name}}</span></p>
                                        </div>
                                        <hr />
                                        <div class="">
                                            @if(@$Personel->Bilgiler->ise_baslama_tarihi)
                                            <div class="d-flex justify-content-between">
                                                <p>İşe Başlama Tarihi</p>
                                                <p>{{\Illuminate\Support\Carbon::parse($Personel->Bilgiler->ise_baslama_tarihi)->locale('tr')->translatedFormat('d F Y')}}</p>
                                            </div>
                                            @endif
                                            @if(@$Personel->departman()->first()->yonetici)
                                            <div class="d-flex justify-content-between">
                                                <p>Yöneticisi</p>
                                                <a href="{{route('IK.edit', $Personel->departman()->first()->yonetici)}}">{{$Personel->departman()->first()->yetkili->full_name}}</a>
                                            </div>
                                            @endif
                                            @if(@$Personel->sube()->first())
                                                <div class="d-flex justify-content-between">
                                                    <p>Şube</p>
                                                    <p>{{$Personel->sube()->first()->name}}</p>
                                                </div>
                                            @endif
                                            @if(@$Personel->departman()->first())
                                                <div class="d-flex justify-content-between">
                                                    <p>Departman</p>
                                                    <p>{{$Personel->departman()->first()->name}}</p>
                                                </div>
                                            @endif
{{--                                            Ünvan--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Genel Bilgiler</h3>
                                        <div class="form-group mb-3 row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6"><x-form-inputtext label="Adı" name="name"/></div>
                                                    <div class="col-md-6"><x-form-inputtext label="Soyadı" name="last_name"/></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <x-form-inputtext label="TC Kimlik No" name="tckn"/>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <x-form-email label="Email (Giriş)" name="email"/>
                                            </div>
                                            <div class="col-6">
                                                <x-form-password label="Giriş Şifresi" name="password"/>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <x-form-inputtext label="Telefon (İş)" name="telefon"/>
                                            </div>
                                            <div class="col-6">
                                                <x-form-inputtext label="Telefon (Kişisel)" name="pb[kisisel_telefon]"/>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <x-form-date label="İşe Başlama Tarihi" name="pb[ise_baslama_tarihi]"/>
{{--                                                {{$Personel->pb["ise_baslama_tarihi"]}}--}}
                                            </div>
                                            <div class="col-6">
                                                <x-form-select label="Yetki Grubu" name="diger[role]" :list="$Roles"/>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <x-form-select label="Sözleşme Türü" name="pb[sozlesme_turu]" :list="['0' => 'Süresiz', '1' => 'Süreli']"/>
                                            </div>
                                            <div class="col-6">
                                                <x-form-date label="Sözleşme Bitiş Tarihi" name="pb[sozlesme_bitis_tarihi]" class="form-control" disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <x-form-select label="Şube" name="diger[sube]" :list="$Subeler"/>
                                            </div>
                                            <div class="col-6">
                                                <x-form-select label="Departman" name="diger[departman]" :list="$Departmanlar"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kisisel">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <x-form-date label="Doğum Tarihi" name="pb[dogum_tarihi]"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-select label="Medeni Hal" name="pb[medeni_hal]" :list="$MedeniHaller"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-select label="Cinsiyet" name="pb[cinsiyet]" :list="$Cinsiyetler"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-select label="Engel Derecesi" name="pb[engel_derecesi]" :list="$EngelDereceleri"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-inputtext label="Uyruğu" name="pb[uyrugu]"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-select label="Çocuk Sayısı" name="pb[cocuk_sayisi]" :list="['',0,1,2,3,4,5,6,7,8,9,10]"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-select label="Askerlik Durumu" name="pb[askerlik_durumu]" :list="['','Yapıldı','Yapılmadı','Muaf','Tecilli','Yoklama Kaçağı','Bakaya']"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-select label="Kan Grubu" name="pb[kan_grubu]" :list="['','0-', '0+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+']"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-select label="Eğitim Durumu" name="pb[egitim_durumu]" :list="['','Mezun','Öğrenci']"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-select label="Tamamlanan En Yüksek Eğitim Seviyesi"
                                               name="pb[mezuniyet]"
                                               :list="['','Yok','İlkokul','Ortaokul','Lise','Ön Lisans','Lisans','Yüksek Lisans','Doktora']"/>
                            </div>
                            <div class="col-6 mb-3">
                                <x-form-inputtext label="Son Tamamlanan Eğitim Kurumu" name="pb[mezun_okul]"/>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="diger">
                        <div class="card mb-3">
                            <div class="card-header font-weight-bold">Adres Bilgileri</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <x-form-textarea label="Adres" name="pb[adres]" :row="2"/>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Ev Telefonu" name="pb[adres_telefon]" />
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Ülke" name="pb[adres_ulke]" />
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Şehir" name="pb[adres_sehir]" />
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Posta Kodu" name="pb[adres_postakodu]" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header font-weight-bold">Banka Bilgileri</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Banka Adı" name="pb[banka_adi]" />
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-select label="Hesap Tipi"
                                                       name="pb[banka_hesap_tipi]"
                                                       :list="['','Diğer','Vadeli','Vadesiz','Çek']"
                                        />
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Hesap No" name="pb[banka_hesap_no]" />
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="IBAN" name="pb[banka_iban]" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header font-weight-bold">Acil Durum Bilgileri</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Acil Durumda Aranacak Kişi" name="pb[acil_kisi]" />
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Acil Durumda Aranacak Kişi Yakınlık Derecesi" name="pb[acil_yakinlik]" />
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Acil Durumda Aranacak Kişi Telefon" name="pb[acil_telefon]" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header font-weight-bold">Bağlantılar ve Sosyal Medya Hesapları</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Bağlantı Adı" name="pb[sosyalmedya_adi]" />
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <x-form-inputtext label="Bağlantı Adresi" name="pb[sosyalmedya_baglanti]" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kariyer">Kariyer</div>
                    <div class="tab-pane" id="izin">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th>Başlangıç</th>
                                    <th>Bitiş</th>
                                    <th>Mesai Başlangıç</th>
                                    <th>Süre</th>
                                    <th>İzin Türü</th>
                                    <th>Açıklama</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>Durum</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Personel->izinler()->latest()->get() as $row)
                                    <tr>
                                        <td>{{$row->baslangic->locale('tr')->translatedFormat('d F Y H:i')}}</td>
                                        <td>{{$row->bitis->locale('tr')->translatedFormat('d F Y H:i')}}</td>
                                        <td>{{$row->donus->locale('tr')->translatedFormat('d F Y H:i')}}</td>
                                        <td>{{$row->gun}} Gün</td>
                                        <td>{{$row->izin_turu->name}}</td>
                                        <td>{{$row->aciklama}}</td>
                                        <td>{{$row->created_at->locale('tr')->translatedFormat('d F Y H:i')}}</td>
                                        <td>
                                            @if($row->durum == 0)
                                                <span class="badge bg-warning">Onay bekliyor</span>
                                            @elseif($row->durum == 1)
                                                <span class="badge bg-success">Onaylandı</span>
                                            @elseif($row->durum == -1)
                                                <span class="badge bg-danger">Reddedildi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:;" data-toggle="izinDetay" data-id="{{$row->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path><line x1="16" y1="5" x2="19" y2="8"></line></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="odemeler"></div>
                    <div class="tab-pane" id="mesai">
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                <tr>
                                    <th>TARİH</th>
                                    <th>MESAİ GİRİŞ</th>
                                    <th>GEÇ GİRİŞ</th>
                                    <th>MESAİ ÇIKIŞ</th>
                                    <th>FAZLA MESAİ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Kayitlar as $Row)
                                    <tr>
                                        <td>{{$Row->gun->locale('tr')->translatedFormat('d F Y, l')}}</td>
                                        <td>{{$Row->mesai_giris->format('H:i')}}</td>
                                        <td>{{$Row->gec_mesai}} dk.</td>
                                        <td>{{$Row->mesai_cikis->format('H:i')}}</td>
                                        <td>{{$Row->fazla_calisma}} dk.</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between mt-2">
                                <div>
                                    {{\Carbon\Carbon::parse($MesaiAy)->locale('tr')->translatedFormat('F Y')}} için Toplam Fazla Mesai <span class="text-success">{{$FazlaMesai}}</span> dk. Toplam geç giriş <span class="text-danger">{{$ToplamEksi}}</span> dk.
                                </div>
                                <div>
                                    <select class="form-select" onchange="changeDate()" id="ay">
                                        @foreach($Aylar as $Ay)
                                            <option value="{{$Ay["id"]}}" {{(request()->get('ay') == $Ay["id"])?'selected':''}}>{{$Ay["label"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="bordro">Bordro</div>
                </div>
            </div>
        </div>
    </div>
    {{Form::close()}}


@endsection
@section('customJS')
    <script>
        function changeDate(){
            val = document.getElementById('ay').value;
            document.location = "?ay=" + val + '#mesai';
        }

    </script>
@endsection
