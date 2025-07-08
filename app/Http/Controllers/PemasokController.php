<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasoks = Pemasok::all();
        return view('pemasok.index', [
            "title" => "Pemasok",
            "pemasoks" => $pemasoks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemasok.create', [
            "title" => "Pemasok",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pemasok' => 'required|min:3|max:255',
            'nama_kontak' => 'required|min:3|max:255',
            'nomor_hp' => 'required|min:11|max:255|unique:pemasok',
            'alamat' => 'required|min:3|max:255',
        ]);

        Pemasok::create($validatedData);
        return redirect('/pemasok')->with('success', 'Pemasok baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasok $pemasok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasok $pemasok)
    {
        $pemasoks = Pemasok::all();
        return view('pemasok.edit', [
            "title" => "Pemasok",
            "pemasoks" => $pemasoks,
            "pemasok" => $pemasok
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasok $pemasok)
    {
        $request->validate([
            'nama_pemasok' => 'required|min:3|max:255',
            'nama_kontak' => 'required|min:3|max:255',
            'nomor_hp' => 'required|min:11|max:255|unique:pemasok,nomor_hp,' . $pemasok->id,
            'alamat' => 'required|min:3|max:255',
        ]);

        $pemasok->update([
            'nama_pemasok' => $request->nama_pemasok,
            'nama_kontak' => $request->nama_kontak,
            'nomor_hp' => $request->nomor_hp,
            'alamat' => $request->alamat
        ]);

        return redirect('/pemasok')->with('success', 'Pemasok berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasok $pemasok)
    {
        Pemasok::destroy($pemasok->id);
        return redirect('/pemasok')->with('success', 'Pemasok berhasil dihapus');
    }
}
