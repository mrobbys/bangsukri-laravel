<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('jabatan.index', [
            "title" => "Jabatan",
            "jabatans" => $jabatans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create', [
            "title" => "Jabatan",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama_jabatan' => 'required|min:3|max:255',
            ],
            [
                'required' => ':attribute harus diisi.',
                'min' => ':attribute minimal :min karakter.',
                'max' => ':attribute maksimal :max karakter.',
            ]
        );

        Jabatan::create($validatedData);
        return redirect('/jabatan')->with(
            'alert',
            [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Jabatan baru berhasil ditambahkan',
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        $jabatans = Jabatan::all();
        return view('jabatan.edit', [
            "title" => "Jabatan",
            "jabatans" => $jabatans,
            "jabatan" => $jabatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $validatedData = $request->validate(
            [
                'nama_jabatan' => 'required|min:3|max:255',
            ],
            [
                'required' => ':attribute harus diisi.',
                'min' => ':attribute minimal :min karakter.',
                'max' => ':attribute maksimal :max karakter.',
            ]
        );

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan
        ]);

        return redirect('/jabatan')->with(
            'alert',
            [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Jabatan berhasil diubah',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        Jabatan::destroy($jabatan->id);
        return redirect('/jabatan')->with(
            'alert',
            [
                'icon' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Jabatan berhasil dihapus',
            ]
        );
    }
}
