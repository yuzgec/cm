@extends('master')
@section('title', $personel->adsoyad.' | Personel Detay')
@section('content')
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="cart-title">{{ $personel->adsoyad.' - ' .$personel->remote_id }} </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Mesai Giriş</th>
                                        <th>Mesai Çıkış</th>
                                        <th></th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($monitoring as $item)
                                    <tr>
                                       
                                        <td>
                                            <div class="text-muted">
                                                
                                                @if($item->TerminalID == 3 )
                                                   <span class="badge bg-success"> Giriş Yaptı</span>
                                                @else
                                                <span class="badge bg-danger">  Çıkış Yaptı</span>

                                                   
                                                @endif
                                            </div>
                                        </td>
                                           
                                        <td>
                                            <div class="text-muted">
                                                @if ($loop->iteration)
                                                    @if($item->TerminalID == 3 )
                                                        {{ $item->Eventtime}}
                                                    @else
                                                        {{ $item->Eventtime}}
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                      
                                    </tr>

                                </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $monitoring->appends(['sort' => 'mesai'])->links() }}
                    </div>

                  
                </div>
             
            </div>
        </div>
    </div>
@endsection
