@extends('layout.app_nw')

@section('title', 'Dashboard Admin - COMPASS')
@section('headerTitle', 'Dashboard Admin')

@vite('resources/css/dashboard.css')

@section('content')
<main class="dashboard-inner">
    <div class="dashboard-top">
        <p class="overview-title">Overview Admin</p>
        <p class="period-text">Sistem Utama COMPASS</p>
    </div>

    <div class="stat-grid" style="grid-template-columns: 1fr 1fr; gap: 40px;">
        <div class="stat-card">
            <p style="font-size: 24px; color: #555;">Total User</p>
            <h2>150</h2>
        </div>
        <div class="stat-card">
            <p style="font-size: 24px; color: #555;">Total Mahasiswa</p>
            <h2>1,200</h2>
        </div>
        <div class="stat-card">
            <p style="font-size: 24px; color: #555;">Total Mata Kuliah</p>
            <h2>80</h2>
        </div>
        <div class="stat-card">
            <p style="font-size: 24px; color: #555;">Total Data PLO</p>
            <h2>12</h2>
        </div>
    </div>

    <div class="chart-card">
        <h3>Informasi Sistem</h3>
        <p style="color: #444; font-size: 16px; line-height: 1.6;">
            Selamat datang di Dashboard Admin. Anda dapat mengelola data master sistem COMPASS melalui menu di sidebar. 
            Pastikan seluruh data User, Mahasiswa, Mata Kuliah, dan PLO/CLO selalu up-to-date untuk menunjang proses perhitungan nilai yang akurat.
        </p>
    </div>
</main>
@endsection
