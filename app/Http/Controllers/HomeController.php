<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Data converted from client/pages/Index.tsx
        $ploData = [
            ['label' => 'PLO 1 [PLO01]', 'value' => 67.02, 'color' => '#A0BCE8'],
            ['label' => 'PLO 2 [PLO02]', 'value' => 58.12, 'color' => '#6BE6D3'],
            ['label' => 'PLO 3 [PLO03]', 'value' => 53.27, 'color' => '#000000'],
            ['label' => 'PLO 4 [PLO04]', 'value' => 65.82, 'color' => '#7DBBFF'],
            ['label' => 'PLO 5 [PLO05]', 'value' => 52.68, 'color' => '#000000'],
            ['label' => 'PLO 6 [PLO06]', 'value' => 56.44, 'color' => '#000000'],
            ['label' => 'PLO 7 [PLO07]', 'value' => 33.39, 'color' => '#000000'],
            ['label' => 'PLO 8 [PLO08]', 'value' => 68.0, 'color' => '#000000'],
            ['label' => 'PLO 9 [PLO09]', 'value' => 65.89, 'color' => '#000000'],
            ['label' => 'PLO 10 [PLO010]', 'value' => 65.89, 'color' => '#000000'],
        ];

        $navItems = [
            ['label' => 'Dashboard', 'active' => true],
            ['label' => 'Nilai', 'active' => false],
            ['label' => 'Mata Kuliah', 'active' => false],
            ['label' => 'RPS', 'active' => false],
        ];

        $chartMax = 100;
        $yAxisTicks = [75, 50, 25, 0];

        $user = auth()->user();

        return view('dashboard.index_nw', compact('ploData', 'navItems', 'chartMax', 'yAxisTicks', 'user'));
    }
}
