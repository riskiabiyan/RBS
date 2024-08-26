<?php

namespace App\Http\Controllers;

use App\Models\Data_pengiriman;
use App\Models\Surat_angkut;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function dashboard(){

        $jml_kayu = Data_pengiriman::sum('jumlah_kayu');

        $jml_pengiriman = Data_pengiriman::distinct('kode_pengiriman')
            ->count('kode_pengiriman');

        $jml_surat = Surat_angkut::count('id');

        return view('admin.dashboard', compact('jml_kayu', 'jml_pengiriman', 'jml_surat'));
    }
}
