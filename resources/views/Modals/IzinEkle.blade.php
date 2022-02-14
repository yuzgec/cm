<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Izin Ekle - {{$Personel->full_name}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="get" action="javascript:;" id="izinEkleForm">
                <input type="hidden" name="user_id" value="{{$Personel->id}}">
                <div class="row">
                    <div class="col-8 mb-3">
                        <label class="form-label">İzin Türü</label>
                        <select class="form-select" name="izinTalep[tur]" id="izinTalep_tur">
                            <option value="1">Yıllık İzin</option>
                            <option value="2">Askerlik İzni</option>
                            <option value="3">Babalık İzni</option>
                            <option value="4">Doğum İzni</option>
                            <option value="5">Doğum Sonrası İzni</option>
                            <option value="6">Evlilik İzni</option>
                            <option value="7">Hastalık İzni</option>
                            <option value="8">İş Arama İzni</option>
                            <option value="9">Mazeret İzni</option>
                            <option value="10">Süt izni</option>
                            <option value="11">Ücretsiz İzin</option>
                            <option value="12">Vefat İzni</option>
                            <option value="13">Yol İzni</option>
                        </select>
                    </div>
                    <div class="col-4 mb-3">
                        <label class="form-label">Toplam</label>
                        <input type="text" class="form-control" disabled value="1 Gün" name="izinTalep[Gun]" id="izinTalep_gun">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Başlangıç Tarihi</label>
                        <div class="row">
                            <div class="col-8"><input type="date" name="izinTalep[baslangic_tarihi]" id="izinTalep_baslangic_tarihi" class="form-control" value="{{\Carbon\Carbon::now()->addDay()->format('Y-m-d')}}"></div>
                            <div class="col-4"><input type="time" name="izinTalep[baslangic_saati]" id="izinTalep_baslangic_saati" class="form-control" value="09:00"></div>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Bitiş Tarihi</label>
                        <div class="row">
                            <div class="col-8"><input type="date" name="izinTalep[bitis_tarihi]" id="izinTalep_bitis_tarihi" class="form-control" value="{{\Carbon\Carbon::now()->addDay()->format('Y-m-d')}}"></div>
                            <div class="col-4"><input type="time" name="izinTalep[bitis_saati]" id="izinTalep_bitis_saati" class="form-control" value="18:00"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="form-label">Açıklama <small>Opsiyonel</small></label>
                    <textarea class="form-control" name="izinTalep[aciklama]" id="izinTalep_aciklama"></textarea>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label">Yerine Bakacak Kişi <small>Opsiyonel</small></label>
                        <select class="form-select" name="izinTalep[yerine_bakacak]" id="izinTalep_yerine_bakacak">
                            <option value=""></option>
                            @foreach(\App\Models\User::all() as $Row)
                                @if($Row->id == auth()->user()->id)
                                    @continue
                                @endif
                                <option value="{{$Row->id}}">{{$Row->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Dönüş Tarihi</label>
                        <div class="row">
                            <div class="col-8"><input type="date" class="form-control" name="izinTalep[donus_tarihi]" id="izinTalep_donus_tarihi" value="{{\Carbon\Carbon::now()->addDays(2)->format('Y-m-d')}}"></div>
                            <div class="col-4"><input type="time" class="form-control" name="izinTalep[donus_saati]" id="izinTalep_donus_saati" value="09:00"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Kapat</button>
            <button type="button" class="btn btn-primary" id="btnIzinEkleSend">İzin Talep Et</button>
        </div>
    </div>
</div>
