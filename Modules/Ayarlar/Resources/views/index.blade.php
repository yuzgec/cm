@extends('master')
@section('customCSS')
@endsection
@section('content')
    <div id="ayarlar">
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="tabnav">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item d-none" v-bind:class="activeTab == 'sistem' ? 'active': ''"><a
                                    href="javascript:;" class="nav-link" v-on:click="ChangeTab" data-id="sistem"><span
                                        class="nav-link-title">Sistem Ayarları</span></a></li>
                            <li class="nav-item" v-bind:class="activeTab == 'sirket' ? 'active': ''"><a
                                    href="javascript:;" class="nav-link" v-on:click="ChangeTab" data-id="sirket"><span
                                        class="nav-link-title">Şirket Bilgileri</span></a></li>
                            <li class="nav-item d-none" v-bind:class="activeTab == 'kural' ? 'active': ''"><a
                                    href="javascript:;" class="nav-link" v-on:click="ChangeTab" data-id="kural"><span
                                        class="nav-link-title">Kural Yönetimi</span></a></li>
                            <li class="nav-item" v-bind:class="activeTab == 'tatil' ? 'active': ''"><a
                                    href="javascript:;" class="nav-link" v-on:click="ChangeTab" data-id="tatil"><span
                                        class="nav-link-title">Tatil Takvimi</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-4" id="content">
            <div v-if="loaded">
                <div class="row" v-if="activeTab == 'sirket'" style="display: none" v-show="activeTab == 'sirket'">
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3 class="card-title">Şubeler</h3>
                                <div>
                                    <button class="btn btn-sm btn-primary" v-on:click="SubeEkle">Şube Ekle</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                    <tr>
                                        <th>Adı</th>
                                        <th>Yetkili</th>
                                        <th>Çalışan Sayısı</th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="sube in Subeler">
                                        <td><span v-html="sube.name"></span></td>
                                        <td><span v-html="sube.yonetici ? sube.yetkili.name : null"></span></td>
                                        <td><span v-html="sube.calisan"></span></td>
                                        <td>
                                            <a href="javascript:;" v-on:click="SubeDuzenle(sube)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                     height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                                    <line x1="16" y1="5" x2="19" y2="8"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3 class="card-title">Departmanlar</h3>
                                <div>
                                    <button class="btn btn-sm btn-primary" v-on:click="DepartmanEkle">Departman Ekle
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                    <tr>
                                        <th>Adı</th>
                                        <th>Yetkili</th>
                                        <th>Şube</th>
                                        <th>Çalışan Sayısı</th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in Departmanlar">
                                        <td class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm text-white"
                                                 v-bind:style="{ backgroundColor: item.renk }">B
                                            </div>
                                            <span v-html="item.name"></span></td>
                                        <td><span
                                                v-html="item.yonetici ? item.yetkili.name + ' ' + item.yetkili.last_name : null"></span>
                                        </td>
                                        <td><span v-html="item.sube_id ? item.sube.name : null"></span></td>
                                        <td><span v-html="item.calisan"></span></td>
                                        <td>
                                            <a href="javascript:;" v-on:click="DepartmanDuzenle(item)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                     height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                                    <line x1="16" y1="5" x2="19" y2="8"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h3 class="card-title">Ünvanlar</h3>
                                <div>
                                    <button class="btn btn-sm btn-primary" v-on:click="UnvanEkle">Ünvan Ekle</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                    <tr>
                                        <th>Adı</th>
                                        <th>Yetkili</th>
                                        <th>Departman</th>
                                        <th>Çalışan Sayısı</th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="item in Unvanlar">
                                        <td><span v-html="item.name"></span></td>
                                        <td><span v-html="item.yonetici ? item.yetkili.name : null"></span></td>
                                        <td><span v-html="item.departman_id ? item.departman.name : null"></span></td>
                                        <td><span v-html="item.calisan"></span></td>
                                        <td>
                                            <a href="javascript:;" v-on:click="UnvanDuzenle(item)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                     height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                                    <line x1="16" y1="5" x2="19" y2="8"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="activeTab == 'tatil'" style="display: none" v-show="activeTab == 'tatil'">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h3 class="card-title">Tatil Listesi</h3>
                                </div>
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                    <tr>
                                        <th>Tatil Adı</th>
                                        <th>Tatil Başlangıç / Bitiş</th>
                                        <th>Toplam Gün</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in Tatiller">
                                            <td><span v-html="item.name"></span></td>
                                            <td><span v-html="this.Tarih(item.baslangic, 'DD.MM.YYYY') + ' / ' + this.Tarih(item.bitis, 'DD.MM.YYYY')"></span></td>
                                            <td><span v-html="item.gun"></span></td>
                                            <td>
                                                <a href="javascript:;" v-on:click="TatilDuzenle(item)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                         height="24" viewBox="0 0 24 24" stroke-width="2"
                                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                                         stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path
                                                            d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                                        <line x1="16" y1="5" x2="19" y2="8"/>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title" v-if="editTatil.id == null">Tatil Ekle</h3>
                                    <h3 class="card-title" v-if="editTatil.id != null">Tatil Güncelle</h3>
                                </div>
                                <div class="card-body">
                                    <form action="javascript:;">
                                        <input type="hidden" v-model="editTatil.id">
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Tatil Adı</label>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Tatil Adını Giriniz" v-model="editTatil.name">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Başlangıç Tarihi</label>
                                            <div class="col">
                                                <input type="date" class="form-control" v-model="editTatil.baslangic">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 row">
                                            <label class="form-label col-3 col-form-label">Bitiş Tarihi</label>
                                            <div class="col">
                                                <input type="date" class="form-control" v-model="editTatil.bitis">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer card-footer-gray d-flex justify-content-between">
                                    <button class="btn btn-warning" v-on:click="this.resetTatil" v-if="editTatil.id != null">İptal</button>
                                    <span v-if="editTatil.id == null">&nbsp;</span>
                                    <button class="btn btn-primary" v-on:click="saveTatil">
                                        <span v-if="editTatil.id == null">Tatil Ekle</span>
                                        <span v-if="editTatil.id != null">Kaydı Güncelle</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="activeTab == 'kural'" style="display: none" v-show="activeTab == 'kural'">Kural
                </div>
            </div>
            <div class="card" v-if="!loaded">
                <div class="card-body">
                    <div class="skeleton-heading"></div>
                    <div class="skeleton-line"></div>
                    <div class="skeleton-line"></div>
                    <div class="skeleton-line"></div>
                    <div class="skeleton-line"></div>
                    <div class="skeleton-line"></div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-sube" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-html="editSube.id > 0 ? 'Şube Düzenle':'Şube Ekle'"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Şube Adı</label>
                            <input type="text" class="form-control" v-model="editSube.name" id="subeAdi">
                            <div class="invalid-feedback">Hata Mesajı</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Şube Yetkilisi</label>
                            <select class="form-select" v-model="editSube.yetkili">
                                <option value="null">Yetkili</option>
                                <option v-for="item in Calisanlar" :value="item.id" v-html="item.name"></option>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">İptal</button>
                        <button type="button" class="btn btn-primary" v-on:click="SubeEkleForm"
                                v-html="editSube.id > 0 ? 'Şube Güncelle' : 'Şube Ekle'"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-departman" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            v-html="editDepartman.id > 0 ? 'Departman Düzenle':'Departman Ekle'"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Departman Adı</label>
                            <input type="text" class="form-control" v-model="editDepartman.name" id="subeAdi">
                            <div class="invalid-feedback">Hata Mesajı</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Bağlı Olduğu Şube</label>
                                <select class="form-select" v-model="editDepartman.sube_id">
                                    <option value="null">Şube Seçin</option>
                                    <option v-for="item in Subeler" :value="item.id" v-html="item.name"></option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Departman Yetkilisi</label>
                                <select class="form-select" v-model="editDepartman.yetkili">
                                    <option value="null">Yetkili</option>
                                    <option v-for="item in Calisanlar" :value="item.id" v-html="item.name"></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Renk</label>
                                <input type="color" class="form-control" v-model="editDepartman.renk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-12">Mesai Saatleri</label>
                            <div class="d-flex justify-content-start gap-2">
                                <div class="">
                                    <label class="form-label">Pazartesi </label>
                                    <input type="text" v-model="editDepartman.mesai_pazartesi"
                                           pattern="^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])-(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$"
                                           class="form-control">
                                </div>
                                <div class="">
                                    <label class="form-label">Salı</label>
                                    <input type="text" v-model="editDepartman.mesai_sali"
                                           pattern="^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])-(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$"
                                           class="form-control">
                                </div>
                                <div class="">
                                    <label class="form-label">Çarşamba</label>
                                    <input type="text" v-model="editDepartman.mesai_carsamba"
                                           pattern="^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])-(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$"
                                           class="form-control">
                                </div>
                                <div class="">
                                    <label class="form-label">Perşembe</label>
                                    <input type="text" v-model="editDepartman.mesai_persembe"
                                           pattern="^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])-(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$"
                                           class="form-control">
                                </div>
                                <div class="">
                                    <label class="form-label">Cuma</label>
                                    <input type="text" v-model="editDepartman.mesai_cuma"
                                           pattern="^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])-(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">İptal</button>
                        <button type="button" class="btn btn-primary" v-on:click="DepartmanEkleForm"
                                v-html="editDepartman.id > 0 ? 'Departman Güncelle' : 'Departman Ekle'"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-unvan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-html="editUnvan.id > 0 ? 'Ünvan Düzenle':'Ünvan Ekle'"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Ünvan Adı</label>
                            <input type="text" class="form-control" v-model="editUnvan.name" id="subeAdi">
                            <div class="invalid-feedback">Hata Mesajı</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bağlı Olduğu Departman</label>
                            <select class="form-select" v-model="editUnvan.departman_id">
                                <option value="null">Departman Seçin</option>
                                <option v-for="item in Departmanlar" :value="item.id" v-html="item.name"></option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ünvan Yetkilisi</label>
                            <select class="form-select" v-model="editUnvan.yetkili">
                                <option value="null">Yetkili</option>
                                <option v-for="item in Calisanlar" :value="item.id" v-html="item.name"></option>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">İptal</button>
                        <button type="button" class="btn btn-primary" v-on:click="UnvanEkleForm"
                                v-html="editUnvan.id > 0 ? 'Ünvan Güncelle' : 'Ünvan Ekle'"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJS')
    <script>
        const Ayarlar = {
            data() {
                return {
                    activeTab: '',
                    loaded: false,
                    Subeler: [],
                    Departmanlar: [],
                    Unvanlar: [],
                    Calisanlar: [],
                    Tatiller: [],
                    editSube: {id: null, name: null, yetkili: null},
                    editDepartman: {
                        id: null,
                        name: null,
                        yetkili: null,
                        sube_id: null,
                        mesai_baslangic: null,
                        mesai_bitis: null,
                        renk: null
                    },
                    editUnvan: {id: null, name: null, yetkili: null, departman_id: null},
                    editTatil: {id: null, name: null, baslangic: null, bitis: null},
                }
            },
            methods: {
                ChangeTab: function (e) {
                    this.activeTab = e.currentTarget.getAttribute('data-id');
                    localStorage.setItem('ayarlar_CurrentTab', e.currentTarget.getAttribute('data-id'));
                },
                SubeEkle: function () {
                    $('#modal-sube').modal('show');
                },
                SubeEkleForm: function () {
                    axios.post('{{route('Ayarlar.storeSube')}}', this.editSube)
                        .then(result => {
                            this.Subeler = result.data.Subeler;
                            $('#modal-sube').modal('hide');
                            this.editSube = {id: null, name: null, yetkili: null};
                        })
                        .catch(err => {
                            if (err.response.data.errors.name) {
                                $('#modal-sube #subeAdi').addClass('is-invalid').closest('div').find('.invalid-feedback').html(err.response.data.errors.name[0])
                            }
                        })
                },
                SubeDuzenle: function (sube) {
                    this.editSube = {id: sube.id, name: sube.name, yetkili: sube.yonetici};
                    $('#modal-sube').modal('show');
                },
                DepartmanEkle: function () {
                    $('#modal-departman').modal('show');
                },
                DepartmanEkleForm: function () {
                    axios.post('{{route('Ayarlar.storeDepartman')}}', this.editDepartman)
                        .then(result => {
                            this.Departmanlar = result.data.Departmanlar;
                            $('#modal-departman').modal('hide');
                            this.editDepartman = {
                                id: null,
                                name: null,
                                yetkili: null,
                                sube_id: null,
                                mesai_baslangic: null,
                                mesai_bitis: null,
                                renk: null,
                                mesai: null,
                                mesai_pazartesi: null,
                                mesai_sali: null,
                                mesai_carsamba: null,
                                mesai_persembe: null,
                                mesai_cuma: null,

                            };
                        })
                        .catch(err => {
                            if (err.response.data.errors.name) {
                                $('#modal-departman #subeAdi').addClass('is-invalid').closest('div').find('.invalid-feedback').html(err.response.data.errors.name[0])
                            }
                        })
                },
                DepartmanDuzenle: function (item) {
                    // console.log(item);
                    this.editDepartman = {
                        id: item.id,
                        name: item.name,
                        yetkili: item.yonetici,
                        sube_id: item.sube_id,
                        mesai_baslangic: item.mesai_baslangic,
                        mesai_bitis: item.mesai_bitis,
                        renk: item.renk,
                        mesai: item.mesai,
                        mesai_pazartesi: item.mesai.Pazartesi,
                        mesai_sali: item.mesai.Sali,
                        mesai_carsamba: item.mesai.Carsamba,
                        mesai_persembe: item.mesai.Persembe,
                        mesai_cuma: item.mesai.Cuma,
                    };
                    $('#modal-departman').modal('show');
                },
                UnvanEkle: function () {
                    $('#modal-unvan').modal('show');
                },
                UnvanEkleForm: function () {

                    axios.post('{{route('Ayarlar.storeUnvan')}}', this.editUnvan)
                        .then(result => {
                            this.Unvanlar = result.data.Unvanlar;
                            $('#modal-unvan').modal('hide');
                            this.editUnvan = {id: null, name: null, yetkili: null, departman_id: null};
                        })
                        .catch(err => {
                            if (err.response.data.errors.name) {
                                $('#modal-unvan #subeAdi').addClass('is-invalid').closest('div').find('.invalid-feedback').html(err.response.data.errors.name[0])
                            }
                        })
                },
                UnvanDuzenle: function (item) {
                    this.editUnvan = {id: item.id, name: item.name, yetkili: item.yonetici};
                    $('#modal-unvan').modal('show');
                },
                saveTatil: function (){
                    axios.post("{{ route('Ayarlar.storeTatil') }}", this.editTatil)
                        .then(result => {
                            this.Tatiller = result.data.Tatiller;
                            this.editTatil = {id: null, name: null, baslangic: null, bitis: null};
                        })
                },
                resetTatil: function (){
                    this.editTatil = {id: null, name: null, baslangic: null, bitis: null};
                },
                TatilDuzenle(item){
                    this.editTatil = {id: item.id, name: item.name, baslangic: this.Tarih(item.baslangic, 'YYYY-MM-DD'), bitis: this.Tarih(item.bitis, 'YYYY-MM-DD')};;
                },
                Tarih(tarih, format){
                    return moment(tarih).format(format);
                }
            },
            mounted() {
                var cur = localStorage.getItem('ayarlar_CurrentTab');
                this.activeTab = cur || 'sistem';
                this.loaded = true;
            },
            watch: {
                activeTab: function (newValue, oldValue) {
                    if (newValue == 'sirket') {
                        this.subeler = [];
                        this.loaded = false;
                        axios.get("{{route('Ayarlar.getSirket')}}")
                            .then(result => {
                                this.Subeler = result.data.Subeler;
                                this.Departmanlar = result.data.Departmanlar;
                                this.Calisanlar = result.data.Calisanlar;
                                this.Unvanlar = result.data.Unvanlar;
                                this.loaded = true;
                            });
                        console.log("Çalışanlar", this.Subeler);
                    }
                    if(newValue == 'tatil') {
                        this.tatiller = [];
                        this.loaded = false;
                        axios.get("{{ route('Ayarlar.getTatil') }}")
                            .then(result => {
                                this.Tatiller = result.data.Tatiller;
                                this.loaded = true;
                            });
                    }
                }
            }
        }
        Vue.createApp(Ayarlar).mount('#ayarlar');
    </script>
@endsection
@section('customCSS')

@endsection
