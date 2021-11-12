@extends('master')
@section('title', 'Ödeme Alınamadı | '.config('app.name'))
@section('customCSS')


@endsection

@section('content')
    <h3>{{ $res['Sonuc_Str'] }}</h3>
    
@endsection