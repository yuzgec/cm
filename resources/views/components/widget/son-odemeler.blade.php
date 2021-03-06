@can('Ödeme Al')
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <div>
                    <h3 class="card-title">Son Alınan Ödemeler</h3>
                </div>
                <div>
                    {{ $OdemeListesi->appends(['listele' => 'odeme'])->links() }}
                </div>


            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th class="w-1">Dosya No.
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-dark icon-thick" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <polyline points="6 15 12 9 18 15"/>
                            </svg>
                        </th>
                        <th>Ad Soyad</th>
                        <th>Ödeme Tutarı</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($OdemeListesi as $item)
                        <tr>
                            <td><span class="text-muted">{{ $item->dosya_no }}</span></td>
                            <td><a href="{{route('dashboard.index')}}" class="text-reset"
                                   tabindex="-1">{{ $item->ad_soyad }}</a></td>
                            <td>
                                {{ $item->odeme_tutari }}
                            </td>

                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                <span
                                    class="badge bg-{{ ($item->odeme_cevap == 1 ) ? 'success' : 'danger' }} me-1"></span> {{ ($item->odeme_cevap == 1 ) ? 'Başarılı' : 'Başarısız' }}
                            </td>
                            <td class="text-end">
                                <button class="btn align-text-top">Görüntüle</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endcan
