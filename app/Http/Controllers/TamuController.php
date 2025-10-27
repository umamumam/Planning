<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    public function index()
    {
        $tamus = Tamu::latest()->get();
        return view('tamus.index', compact('tamus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tamu' => 'required|in:Tamu Umam,Tamu Indah',
            'nama' => 'required|string|max:100',
            'nominal' => 'nullable|integer|min:0',
            'status' => 'required|in:Pending,Selesai'
        ]);

        Tamu::create($validated);

        return redirect()->route('tamus.index')->with('success', 'Data tamu berhasil ditambahkan!');
    }

    public function update(Request $request, Tamu $tamu)
    {
        $validated = $request->validate([
            'tamu' => 'required|in:Tamu Umam,Tamu Indah',
            'nama' => 'required|string|max:100',
            'nominal' => 'nullable|integer|min:0',
            'status' => 'required|in:Pending,Selesai'
        ]);

        $tamu->update($validated);

        return redirect()->route('tamus.index')->with('success', 'Data tamu berhasil diperbarui!');
    }

    public function destroy(Tamu $tamu)
    {
        $tamu->delete();

        return redirect()->route('tamus.index')->with('success', 'Data tamu berhasil dihapus!');
    }
}
