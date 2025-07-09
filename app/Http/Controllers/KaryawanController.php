<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::with('jabatan')->get();
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
        $jabatans = Jabatan::all();
        return view('karyawan.create', [
            "title" => "Karyawan",
            "jabatans" => $jabatans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_karyawan' => 'required|min:3|max:255',
                'jabatan_id' => 'required',
                'nomor_hp' => 'required|min:11|max:255|unique:karyawan',
                'alamat' => 'required|min:3|max:255',
            ],
            [
                'nama_karyawan.required' => 'Nama karyawan harus diisi',
                'nama_karyawan.min' => 'Nama karyawan minimal 3 karakter',
                'nama_karyawan.max' => 'Nama karyawan maksimal 255 karakter',
                'jabatan_id.required' => 'Jabatan harus dipilih',
                'nomor_hp.required' => 'Nomor HP harus diisi',
                'nomor_hp.min' => 'Nomor HP minimal 11 karakter',
                'nomor_hp.max' => 'Nomor HP maksimal 255 karakter',
                'nomor_hp.unique' => 'Nomor HP sudah terdaftar',
                'alamat.required' => 'Alamat harus diisi',
                'alamat.min' => 'Alamat minimal 3 karakter',
                'alamat.max' => 'Alamat maksimal 255 karakter',
            ]
        );

        Karyawan::create($validatedData);
        return redirect('/karyawan')->with(
            'alert',
            [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Karyawan baru berhasil ditambahkan',
            ]
        );
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
        $jabatans = Jabatan::all();
        return view('karyawan.edit', [
            "title" => "Karyawan",
            "karyawans" => $karyawans,
            "karyawan" => $karyawan,
            "jabatans" => $jabatans
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate(
            [
                'nama_karyawan' => 'required|min:3|max:255',
                'jabatan_id' => 'required',
                'nomor_hp' => 'required|min:11|max:255|unique:karyawan,nomor_hp,' . $karyawan->id,
                'alamat' => 'required|min:3|max:255',
            ],
            [
                'nama_karyawan.required' => 'Nama karyawan harus diisi',
                'nama_karyawan.min' => 'Nama karyawan minimal 3 karakter',
                'nama_karyawan.max' => 'Nama karyawan maksimal 255 karakter',
                'jabatan_id.required' => 'Jabatan harus dipilih',
                'nomor_hp.required' => 'Nomor HP harus diisi',
                'nomor_hp.min' => 'Nomor HP minimal 11 karakter',
                'nomor_hp.max' => 'Nomor HP maksimal 255 karakter',
                'nomor_hp.unique' => 'Nomor HP sudah terdaftar',
                'alamat.required' => 'Alamat harus diisi',
                'alamat.min' => 'Alamat minimal 3 karakter',
                'alamat.max' => 'Alamat maksimal 255 karakter',
            ]
        );

        $karyawan->update([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan_id' => $request->jabatan_id,
            'nomor_hp' => $request->nomor_hp,
            'alamat' => $request->alamat
        ]);

        return redirect('/karyawan')->with(
            'alert',
            [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Karyawan berhasil diubah',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        Karyawan::destroy($karyawan->id);
        return redirect('/karyawan')->with(
            'alert',
            [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Karyawan berhasil dihapus',
            ]
        );
    }
}
