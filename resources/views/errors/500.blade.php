@extends('master')
@section('title', '500 Sunucu Hatası')
@section('content')
    <div class="empty">
        <div class="empty-header">500</div>
        <p class="empty-title">Sunucu Hatası!</p>

        <div class="empty-action">
            <a href="{{ route('dashboard.index') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="5" y1="12" x2="19" y2="12" /><line x1="5" y1="12" x2="11" y2="18" /><line x1="5" y1="12" x2="11" y2="6" /></svg>
                Geri Dön
            </a>
        </div>
    </div>
@endsection
