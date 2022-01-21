@can('Ödeme Al')
    {{-- Ödeme --}}
    <div class="col-sm-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Ödeme</div>
                    <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">Bugün</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#">Bugün</a>
                                <a class="dropdown-item" href="#">Dün</a>
                                <a class="dropdown-item" href="#">Son 1 Hafta</a>
                                <a class="dropdown-item" href="#">Son 1 Ay</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h1 mb-3">{{number_format($GunlukToplam,2,".",",")}} ₺</div>

                <div class="progress progress-sm">
                    <div class="progress-bar bg-blue"
                         style="width: 100%"
                         role="progressbar"
                         aria-valuenow="100"
                         aria-valuemin="0"
                         aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan
