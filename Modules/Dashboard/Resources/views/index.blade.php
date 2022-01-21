@extends('master')
@section('content')
    {{-- Toplam Ödemeler --}}
    <x-widget-toplamodemeler />
    {{-- Çağrı Durumu --}}
    <x-widget-cagridurumu />
    {{-- Dosya Sayısı --}}
    <x-widget-dosyasayisi />
    {{-- İzin Bilgilerim --}}
    <x-widget-izinbilgilerim />
    {{-- İzin Talepleri --}}
    <x-widget-izintalepleri />
    {{-- Avans Talepleri --}}
    <x-widget-avanstalepleri />
    {{-- Avans Taleplerim --}}
    <x-widget-avanstaleplerim />
    {{-- Mesailerim --}}
    <x-widget-mesaibilgileri />
    {{-- Yaklaşan Doğum Günleri --}}
    <x-widget-dogumgunleri />
    {{-- Son Ödemeler --}}
    <x-widget-sonodemeler />
@endsection
