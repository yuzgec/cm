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
            <form action="{{ route('odemeal')}}" id="odemeForm" class="card card-md" method="POST">
                @csrf
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Online Ödeme Ekranı</h2>
                    <div class="form-group mb-2">
                        <x-form-inputtext label="Dosya No" name="dosyaNo"/>
                    </div>
                    <div class="form-group mb-2">
                        <x-form-inputtext label="Borçlu Ad Soyad" name="adSoyad"/>
                    </div>
                    <div class="form-group mb-2">
                        <x-form-inputtext label="Borçlu TC Kimlik No" name="tcKimlikNo"/>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col-8">
                            <x-form-inputtext label="Kart ÜZerindeki İsim Soyisim *" name="adsoyad"/>
                        </div>
                        <div class="col-4">
                            <x-form-inputtext label="Ödeme Alınacak Tutar *" name="tutar"/>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <x-form-inputtext label="Kart Numarası *" name="kartno"/>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col-4">
                            <label class="form-label">Taksit Sayısı</label>
                            <select name="taksit" id="taksit" class="form-select">
                                    <option value="1">1 Taksit</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <label class="form-label">Komisyon</label>
                            <small id="hesaplanan_komisyon">Lütfen <strong>Turar</strong> ve <strong>Kart numarası</strong>  girin</small>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between mb-2">
                        <div class="col-5">
                            <label for="singin-email-2" class="form-label">Kart Son Kullanma Yıl *</label>
                            <select class="form-select" name="kartay">
                                <option value="" disabled>Kart Son Kullanma Ay</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>

                        </div>
                        <div class="col-5">
                            <label class="form-label" for="singin-email-2">Kart Son Kullanma Yıl *</label>
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
                    <div class="form-group  mb-2">
                        <x-form-inputtext label="Kart CVC *" name="cvc"/>
                    </div>
                    <div class="form-group  mb-2">
                        <label for="singin-email-2" class="form-label">Ödeme Notu *</label>
                        <textarea type="text" name="aciklama" class="form-control mb-2" placeholder="Ödeme Notu" value="{{old('aciklama')}}"></textarea>
                    </div>
                    <input type="hidden" name="oran" id="oran" value="">
                    <button type="submit" class="btn btn-primary btn-block">Ödemeyi Gerçekleştir</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-6 card bg-white justify-content-center p-3">
         <h5 class="card-title mt-3">Son Alınan Ödemeler - <b>Toplam {{ $gunluktoplam }}₺</b></h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Dosya No</th>
                            <th>Dekont Id</th>
                            <th>Ad Soyad</th>
                            <th>Tutar</th>
                            <th>Tarih</th>
                            <th>Durumu</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($odemegecmisi as $row)
                        <tr>
                            <td>
                                <div class="text-muted">
                                    {{$row->dosya_no}}
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    {{$row->dekont_id}}
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    {{$row->ad_soyad}}
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    {{$row->odeme_komisyon}}
                                </div>
                            </td>
                            <td>
                                <div class="text-muted">
                                    {{$row->created_at}}
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <span class="badge bg-{{( $row->odeme_cevap == 1 ) ? 'success' : 'danger'}}"> {{( $row->odeme_cevap == 1 ) ? 'Başarılı' : 'Başarısız'}}</span>
                                </div>
                            </td>
                        </tr>
                       @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-odeme" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-odeme" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">3D Güvenlik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <a href="{{route('odeme.index')}}" class="btn btn-primary" >Kapat</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJS')
    <script>
        var oranlar = null;
        $(document).ready(function (){
            $('#odemeForm').on('submit', function (e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    data: $(this).serialize(),
                    url: $(this).attr('action'),
                    success: function (result){
                        if(result.Success == true){
                            $('#modal-odeme').modal('show', {
                                backdrop: 'static',
                                keyboard: false
                            });
                            $('#modal-odeme .modal-body').html('<iframe src="'+result.URL+'" style="width: 100%;min-height: 400px;">');
                        }else{
                            alert('Lütfen aşağıdaki hataları giderin\n' + result.Errors);
                        }
                    }
                })
            });
            $("#odemeForm").on("hidden.bs.modal", function () {
                document.location = '{{route('odeme.index')}}'
            });
            $('#kartno').on('change', function (){
                var no = $(this).val();
                console.log(no);
                if(no.length == 16){
                    $.ajax({
                        type: 'POST',
                        data: 'cc=' + no +"&_token={{csrf_token()}}",
                        url: '/odeme/Oranlar',
                        success: function (result){
                            switch (result.Success) {
                                case true:
                                    oranlar = result.Oranlar;
                                    var tmp = '';
                                    $.each(oranlar, function (index, value){
                                        tmp = tmp + '<option value="'+value.Taksit+'">'+value.Taksit+' Taksit (%'+value.Oran.toFixed(2)+')</option>';
                                    })
                                    $('#taksit').html(tmp);
                                    OranHesapla();
                                    break;
                                case false:

                                    break;
                            }
                        }
                    })
                }
            })
            $('#taksit').on('change', function (e){
                OranHesapla();
                return;
                var kart = $('#kartno').val(),
                    taksit = $('#taksit').val();
                if(kart == "")
                    return;
                $.ajax({
                    type: 'POST',
                    data: 'cc=' + kart + "&taksit="+taksit+"&_token={{csrf_token()}}",
                    url: '/odeme/Oranlar',
                    success: function (result){
                        switch (result.Success) {
                            case true:

                                var oran = parseFloat(result.Oran),
                                    tutar = parseFloat($('#tutar').val());

                                var hesaplanan = (tutar * oran / 100);
                                $('#hesaplanan_komisyon').text(parseFloat(hesaplanan).toFixed(2) + ' ₺ (%' + oran.toFixed(2) +')');
                                break;
                            case false:

                                break;
                        }
                    }
                })
            });

        });
        function OranHesapla(){
            var Taksit = parseInt($('#taksit').val()),
                tutar = parseFloat($('#tutar').val());
            var oran = "";
            $.each(oranlar, function (index, value){
                if(value.Taksit === Taksit){
                    oran = value;
                }
            })
            $('#oran').val(oran.Oran);
            if(tutar > 0){
                var hesaplanan = (tutar * oran.Oran / 100);
                $('#hesaplanan_komisyon').text(parseFloat(hesaplanan).toFixed(2) + ' ₺ (%' + oran.Oran.toFixed(2) +')');
            }
        }
    </script>
@endsection
