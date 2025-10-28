<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangs = Ruang::all();
        $alert = session()->pull('alert'); // pull akan mengambil dan menghapus session
        return view('ruang.index', [
            "title" => "Ruang",
            "ruangs" => $ruangs,
            "alert" => $alert
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruang.create', [
            "title" => "Ruang"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'nama_ruang' => 'required|min:3|max:255|unique:ruang',
            ],
            [
                'required' => ':attribute harus diisi.',
                'min' => ':attribute minimal :min karakter.',
                'max' => ':attribute maksimal :max karakter.',
                'unique' => ':attribute sudah ada.',
            ]
        );

        Ruang::create($validateData);
        return redirect('ruang')->with('alert', [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Data Ruang Berhasil Ditambahkan.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruang $ruang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruang $ruang)
    {
        $ruangs = Ruang::all();
        return view('ruang.edit', [
            "title" => "Ruang",
            "ruangs" => $ruangs,
            "ruang" => $ruang,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'nama_ruang' => 'required|min:3|max:255|unique:ruang,nama_ruang,' . $ruang->id,
        ]);

        $ruang->update([
            'nama_ruang' => $request->nama_ruang,
        ]);

        return redirect('/ruang')->with('success', 'Data Ruang Berhasil Diubah!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruang $ruang)
    {
        Ruang::destroy($ruang->id);
        return redirect('/ruang')->with('success', 'Data Ruang Berhasil Dihapus!');
    }
}
