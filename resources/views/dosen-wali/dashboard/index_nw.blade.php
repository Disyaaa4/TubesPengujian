@extends('layout.app_nw')

@section('title', 'Dashboard Dosen Wali - COMPASS')
@section('headerTitle', 'Dashboard Dosen Wali')

@vite('resources/css/dashboard.css')

@section('styles')
<style>
    .dw-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        margin-top: 28px;
    }
    .dw-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .dw-card h3 {
        font-size: 16px;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #EAEAEA;
    }
    .status-table {
        width: 100%;
        border-collapse: collapse;
    }
    .status-table th, .status-table td {
        padding: 12px 8px;
        text-align: left;
        border-bottom: 1px solid #F0F0F0;
        font-size: 14px;
    }
    .status-table th {
        color: #888;
        font-weight: 600;
    }
    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge.lengkap { background: #E8F5E9; color: #2E7D32; }
    .badge.sebagian { background: #FFF3E0; color: #EF6C00; }
    .badge.belum { background: #FFEBEE; color: #C62828; }
    
    .history-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .history-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #F0F0F0;
    }
    .history-icon {
        background: #E3F2FD;
        color: #1565C0;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
    }
    .history-details p {
        margin: 0 0 4px 0;
        font-size: 14px;
        color: #333;
    }
    .history-details span {
        font-size: 12px;
        color: #888;
    }
</style>
@endsection

@section('content')
<main class="dashboard-inner">
    <div class="dashboard-top">
        <p class="overview-title">Overview Perwalian</p>
        <p class="period-text">Tahun : 2425/1 Genap</p>
    </div>

    <div class="stat-grid" style="grid-template-columns: 1fr 1fr 1fr; gap: 30px;">
        <div class="stat-card">
            <p style="font-size: 20px; color: #555;">Mahasiswa Perwalian</p>
            <h2>{{ $totalMahasiswa }}</h2>
        </div>
        <div class="stat-card">
            <p style="font-size: 20px; color: #555;">Rata-rata PLO</p>
            <h2>{{ $rataRataPlo }}%</h2>
        </div>
        <div class="stat-card" style="background: #FFEBEB;">
            <p style="font-size: 20px; color: #D32F2F;">PLO Rendah (<60)</p>
            <h2 style="color: #D32F2F;">{{ $totalPloRendah }}</h2>
        </div>
    </div>

    <div class="chart-card" style="margin-top: 28px;">
        <h3>Rata-Rata PLO Mahasiswa Perwalian</h3>
        <div class="chart-area">
            <div class="y-axis">
                <span>100%</span>
                <span>75%</span>
                <span>50%</span>
                <span>25%</span>
                <span>0</span>
            </div>
            <div class="bar-area" style="justify-content: flex-start; gap: 40px; padding-left: 20px;">
                @forelse ($chartData as $bar)
                    <div class="bar-item">
                        <div
                            class="bar"
                            style="height: {{ $bar['value'] }}%; background: {{ $bar['color'] }};"
                            title="{{ $bar['value'] }}%"
                        ></div>
                        <span>{{ $bar['label'] }}</span>
                    </div>
                @empty
                    <div style="width: 100%; text-align: center; color: #888; align-self: center;">Belum ada data nilai PLO.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="dw-grid">
        <div class="dw-card">
            <h3>Status Kelengkapan Nilai Mahasiswa</h3>
            <table class="status-table">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Progress</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($studentStatuses as $status)
                    <tr>
                        <td>{{ $status['nim'] }}</td>
                        <td>{{ $status['nama'] }}</td>
                        <td style="min-width: 100px;">
                            <div style="background: #E0E0E0; border-radius: 4px; height: 8px; width: 100%; margin-top: 4px;">
                                <div style="background: #3498DB; height: 100%; border-radius: 4px; width: {{ $status['progress'] }}%;"></div>
                            </div>
                            <span style="font-size: 11px; color: #666;">{{ $status['progress'] }}%</span>
                        </td>
                        <td>
                            @if($status['status'] == 'Lengkap')
                                <span class="badge lengkap">Lengkap</span>
                            @elseif($status['status'] == 'Sebagian')
                                <span class="badge sebagian">Sebagian</span>
                            @else
                                <span class="badge belum">Belum Ada</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Belum ada mahasiswa perwalian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="dw-card">
            <h3>Histori Aktivitas Terbaru</h3>
            <ul class="history-list">
                @forelse($recentActivities as $activity)
                    <li class="history-item">
                        <div class="history-icon">✓</div>
                        <div class="history-details">
                            <p><strong>Update Nilai</strong>: {{ $activity->mahasiswa->nama }}</p>
                            <span>{{ $activity->assessmentTool->nama_at ?? 'AT' }} - Score: <strong>{{ $activity->score }}</strong></span><br>
                            <span style="font-size: 10px;">{{ $activity->updated_at->diffForHumans() }}</span>
                        </div>
                    </li>
                @empty
                    <li style="color: #888; text-align: center; padding: 20px 0;">Belum ada aktivitas.</li>
                @endforelse
            </ul>
        </div>
    </div>
</main>
@endsection
