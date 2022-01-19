@extends('master')
@section('content')
    <div id="ayarlar">
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="tabnav">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item" v-bind:class="activeTab == 'sistem' ? 'active': ''"><a href="javascript:;" class="nav-link" v-on:click="ChangeTab" data-id="sistem"><span class="nav-link-title">Sistem Ayarları</span></a></li>
                            <li class="nav-item" v-bind:class="activeTab == 'sirket' ? 'active': ''"><a href="javascript:;" class="nav-link" v-on:click="ChangeTab" data-id="sirket"><span class="nav-link-title">Şirket Bilgileri</span></a></li>
                            <li class="nav-item" v-bind:class="activeTab == 'kural' ? 'active': ''"><a href="javascript:;" class="nav-link" v-on:click="ChangeTab" data-id="kural"><span class="nav-link-title">Kural Yönetimi</span></a></li>
                            <li class="nav-item" v-bind:class="activeTab == 'tatil' ? 'active': ''"><a href="javascript:;" class="nav-link" v-on:click="ChangeTab" data-id="tatil"><span class="nav-link-title">Tatil Takvimi</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="content mt-4" id="content">
            <div v-if="loaded">
                <div class="row" v-if="activeTab == 'sistem'" style="display: none" v-show="activeTab == 'sistem'">Sistem</div>
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
                                                <a href="javascript:;" v-on:click="SubeDuzenle(sube)"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>
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
                                    <button class="btn btn-sm btn-primary" v-on:click="DepartmanEkle">Departman Ekle</button>
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
                                            <td class="d-flex align-items-center gap-2"><div class="avatar avatar-sm text-white" v-bind:style="{ backgroundColor: item.renk }">B</div><span v-html="item.name"></span></td>
                                            <td><span v-html="item.yonetici ? item.yetkili.name + ' ' + item.yetkili.last_name : null"></span></td>
                                            <td><span v-html="item.sube_id ? item.sube.name : null"></span></td>
                                            <td><span v-html="item.calisan"></span></td>
                                            <td>
                                                <a href="javascript:;" v-on:click="DepartmanDuzenle(item)"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>
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
                                                <a href="javascript:;" v-on:click="UnvanDuzenle(item)"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="activeTab == 'kural'" style="display: none" v-show="activeTab == 'kural'">Kural</div>
                <div class="row" v-if="activeTab == 'tatil'" style="display: none" v-show="activeTab == 'tatil'">Tatil</div>
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
                        <button type="button" class="btn btn-primary" v-on:click="SubeEkleForm" v-html="editSube.id > 0 ? 'Şube Güncelle' : 'Şube Ekle'"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-departman" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-html="editDepartman.id > 0 ? 'Departman Düzenle':'Departman Ekle'"></h5>
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
                            <div class="col-4">
                                <label class="form-label">Mesai Başlangıç</label>
                                <input type="time" class="form-control" v-model="editDepartman.mesai_baslangic">
                            </div>
                            <div class="col-4">
                                <label class="form-label">Mesai Bitiş</label>
                                <input type="time" class="form-control" v-model="editDepartman.mesai_bitis">
                            </div>
                            <div class="col-4">
                                <label class="form-label">Renk</label>
                                <input type="color" class="form-control" v-model="editDepartman.renk">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">İptal</button>
                        <button type="button" class="btn btn-primary" v-on:click="DepartmanEkleForm" v-html="editDepartman.id > 0 ? 'Departman Güncelle' : 'Departman Ekle'"></button>
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
                        <button type="button" class="btn btn-primary" v-on:click="UnvanEkleForm" v-html="editUnvan.id > 0 ? 'Ünvan Güncelle' : 'Ünvan Ekle'"></button>
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
                    editSube: {id: null, name: null, yetkili: null},
                    editDepartman: {id: null, name: null, yetkili: null, sube_id: null, mesai_baslangic: null, mesai_bitis: null, renk: null},
                    editUnvan: {id: null, name: null, yetkili: null, departman_id: null},
                }
            },
            methods: {
                ChangeTab: function(e){
                    this.activeTab = e.currentTarget.getAttribute('data-id');
                    localStorage.setItem('ayarlar_CurrentTab', e.currentTarget.getAttribute('data-id'));
                },
                SubeEkle: function (){
                    $('#modal-sube').modal('show');
                },
                SubeEkleForm: function (){
                    axios.post('{{route('Ayarlar.storeSube')}}', this.editSube)
                    .then(result => {
                        this.Subeler = result.data.Subeler;
                        $('#modal-sube').modal('hide');
                        this.editSube = {id: null, name: null, yetkili: null};
                    })
                    .catch(err => {
                        if(err.response.data.errors.name){
                            $('#modal-sube #subeAdi').addClass('is-invalid').closest('div').find('.invalid-feedback').html(err.response.data.errors.name[0])
                        }
                    })
                },
                SubeDuzenle: function (sube){
                    this.editSube =  {id: sube.id, name: sube.name, yetkili: sube.yonetici};
                    $('#modal-sube').modal('show');
                },
                DepartmanEkle: function (){
                    $('#modal-departman').modal('show');
                },
                DepartmanEkleForm: function (){
                    axios.post('{{route('Ayarlar.storeDepartman')}}', this.editDepartman)
                    .then(result => {
                        this.Departmanlar = result.data.Departmanlar;
                        $('#modal-departman').modal('hide');
                        this.editDepartman = {id: null, name: null, yetkili: null, sube_id: null, mesai_baslangic: null, mesai_bitis: null, renk: null};
                    })
                    .catch(err => {
                        if(err.response.data.errors.name){
                            $('#modal-departman #subeAdi').addClass('is-invalid').closest('div').find('.invalid-feedback').html(err.response.data.errors.name[0])
                        }
                    })
                },
                DepartmanDuzenle: function (item){
                    this.editDepartman =  {id: item.id, name: item.name, yetkili: item.yonetici, sube_id: item.sube_id, mesai_baslangic: item.mesai_baslangic, mesai_bitis: item.mesai_bitis, renk: item.renk};
                    $('#modal-departman').modal('show');
                },
                UnvanEkle: function (){
                    $('#modal-unvan').modal('show');
                },
                UnvanEkleForm: function (){
                    axios.post('{{route('Ayarlar.storeUnvan')}}', this.editUnvan)
                    .then(result => {
                        this.Unvanlar = result.data.Unvanlar;
                        $('#modal-unvan').modal('hide');
                        this.editUnvan = {id: null, name: null, yetkili: null, departman_id: null};
                    })
                    .catch(err => {
                        if(err.response.data.errors.name){
                            $('#modal-unvan #subeAdi').addClass('is-invalid').closest('div').find('.invalid-feedback').html(err.response.data.errors.name[0])
                        }
                    })
                },
                UnvanDuzenle: function (item){
                    this.editUnvan =  {id: item.id, name: item.name, yetkili: item.yonetici};
                    $('#modal-unvan').modal('show');
                },
            },
            mounted(){
                var cur = localStorage.getItem('ayarlar_CurrentTab');
                this.activeTab = cur || 'sistem';
                this.loaded = true;
            },
            watch: {
                activeTab: function (newValue, oldValue){
                    if(newValue == 'sirket'){
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
                }
            }
        }
        Vue.createApp(Ayarlar).mount('#ayarlar');
    </script>
@endsection
@section('customCSS')

@endsection
