@extends('master')
@section('title', 'Personel Düzenle | '.config('app.name'))
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

                <form action="{{ route('personel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        @include('layouts.validate')
                        <div class="d-flex mb-2 justify-content-between" >
                            <div class="d-flex">

                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Kaydet</button>
                            </div>
                        </div>

                        <ul class="nav nav-tabs mb-2" data-bs-toggle="tabs" id="tab">
                            <li class="nav-item">
                                <a href="#genel" class="nav-link active" data-bs-toggle="tab">Genel</a>
                            </li>
                            <li class="nav-item">
                                <a href="#kariyer" class="nav-link disabled" data-bs-toggle="tab">Kariyer</a>
                            </li>
                            <li class="nav-item">
                                <a href="#kisisel-bilgiler" class="nav-link disabled" data-bs-toggle="tab">Kişisel Bilgiler</a>
                            </li>
                            <li class="nav-item">
                                <a href="#diger-bilgiler" class="nav-link disabled" data-bs-toggle="tab">Diğer Bilgiler</a>
                            </li>
                            <li class="nav-item">
                                <a href="#izin" class="nav-link disabled" data-bs-toggle="tab">İzin</a>
                            </li>
                            <li class="nav-item">
                                <a href="#odemeler" class="nav-link disabled" data-bs-toggle="tab">Ödemeler</a>
                            </li>
                            <li class="nav-item">
                                <a href="#mesai" class="nav-link disabled" data-bs-toggle="tab">Mesai</a>
                            </li>
                            <li class="nav-item">
                                <a href="#bodro" class="nav-link disabled" data-bs-toggle="tab">Bodro</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link disabled dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Diğer</a>
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

                                                    <span class="avatar avatar-xl mb-3 avatar-rounded">
                                                    </span>

                                                    <input type="file" class="form-control" name="foto" id="images">

                                                    <div class="text-center mt-4">
                                                        <div id="preview"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title"><h3>Genel Bilgiler</h3></div>

                                                <div class="form-group mb-3">
                                                    <label class="form-label">Adı Soyadı</label>
                                                    <input type="text" class="form-control" name="" >
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-6">
                                                        <label class="form-label">Email (İş)</label>
                                                        <input type="text" class="form-control" name="">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Email (Kişisel)</label>
                                                        <input type="text" class="form-control" name="" >
                                                    </div>
                                                </div>


                                                <div class="form-group row mb-3">
                                                    <div class="col-6">
                                                        <label class="form-label">Telefon (İş)</label>
                                                        <input type="text" class="form-control" name="">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Telefon (Kişisel)</label>
                                                        <input type="text" class="form-control" name="">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-6">
                                                        <label class="form-label">Sözleşme Türü</label>
                                                        <select class="form-select" name="durum">
                                                            <option value="1" selected="">Süreli</option>
                                                            <option value="2">Süresiz</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Erişim Türü</label>
                                                        <select class="form-select" name="durum">
                                                            <option value="1" selected="">Çalışan</option>
                                                            <option value="2">Yönetici</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group row mb-3">
                                                    <div class="col-6">
                                                        <label class="form-label">İşe Başlama Tarihi</label>
                                                        <input type="date" class="form-control" name="" value="">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Telefon (Kişisel)</label>
                                                        <input type="text" class="form-control" name="" >
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="col-6">
                                                        <label class="form-label">TC Kimlik Numrası </label>
                                                        <input type="text" class="form-control" name="tckn" >
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Personel Grubu</label>
                                                        <select class="form-select" name="mesai_id">
                                                            <option value="">Personel Grubu Seçiniz...</option>
                                                            @foreach ($mesai as $item)
                                                                <option value="{{ $item->id }}">{{ $item->mesai_adi}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="kariyer">
                                <div class="card">
                                    <div class="card-body">
                                        <div>Kariyer</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kisisel-bilgiler">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Doğum Tarihi</label>
                                                <input type="text" class="form-control" name="">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Kimlik NO</label>
                                                <input type="text" class="form-control" name="">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Medeni Hal</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">Evli</option>
                                                    <option value="2">Bekar</option>
                                                    <option value="2">Boşanmış</option>
                                                    <option value="2">Belirtilmemiş</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Cinsiyet</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">Erkek</option>
                                                    <option value="2">Kadın</option>
                                                    <option value="2">Diğer</option>
                                                    <option value="2">Belirtilmemiş</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Engel Derecesi</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">Yok</option>
                                                    <option value="2">1. Derece</option>
                                                    <option value="2">2. Derece</option>
                                                    <option value="2">3. Derece</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Uyruğu</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">Türkiye</option>
                                                    <option value="2">Diğer</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Cocuk Sayısı</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">Yok</option>
                                                    <option value="2">1</option>
                                                    <option value="2">2</option>
                                                    <option value="2">3</option>
                                                    <option value="2">4</option>
                                                    <option value="2">5</option>
                                                    <option value="2">6</option>
                                                    <option value="2">7</option>
                                                    <option value="2">8</option>
                                                    <option value="2">9</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Askerlik Durumu</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">Yapıldı</option>
                                                    <option value="2">Yapılmadı</option>
                                                    <option value="2">Muaf</option>
                                                    <option value="2">Tecilli</option>
                                                    <option value="2">Yoklama Kaçağı</option>
                                                    <option value="2">Bakaya</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Kan Grubu</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">0+</option>
                                                    <option value="2">0-</option>
                                                    <option value="2">A+</option>
                                                    <option value="2">A-</option>
                                                    <option value="2">B+</option>
                                                    <option value="2">B-</option>
                                                    <option value="2">AB+</option>
                                                    <option value="2">AB-</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Eğitim Durumu</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">Mezun</option>
                                                    <option value="2">Öğrenci</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Tamamlanan En Yüksek Eğitim Seviyesi</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">İlkokul</option>
                                                    <option value="2">Ortaokul</option>
                                                    <option value="2">Lise</option>
                                                    <option value="2">Ön Lisans</option>
                                                    <option value="2">Lisans</option>
                                                    <option value="2">Yüksek Lisans</option>
                                                    <option value="2">Doktora</option>
                                                    <option value="2">Yok</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Son Tamamlanan Eğitim Kurumu</label>
                                                <input type="text" class="form-control" name="a" value="">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="diger-bilgiler">

                                <div class="card mb-3">
                                    <div class="card-header font-weight-bold">Adres Bilgileri</div>
                                    <div class="card-body">

                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Adres Bilgileri</label>
                                                <input type="text" class="form-control" name="" value="">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Adres (devam)</label>
                                                <input type="text" class="form-control" name="" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Ev Telefonu</label>
                                                <input type="text" class="form-control" name="" value="">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Ülke</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">Türkiye</option>
                                                    <option value="2">Diğer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Şehir</label>
                                                <input type="text" class="form-control" name="" value="">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Posta Kodu</label>
                                                <input type="text" class="form-control" name="" value="">
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
                                                <input type="text" class="form-control" name="" value="">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Hesap Tipi</label>
                                                <select class="form-select" name="durum">
                                                    <option value="1">Vadeli</option>
                                                    <option value="2">Vadesiz</option>
                                                    <option value="2">Çek</option>
                                                    <option value="2">Diğer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Hesap No</label>
                                                <input type="text" class="form-control" name="" value="">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">IBAN</label>
                                                <input type="text" class="form-control" name="" value="">
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
                                                <input type="text" class="form-control" name="" value="">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Acil Durumda Aranacak Kişi Yakınlık Derecesi</label>
                                                <input type="text" class="form-control" name="" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-6">
                                                <label class="form-label">Acil Durumda Aranacak Kişi Telefon</label>
                                                <input type="text" class="form-control" name="" value="">
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
                                                <input type="text" class="form-control" name="" value="">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Bağlantı Adresi</label>
                                                <input type="text" class="form-control" name="" value="">
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
                </form>
            </div>
        </div>
    </div>
@endsection
