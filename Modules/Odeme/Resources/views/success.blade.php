@extends('master')
@section('title', 'Ödeme Başarıyla Alındı | '.config('app.name'))
@section('customCSS')

   
@endsection

@section('content')
    <h3>{{ $request['TURKPOS_RETVAL_Sonuc_Str'] }}</h3>

    
@endsection