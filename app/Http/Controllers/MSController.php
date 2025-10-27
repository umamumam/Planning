<?php

namespace App\Http\Controllers;

use App\Models\MS;
use Illuminate\Http\Request;

class MSController extends Controller
{
    public function index()
    {
        $ms = MS::latest()->get();
        return view('ms.index', compact('ms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:mahar,seserahan',
            'nama' => 'required|string|max:100',
            'nominal' => 'nullable|integer|min:0',
            'status' => 'required|in:Pending,Selesai',
            'ket' => 'nullable|string|max:255'
        ]);

        MS::create($validated);

        return redirect()->route('ms.index')->with('success', 'Data mahar/seserahan berhasil ditambahkan!');
    }

    public function update(Request $request, MS $m)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:mahar,seserahan',
            'nama' => 'required|string|max:100',
            'nominal' => 'nullable|integer|min:0',
            'status' => 'required|in:Pending,Selesai',
            'ket' => 'nullable|string|max:255'
        ]);

        $m->update($validated);

        return redirect()->route('ms.index')->with('success', 'Data mahar/seserahan berhasil diperbarui!');
    }

    public function destroy(MS $m)
    {
        $m->delete();

        return redirect()->route('ms.index')->with('success', 'Data mahar/seserahan berhasil dihapus!');
    }
}
