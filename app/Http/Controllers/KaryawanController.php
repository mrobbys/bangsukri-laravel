<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan.index', [
            "title" => "Karyawan",
            "karyawans" => $karyawans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create', [
            "title" => "Karyawan",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_karyawan' => 'required|min:3|max:255',
            'nomor_hp' => 'required|min:11|max:255|unique:karyawan',
            'alamat' => 'required|min:3|max:255',
        ]);

        Karyawan::create($validatedData);
        return redirect('/karyawan')->with('success', 'Karyawan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        $karyawans = Karyawan::all();
        return view('karyawan.edit', [
            "title" => "Karyawan",
            "karyawans" => $karyawans,
            "karyawan" => $karyawan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama_karyawan' => 'required|min:3|max:255',
            'nomor_hp' => 'required|min:11|max:255|unique:karyawan,nomor_hp,' . $karyawan->id,
            'alamat' => 'required|min:3|max:255',
        ]);

        $karyawan->update([
            'nama_karyawan' => $request->nama_karyawan,
            'nomor_hp' => $request->nomor_hp,
            'alamat' => $request->alamat
        ]);

        return redirect('/karyawan')->with('success', 'Karyawan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        Karyawan::destroy($karyawan->id);
        return redirect('/karyawan')->with('success', 'Karyawan berhasil dihapus');
    }
}
