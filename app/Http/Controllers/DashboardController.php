<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Barang;
use App\Models\Jabatan;
use App\Models\Pemasok;
use App\Models\Karyawan;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $allBarangMasuk = BarangMasuk::with('karyawan', 'pemasok')->get();
        $allBarang = Barang::all();
        $allKaryawan = Karyawan::with('barangMasuks')->with('jabatan')->get();
        $allJabatan = Jabatan::all();
        $allRuang = Ruang::all();
        $allPemasok = Pemasok::with('barangMasuks')->get();

        return view('welcome', [
            "title" => "Dashboard",
            "allBarangMasuk" => $allBarangMasuk,
            "allBarang" => $allBarang,
            "allKaryawan" => $allKaryawan,
            "allJabatan" => $allJabatan,
            "allRuang" => $allRuang,
            "allPemasok" => $allPemasok,
        ]);
    }

    
}
