<?php

namespace App\Http\Controllers;

use App\Models\Planing;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaningController extends Controller
{
    public function index()
    {
        $planings = Planing::with('kategori')->latest()->get();
        $kategoris = Kategori::all();

        return view('planings.index', compact('planings', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto' => 'nullable|array|max:5',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string|max:255',
            'budget' => 'required|integer|min:0',
            'tgl_kontak' => 'required|date',
            'status' => 'required|in:Sudah dihubungi,Belum dihubungi,Pertimbangan,Selesai',
        ]);

        // Handle multiple file uploads
        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $path = $foto->store('planing_photos', 'public');
                $fotoPaths[] = $path;
            }
        }

        // Gabungkan semua path foto dengan pemisah |
        $validated['foto'] = !empty($fotoPaths) ? implode('|', $fotoPaths) : null;

        Planing::create($validated);

        return redirect()->route('planings.index')->with('success', 'Rencana baru berhasil ditambahkan!');
    }

    public function update(Request $request, Planing $planing)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto' => 'nullable|array|max:5',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string|max:255',
            'budget' => 'required|integer|min:0',
            'tgl_kontak' => 'required|date',
            'status' => 'required|in:Sudah dihubungi,Belum dihubungi,Pertimbangan,Selesai',
        ]);

        // Handle existing and new photos
        $existingFotos = $request->input('existing_fotos', []);
        $newFotoPaths = [];

        // Process new uploaded photos
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $foto) {
                $path = $foto->store('planing_photos', 'public');
                $newFotoPaths[] = $path;
            }
        }

        // Combine existing and new photos
        $allFotoPaths = array_merge($existingFotos, $newFotoPaths);
        $validated['foto'] = !empty($allFotoPaths) ? implode('|', $allFotoPaths) : null;

        $planing->update($validated);

        return redirect()->route('planings.index')->with('success', 'Rencana berhasil diperbarui!');
    }

    public function destroy(Planing $planing)
    {
        // Hapus semua foto dari storage
        if ($planing->foto) {
            $fotoPaths = explode('|', $planing->foto);
            foreach ($fotoPaths as $fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
        }

        $planing->delete();

        return redirect()->route('planings.index')->with('success', 'Rencana berhasil dihapus!');
    }
    public function calendar()
    {
        return view('planings.calendar');
    }

    public function getEvents()
    {
        $events = Planing::with('kategori')
            ->select('id', 'judul as title', 'tgl_kontak as start', 'status', 'kategori_id')
            ->whereNotNull('tgl_kontak')
            ->get()
            ->map(function ($event) {
                // Tambahkan warna berdasarkan status
                $event->color = $this->getStatusColor($event->status);
                $event->url = route('planings.show', $event->id);
                $event->description = 'Kategori: ' . $event->kategori->nama;
                return $event;
            });

        return response()->json($events);
    }

    public function show(Planing $planing)
    {
        $planing->load('kategori');
        return view('planings.show', compact('planing'));
    }

    private function getStatusColor($status)
    {
        $colors = [
            'Belum dihubungi' => '#ffc107', // Kuning
            'Sudah dihubungi' => '#007bff', // Biru
            'Pertimbangan' => '#fd7e14',    // Orange
            'Selesai' => '#28a745'          // Hijau
        ];

        return $colors[$status] ?? '#6c757d'; // Default abu-abu
    }

    public function laporan()
    {
        $totalPlanning = Planing::count();

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

        $laporanKategori = Kategori::withCount('planings')
            ->with(['planings' => function ($query) {
                $query->select('kategori_id', 'status', 'budget');
            }])
            ->get()
            ->map(function ($kategori) {
                $totalKategori = $kategori->planings_count;
                $kategoriProgress = 0;

                $totalBudgetKategori = $kategori->planings->sum('budget');

                if ($totalKategori > 0) {
                    foreach ($kategori->planings as $planing) {
                        switch ($planing->status) {
                            case 'Selesai':
                                $kategoriProgress += 100;
                                break;
                            case 'Sudah dihubungi':
                                $kategoriProgress += 50;
                                break;
                            case 'Pertimbangan':
                                $kategoriProgress += 25;
                                break;
                            case 'Belum dihubungi':
                                $kategoriProgress += 0;
                                break;
                        }
                    }
                    $kategori->progress_percentage = $kategoriProgress / $totalKategori;
                } else {
                    $kategori->progress_percentage = 0;
                }

                $kategori->total_budget = $totalBudgetKategori;

                return $kategori;
            });

        $totalBudget = Planing::sum('budget');

        return view('planings.laporan', compact(
            'laporanKategori',
            'totalPlanning',
            'totalBudget',
            'planingPerStatus',
            'totalProgressPercentage'
        ));
    }
}
