<?php

namespace App\Http\Controllers;

use App\Models\Planing;
use App\Models\Kategori;
use App\Models\Tamu;
use App\Models\MS;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Count Data
        $totalKategori = Kategori::count();
        $totalPlanning = Planing::count();
        $totalTamu = Tamu::count();
        $totalMS = MS::count();

        // Data Planing
        $totalBudget = Planing::sum('budget');

        // Hitung progress overall untuk Planning
        $planingPerStatus = Planing::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->status => $item->total];
            });

        $totalProgressPercentage = 0;
        if ($totalPlanning > 0) {
            foreach ($planingPerStatus as $status => $count) {
                switch ($status) {
                    case 'Selesai':
                        $totalProgressPercentage += ($count * 100);
                        break;
                    case 'Sudah dihubungi':
                        $totalProgressPercentage += ($count * 50);
                        break;
                    case 'Pertimbangan':
                        $totalProgressPercentage += ($count * 25);
                        break;
                    case 'Belum dihubungi':
                        $totalProgressPercentage += ($count * 0);
                        break;
                }
            }
            $totalProgressPercentage = $totalProgressPercentage / $totalPlanning;
        }

        // Data Tamu
        $tamuSelesai = Tamu::where('status', 'Selesai')->count();
        $tamuProgress = $totalTamu > 0 ? ($tamuSelesai / $totalTamu) * 100 : 0;

        // Data Mahar Seserahan
        $msSelesai = MS::where('status', 'Selesai')->count();
        $msProgress = $totalMS > 0 ? ($msSelesai / $totalMS) * 100 : 0;

        // Recent Planings
        $recentPlanings = Planing::with('kategori')
            ->latest()
            ->take(5)
            ->get();

        // Status Distribution
        $statusDistribution = $planingPerStatus;

        return view('dashboard', compact(
            'totalKategori',
            'totalPlanning',
            'totalTamu',
            'totalMS',
            'totalBudget',
            'totalProgressPercentage',
            'tamuProgress',
            'msProgress',
            'recentPlanings',
            'statusDistribution'
        ));
    }
}
