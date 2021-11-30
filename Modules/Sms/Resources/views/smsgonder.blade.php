@extends('master')
@section('title', 'Tekli SMS Gönder')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <select name="smssablon" class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                    <option value="">Mesaj Şablonu Şeçiniz...</option>
                    @foreach($sms_sablon as $sablon)
                        <option value="{{ route('smsgonder',['smssablon' => $sablon->id]) }}" {{ ($sablon->id == request('smssablon')) ? 'selected' : null}}>{{$sablon->sms_sablon_adi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-label">Mesaj İçeriği</div>
                    <textarea type="text" name="mesaj" class="form-control mesaj" rows="10">{{ @$secilen_sablon->sms_sablon }}</textarea>
                </div>
                <div class="badge bg-success">
                    <span id="smssayisi">1</span>/<span id="smsboyut">5</span>
                </div>
                <small>1 SMS 160 Karakter İçermektedir.</small>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-label">Telefon Numaraları</div>
                    <textarea class="form-control" name="telefonno" rows="10"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <small>Biden çok göndermek için virgül ile ayırınız</small>
                    </div>
                    <div>
                        <select name="telefon" class="form-control">
                            <option value="">MECİTKAHRAMAN</option>
                            <option value="">Başlık 2</option>
                            <option value="">Başlık 3</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-label">Mesaj Sonu Metni</div>
                    <textarea type="text" name="mesaj" class="form-control" rows="3"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-2">
        <a href="#" class="btn btn-primary w-100">
            Mesajı Gönder
        </a>
    </div>
@endsection
@section('customJS')
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script>
        const mesajsayisi = 1;
        const maxLength = 5;
        $('.mesaj').keyup(function() {
            const textlen = maxLength + $(this).val().length;
            $('#smsboyut').text(textlen);
            if(textlen >= 160){
                $('#smssayisi').text(mesajsayisi+1);
            }
            if(textlen >= 320){
                $('#smssayisi').text(mesajsayisi+2);
            }
        });

    </script>
@endsection
