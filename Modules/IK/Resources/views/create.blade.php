@extends('master')
@section('content')
    {{Form::open(['route' => 'IK.store'])}}
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Personel Ekle</h3>
            <button class="btn btn-primary btn-sm">Kaydet</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="form-group mb-3 p-4 text-center">
                            <label class="form-label">Personel Resmi</label>
                            <span class="avatar avatar-xl mb-3 avatar-rounded"></span>
                            <p class="text-muted"><i><sup>Personel Resmi personeli kaydettikten sonra aktif olacaktır.</sup></i></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
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
                                    <x-form-date label="Sözleşme Bitiş Tarihi" name="pb[sozleme_bitis_tarihi]" class="form-control" disabled="disabled"/>
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
    </div>
    {{Form::close()}}
@endsection
