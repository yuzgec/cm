@extends('master')
@section('title', 'Ödeme Al | '.config('app.name'))
@section('customCSS')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
    
@endsection
@section('content')
    <div class="col-6 card bg-white justify-content-center  p-3">
        <div>
            <h3>{{ @$res['Sonuc_Str'] }}</h3> 
        </div>
        <div class="card-body">
            <form action="{{ route('odemeal')}}" class="card card-md" method="POST">
                @csrf
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Online Ödeme Ekranı</h2>

                    <div class="form-group">
                        <label for="singin-email-2">Dosya No</label>
                        <input type="text" name="dosyaNo" class="form-control mb-2" placeholder="Dosya NO" value="{{old('dosyaNo')}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="singin-email-2">Borçlu Ad Soyad</label>
                        <input type="text" name="adSoyad" class="form-control mb-2" placeholder="Borçlu Ad Soyad" value="{{old('adSoyad')}}">
                    </div>

                    <div class="form-group">
                        <label for="singin-email-2">Borçlu TC Kimlik No</label>
                        <input type="text" name="tcKimlikNo" class="form-control mb-2" placeholder="Ödeme Alınacak Tutar" value="{{old('tcKimlikNo')}}">
                    </div>

                    <div class="form-group">
                        <label for="singin-email-2">Ödeme Alınacak Tutar *</label>
                        <input type="number" name="tutar" class="form-control mb-2" placeholder="Ödeme Alınacak Tutar" value="{{old('tutar')}}">
                    </div>

                    <div class="form-group">
                        <label for="singin-email-2">İsim Soyisim *</label>
                        <input type="text" name="adsoyad" class="form-control mb-2" placeholder="Kart Üzerinde Yazan İsim Soyisim" value="{{old('adsoyad')}}">
                    </div>

                    <div class="form-group">
                        <label for="singin-email-2">Kart Numarası *</label>
                        <input type="text" name="kartno" class="form-control mb-2" placeholder="Kart Üzerinde Yazan İsim Soyisim" value="{{old('kartno')}}">
                    </div>

                    <div class="form-group d-flex justify-content-between">
                        <div class="col-5">

                            <label for="singin-email-2">Kart Son Kullanma Yıl *</label>

            
                            <select class="form-select" name="kartay">
                                <option value="" disabled>Kart Son Kullanma Ay</option>
                                <option value="01">01</option>
                                <option value="01">02</option>
                                <option value="01">03</option>
                                <option value="01">04</option>
                                <option value="01">05</option>
                                <option value="01">06</option>
                                <option value="01">07</option>
                                <option value="01">08</option>
                                <option value="01">09</option>
                                <option value="01">10</option>
                                <option value="01">11</option>
                                <option value="01">12</option>
                            </select>
                        
                        </div>
                        <div class="col-5">
                            <label for="singin-email-2">Kart Son Kullanma Yıl *</label>
                            <select class="form-select" name="kartyil">
                                <option value="" disabled>Kart Son Kullanma Yıl</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <option value="2031">2031</option>
                                <option value="2032">2032</option>
                                <option value="2033">2033</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="singin-email-2">Kart CVC *</label>
                        <input type="text" name="cvc" class="form-control mb-2" placeholder="Kart CVC No" value="{{old('cvc')}}">
                    </div>

                    <div class="form-group">
                        <label for="singin-email-2">Ödeme Notu *</label>
                        <textarea type="text" name="aciklama" class="form-control mb-2" placeholder="Ödeme Notu" value="{{old('aciklama')}}"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Ödemeyi Gerçekleştir</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-6 card bg-white justify-content-center p-3">
         <h5 class="card-title mt-3">Son Alınan Ödemeler - <b>Toplam 12.458,50</b></h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Dosya No</th>
                            <th>Ad Soyad</th>
                            <th>Tutar</th>
                            <th>Tarih</th>
                            <th>Durumu</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="text-muted">
                                    111111
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    Ahmet Yılmaz
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    1450,00
                                </div>
                            </td>

                          
                          
                            <td>
                                <div class="text-muted">
                                    22.11.2021 13:48
                                </div>
                            </td>

                            <td>
                                <div class="">
                                    <span class="badge badge-danger"> Başarılı</span>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <div class="text-muted">
                                    111111
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    Ahmet Yılmaz
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    1450,00
                                </div>
                            </td>

                          
                          
                            <td>
                                <div class="text-muted">
                                    22.11.2021 13:48
                                </div>
                            </td>

                            <td>
                                <div class="">
                                    <span class="badge badge-danger"> Başarılı</span>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <div class="text-muted">
                                    111111
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    Ahmet Yılmaz
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    1450,00
                                </div>
                            </td>

                          
                          
                            <td>
                                <div class="text-muted">
                                    22.11.2021 13:48
                                </div>
                            </td>

                            <td>
                                <div class="">
                                    <span class="badge badge-danger"> Başarılı</span>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <div class="text-muted">
                                    111111
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    Ahmet Yılmaz
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    1450,00
                                </div>
                            </td>

                          
                          
                            <td>
                                <div class="text-muted">
                                    22.11.2021 13:48
                                </div>
                            </td>

                            <td>
                                <div class="">
                                    <span class="badge badge-danger"> Başarılı</span>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <div class="text-muted">
                                    111111
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    Ahmet Yılmaz
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    1450,00
                                </div>
                            </td>

                          
                          
                            <td>
                                <div class="text-muted">
                                    22.11.2021 13:48
                                </div>
                            </td>

                            <td>
                                <div class="">
                                    <span class="badge badge-danger"> Başarılı</span>
                                </div>
                            </td>
                        </tr> 
                        
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
