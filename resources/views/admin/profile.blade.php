@extends('layouts.admin') {{-- Pastikan kamu punya layouts/admin.blade.php --}}

@section('title', 'Profil Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/adminprofil.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('js/app.js') }}"></script>
@endpush
@section('content')
<div class="profile-container">
    <h1>Profil Admin</h1>
    <div class="profile-card">
        {{-- <div class="profile-avatar">
            <img src="{{ asset('image/sakupaleza-1.jpg') }}" alt="Admin Avatar">
        </div> --}}
        <div class="profile-info">
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Role:</strong> Administrator</p>
        </div>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn-back">← Kembali ke Dashboard</a>
</div>
@endsection

