<div class="col-4">
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><circle cx="18" cy="18" r="4" /><path d="M15 3v4" /><path d="M7 3v4" /><path d="M3 11h16" /><path d="M18 16.496v1.504l1 1" /></svg>
                Aylık Mesai Bilgileri ({{ \Carbon\Carbon::now()->startOfMonth()->format('d') . " - " .
\Carbon\Carbon::now()->endOfMonth()->format('d')." " .
 \Carbon\Carbon::now()->startOfMonth()->translatedFormat('F')}})
            </h3>
        </div>
        <div class="list-group list-group-flush list-group-hoverable">
            <div class="list-group-item">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col">Fazla Mesai : </div>
                    <div class="col">{{@$FazlaMesai->mesai | 0}} dk.</div>
                </div>
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col">Geç Giriş : </div>
                    <div class="col">{{@$FazlaMesai->gec | 0}} dk.</div>
                </div>
                <div class="row">
                    <div class="col mt-2">
                        <a href="{{route('profil.mesailerim')}}" class="">Günlük Görüntüle</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
