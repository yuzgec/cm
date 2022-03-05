@extends('master')
@section('title', 'Toplu SMS Gönder')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <select name="smssablon" class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                    <option value="">Mesaj Şablonu Şeçiniz...</option>
                    @foreach($sms_sablon as $sablon)
                        <option value="{{ route('toplusmsgonder',['smssablon' => $sablon->id]) }}" {{ ($sablon->id == request('smssablon')) ? 'selected' : null}}>{{$sablon->sms_sablon_adi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-label mb-3">Mesaj İçeriği</div>
                    <textarea type="text" name="mesaj" class="form-control mesaj " rows="10">{{ @$secilen_sablon->sms_sablon }}</textarea>
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
                    <div class="mb-1">
                        <button class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" /></svg> Excel ile Yükle</button>
                        <button class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 11h6m-3 -3v6" /></svg>Kişi Seç</button>
                        <button class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>Grup Seç</button>
                    </div>
                    <textarea class="form-control" name="telefonno" rows="10"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
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

