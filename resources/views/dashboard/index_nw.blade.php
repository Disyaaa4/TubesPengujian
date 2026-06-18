@extends('layout.app_nw')

@section('title', 'Dashboard - COMPASS')
@section('headerTitle', 'Dashboard Perhitungan PLO')

@vite('resources/css/dashboard.css')

@section('content')
        <main class="dashboard-inner">
            <div class="dashboard-top">
                <p class="overview-title">Overview</p>
                <p class="period-text">Tahun : 2425/1 Genap⌄</p>
            </div>

            <div class="stat-grid">
                <div class="stat-card">
                    <p>Total Mahasiswa</p>
                    <h2>150</h2>
                </div>

                <div class="stat-card">
                    <p>Rata-Rata Ketercapaian PLO%</p>
                    <h2>53,6%</h2>
                </div>
            </div>

            <div class="chart-card">
                <h3>Ketercapaian PLO Angkatan 2024</h3>

                <div class="chart-area">
                    <div class="y-axis">
                        <span>30%</span>
                        <span>20%</span>
                        <span>10%</span>
                        <span>0</span>
                    </div>

                    <div class="bar-area">
                        @php
                            $ploBars = [
                                ['label' => 'PLO 1', 'value' => 38, 'color' => '#A9C7F5'],
                                ['label' => 'PLO 2', 'value' => 70, 'color' => '#5FE4D7'],
                                ['label' => 'PLO 3', 'value' => 48, 'color' => '#000000'],
                                ['label' => 'PLO 4', 'value' => 78, 'color' => '#69B5FF'],
                                ['label' => 'PLO 5', 'value' => 82, 'color' => '#000000'],
                                ['label' => 'PLO 6', 'value' => 82, 'color' => '#000000'],
                                ['label' => 'PLO 7', 'value' => 82, 'color' => '#000000'],
                                ['label' => 'PLO 8', 'value' => 82, 'color' => '#000000'],
                                ['label' => 'PLO 9', 'value' => 82, 'color' => '#000000'],
                                ['label' => 'PLO 10', 'value' => 82, 'color' => '#000000'],
                            ];
                        @endphp

                        @foreach ($ploBars as $bar)
                            <div class="bar-item">
                                <div
                                    class="bar"
                                    style="height: {{ $bar['value'] }}%; background: {{ $bar['color'] }};"
                                ></div>
                                <span>{{ $bar['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="plo-table-card">
                <h3>Hasil Perolehan Nilai Program Outcomes Learning (PLO)</h3>

                <table>
                    <thead>
                        <tr>
                            <th>PLO</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PLO 1 [PLO01]</td>
                            <td>67.02</td>
                        </tr>
                        <tr>
                            <td>PLO 2 [PLO02]</td>
                            <td>58.12</td>
                        </tr>
                        <tr>
                            <td>PLO 3 [PLO03]</td>
                            <td>53.27</td>
                        </tr>
                        <tr>
                            <td>PLO 4 [PLO04]</td>
                            <td>65.82</td>
                        </tr>
                        <tr>
                            <td>PLO 5 [PLO05]</td>
                            <td>72.15</td>
                        </tr>
                        <tr>
                            <td>PLO 6 [PLO06]</td>
                            <td>87.40</td>
                        </tr>
                        <tr>
                            <td>PLO 7 [PLO07]</td>
                            <td>90.12</td>
                        </tr>
                        <tr>
                            <td>PLO 8 [PLO08]</td>
                            <td>84.27</td>
                        </tr>
                        <tr>
                            <td>PLO 9 [PLO09]</td>
                            <td>92.82</td>
                        </tr>
                        <tr>
                            <td>PLO 10 [PLO10]</td>
                            <td>88.15</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
@endsection
