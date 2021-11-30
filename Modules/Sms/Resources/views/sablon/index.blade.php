@extends('master')
@section('title', 'Sms Şablonları')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Şablon Adı</th>
                        <th>Şablon İçerik</th>
                        <th>Durum</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sms_sablon as $sablon)
                        <tr>
                            <td><span class="text-muted">{{$sablon->id}}</span></td>
                            <td>
                                {{$sablon->sms_sablon_adi}}
                            </td>
                            <td class="birsatir">
                                {{ substr($sablon->sms_sablon, 0 ,30)}}
                            </td>
                            <td class="birsatir">
                                {{$sablon->durum}}
                            </td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#silmeonayi{{ $sablon->id }}" class="btn btn-sm btn-square btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    Sil
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm btn-square" href="{{ route('smssablon.edit', $sablon->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                    Düzenle
                                </a>
                            </td>
                        </tr>

                        <div class="modal modal-blur fade" id="silmeonayi{{ $sablon->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Silme Onayı</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Silmek üzeresiniz. Bu işlem geri alınmamaktadır.
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>
                                            İptal Et
                                        </a>
                                        <form action="{{ route('smssablon.destroy', $sablon->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ms-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                Silmek İstiyorum
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('smssablon.store') }}" method="POST">
                     @csrf
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Sms Sablon Adı</label>
                        <div class="col">
                            <input type="text" class="form-control" name="sms_sablon_adi" placeholder="Sms Sablon Adı Giriniz...." value="{{ old('sms_sablon_adi') }}">
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Sms Şablonu</label>
                        <div class="col">
                            <textarea type="text" name="sms_sablon" class="form-control mesaj" rows="10">{{ old('sms_sablon') }}</textarea>
                            <div class="badge bg-success">
                                <span id="smssayisi">1</span>/<span id="smsboyut">5</span>
                            </div>
                            <small>1 SMS 160 Karakter İçermektedir.</small>
                        </div>
                    </div>


                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Durumu</label>
                        <div class="col">
                            <select class="form-select" name="durum">
                                <option value="" disabled>Durum Seçiniz...</option>
                                <option value="1">Aktif</option>
                                <option value="2">Pasif</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label"></label>
                        <div class="col">
                            <button class="btn btn-primary" type="submit">Kaydet</button>
                        </div>
                    </div>


                </form>


            </div>
        </div>
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
