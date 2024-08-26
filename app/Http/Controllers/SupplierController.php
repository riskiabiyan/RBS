<?php

namespace App\Http\Controllers;

use App\Models\Data_pengiriman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Detail_kayu;
use App\Models\Kendaraan_angkut;
use App\Models\Pbb;
use App\Models\Surat_angkut;
use Illuminate\Database\Eloquent\Casts\Json;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:supplier');
    }
    

    public function dashboard(){

        $kode_user = Auth::user()->kode_user;

        $jml_kayu = Data_pengiriman::where('kode_user', $kode_user)
            ->sum('jumlah_kayu');

        $jml_pengiriman = Data_pengiriman::where('kode_user', $kode_user)
            ->distinct('kode_pengiriman')
            ->count('kode_pengiriman');

        $jml_surat = Surat_angkut::where('kode_user', $kode_user)
            ->count('id');

        return view('supplier.dashboard', compact('jml_kayu', 'jml_pengiriman', 'jml_surat'));
    }

    public function pengiriman_kayu(){
        return view('supplier.form_kirim_kayu');
    }

    public function kayu_dikirim(){
       $userID = Auth::user()->kode_user;

        // $data_kayu = kayu_dikirim::where('kode_user', $userID)
        //     ->get();

        return view('supplier.kayu_dikirim');
    }

    public function simpan_kayu(Request $request){
      
            $validate = $request->validate([
                'jenis_kayu' => 'required|array',
                'jenis_kayu.*' => 'required|string',
                'tebal_kayu' => 'required|array',
                'tebal_kayu.*' => 'required|numeric',
                'lebar_kayu' => 'required|array',
                'lebar_kayu.*' => 'required|numeric',
                'panjang_kayu' => 'required|array',
                'panjang_kayu.*' => 'required|numeric',
                'isi_kayu' => 'required|array',
                'isi_kayu.*' => 'required|numeric',
                'm3' => 'required|array',
                'm3.*' => 'required|numeric',
                'keterangan' => 'required|array',
                'keterangan.*' => 'nullable|string|max:255',
            ]);
        

        $userID = Auth::user()->kode_user;
        $kode_pengiriman = Str::uuid()->toString();

        foreach ($validate['jenis_kayu'] as $index => $jenis) {
            $simpan_kayu = new Detail_kayu();
            $simpan_kayu->kode_user = $userID;
            $simpan_kayu->kode_pengiriman = $kode_pengiriman;
            $simpan_kayu->jenis_kayu = $validate['jenis_kayu'][$index];
            $simpan_kayu->tebal_kayu = $validate['tebal_kayu'][$index];
            $simpan_kayu->lebar_kayu = $validate['lebar_kayu'][$index];
            $simpan_kayu->panjang_kayu = $this->mapValue( $validate['panjang_kayu'][$index]);
            $simpan_kayu->isi_kayu = $validate['isi_kayu'][$index];
            $simpan_kayu->m3 = $validate['m3'][$index];
            $simpan_kayu->keterangan = $validate['keterangan'][$index] ?? null; // nullable
            $simpan_kayu->save();
        }
        //Simpan ke data pengiriman
        $jenis_kayu = collect($request->input('jenis_kayu'))->first();

        // Jumlah kayu
        $isi_kayu = $request->input('isi_kayu');
        $jumlah_kayu = array_sum($isi_kayu);

        // Jumlah kubikasi
        $m3 = $request->input('m3');
        $jumlah_kubikasi = array_sum($m3);

        $data_pengiriman = new Data_pengiriman();
        $data_pengiriman->kode_user = $userID;
        $data_pengiriman->kode_pengiriman = $kode_pengiriman;
        $data_pengiriman->jenis_kayu = $jenis_kayu;
        $data_pengiriman->jumlah_kayu = $jumlah_kayu;
        $data_pengiriman->total_kubikasi = $jumlah_kubikasi;
        $data_pengiriman->save(); 


        // Tampilkan data PBB dan Kendaraan yang ada
        $pbb = Pbb::where('kode_user', $userID)
            ->get();

        $kendaraan = Kendaraan_angkut::where('kode_user', $userID)
            ->get();

        session()->flash('data_disimpan', true);

        return view('supplier.pilih_pbb_kendaraan', compact('pbb', 'kendaraan', 'kode_pengiriman'));
    }

    private function mapValue($inputValue){
        return floor($inputValue / 10) * 10;
    }

    public function simpan_pbb_kendaraan(Request $request){
        $kode_user = Auth::user()->kode_user;
        $kode_pengiriman = $request->input('kode_pengiriman');
        $pbb = $request->input('pbb_id');
        $kendaraan = $request->input('kendaraan_id');

        return view('supplier.pengisian_data_surat', compact('kode_user', 'kode_pengiriman', 'pbb', 'kendaraan'));
    }

    public function simpan_pbb(Request $request){
        try {   
            $validate = $request->validate([
                'nomor_pbb' => 'required|string',
                'foto_pbb' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    
        $data_pbb = new Pbb();
        $data_pbb->kode_user = Auth::user()->kode_user;
        $data_pbb->nomor_pbb = $validate['nomor_pbb'];

        $kode_pengiriman = $request->input('kode_pengiriman');
        
    
        // Mengelola upload file
        $imageName = time() . '.' . $request->foto_pbb->extension();
        $request->foto_pbb->move(public_path('pbb'), $imageName);
        $data_pbb->foto_pbb = 'pbb/' . $imageName;
    
        // Menyimpan data ke database
        $data_pbb->save();
    
        // Memberikan feedback kepada user bahwa data berhasil disimpan
        session()->flash('data_disimpan');
        return redirect()->route('supplier.tampil_pbb_kendaraan')->with('kode_pengiriman', $kode_pengiriman);

    }

    public function simpan_kendaraan(Request $request){
        try{
            $validate = $request->validate([
                'nomor_plat' => 'required|string',
                'jenis_kendaraan' => 'required|string',
                'foto_kendaraan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        $data_kendaraan = new Kendaraan_angkut();
        $data_kendaraan->kode_user = Auth::user()->kode_user;
        $data_kendaraan->nomor_plat = $validate['nomor_plat'];
        $data_kendaraan->jenis_kendaraan = $validate['jenis_kendaraan'];

        $kode_pengiriman = $request->input('kode_pengiriman');

        $imageName = time() . '.' . $request->foto_kendaraan->extension();
        $request->foto_kendaraan->move(public_path('kendaraan'), $imageName);
        $data_kendaraan->foto_kendaraan = 'kendaraan/' . $imageName;

        $data_kendaraan->save();

        session()->flash('data_disimpan');
        return redirect()->route('supplier.tampil_pbb_kendaraan')->with('kode_pengiriman', $kode_pengiriman);
        
        
    }

    public function tampil_pbb_kendaraan(){
        $userID = Auth::user()->kode_user;

        $kode_pengiriman = session('kode_pengiriman');

        $pbb = Pbb::where('kode_user', $userID)
                ->get();

        $kendaraan = Kendaraan_angkut::where('kode_user', $userID)
                ->get();

        return view('supplier.pilih_pbb_kendaraan', compact('pbb', 'kendaraan', 'kode_pengiriman'));
    }

    public function preview_surat(Request $request){

        try{
            $validate = $request->validate([
                'alamat_pengirim' => 'required|string',
                'tempat_muat' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        $userID = Auth::user()->kode_user;
        $kode_pengiriman = $request->input('kode_pengiriman');
        $pbbID = $request->input('pbb_id');
        $kendaraanID = $request->input('kendaraan_id');
        $alamat_pengirim = $validate['alamat_pengirim'];
        $tempat_muat = $validate['tempat_muat'];

        //Pencarian Nomor surat
        $thun_skrg = Carbon::now()->year;
        $bln_skrg = (int)Carbon::now()->format('m'); 
        $romawi_bln = $this->convertToRoman($bln_skrg);
        $kode_divisi = "RBS";
        $kode_user = Auth::user()->kode_user;
        $lastSurat = Surat_angkut::whereYear('created_at', $thun_skrg)
            ->whereMonth('created_at', $bln_skrg)
            ->where('kode_user', $kode_user)
            ->orderBy('id', 'desc')
            ->first();
        $terbaru = $lastSurat ? $lastSurat->id + 1 : 1;
        $nomorSurat = sprintf('%03d', $terbaru) . "/$kode_divisi/$romawi_bln/$thun_skrg";
        ////////////

        $desa = Auth::user()->desa;
        $kecamatan = Auth::user()->kecamatan;
        $kabupaten = Auth::user()->desa;
        $provinsi = Auth::user()->provinsi;
        $nama_pengirim = Auth::user()->nama_lengkap;
        $nik = Auth::user()->nik;

        //Pencarian data pbb
        $PBB = Pbb::find($pbbID);
        $nomor_pbb = $PBB->nomor_pbb;

        //Pencarian data angkutan
        $Angkutan = Kendaraan_angkut::find($kendaraanID);
        $nomor_plat = $Angkutan->nomor_plat;
        $jenis_kendaraan = $Angkutan->jenis_kendaraan;

        $penerima = 'RASI BINTANG SAMUDERA';
        $alamat_penerima = 'Jl. Trunojoyo XIII, Semarang';
        $hari_berlaku = 30;
        $dari_tanggal = Carbon::now()->format('y-m-d');
        $sampai_tanggal = Carbon::now()->addDays(30)->format('y-m-d');

        $kayu = Detail_kayu::where('kode_user', $kode_user)
            ->where('kode_pengiriman', $kode_pengiriman)
            ->get();

        $jml_kayu = Detail_kayu::where('kode_pengiriman', $kode_pengiriman)
            ->where('kode_user', $kode_user)
            ->sum('isi_kayu');
    
        $jml_kubikasi = Detail_kayu::where('kode_pengiriman', $kode_pengiriman)
            ->where('kode_user', $kode_user)
            ->sum('m3');

        return view('supplier.preview_surat', compact('alamat_pengirim', 'tempat_muat', 'nomorSurat', 'desa', 'kecamatan',
        'kabupaten', 'provinsi', 'nama_pengirim', 'nik', 'nomor_pbb', 'nomor_plat', 'jenis_kendaraan', 'penerima', 'alamat_penerima',
        'hari_berlaku', 'dari_tanggal', 'sampai_tanggal', 'kayu', 'jml_kayu', 'jml_kubikasi',
        'kode_user', 'kode_pengiriman', 'pbbID', 'kendaraanID'));
    }

    private function convertToRoman($month)
    {
        $map = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
            5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
            9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];

        return $map[$month] ?? 'Invalid month';
    }

    public function simpan_surat(Request $request){

        $kode_pengiriman = $request->input('kode_pengiriman');

        $surat = new Surat_angkut();
        $surat->nomor_surat = $request->input('nomor_surat');
        $surat->kode_pengiriman = $kode_pengiriman;
        $surat->kode_user = Auth::user()->kode_user;
        $surat->pbb_id = $request->input('pbb_id');
        $surat->kendaraan_id = $request->input('kendaraan_id');
        $surat->kode_pengiriman = $request->input('kode_pengiriman');
        $surat->desa = $request->input('desa');
        $surat->kecamatan = $request->input('kecamatan');
        $surat->kabupaten = $request->input('kabupaten');
        $surat->provinsi = $request->input('provinsi');
        $surat->bukti_kepemilikan = $request->input('bukti_kepemilikan');
        $surat->no_bukti = $request->input('no_bukti');
        $surat->nama_pengirim = $request->input('nama_pengirim');
        $surat->nik_pengirim = $request->input('nik_pengirim');
        $surat->alamat_pengirim = $request->input('alamat_pengirim');
        $surat->tempat_muat = $request->input('tempat_muat');
        $surat->nomor_plat = $request->input('nomor_plat');
        $surat->alat_angkut = $request->input('alat_angkut');
        $surat->penerima = $request->input('penerima');
        $surat->alamat_penerima = $request->input('alamat_penerima');
        $surat->hari_berlaku = $request->input('hari_berlaku');
        $surat->dari_tanggal = $request->input('dari_tanggal');
        $surat->sampai_tanggal = $request->input('sampai_tanggal');
        $surat->save();

        Data_pengiriman::where('kode_pengiriman', $kode_pengiriman)
            ->update(['surat_id' => $surat->id]);

        session()->flash('data_disimpan');
        return redirect()->route('supplier.data_pengiriman');
    }
    
    public function data_pengiriman(){
        $userID = Auth::user()->kode_user;
        $dataKayu = Data_pengiriman::where('kode_user', $userID)->get();

        return view('supplier.data_pengiriman', compact('dataKayu'));
    }

    public function buat_surat_angkutan(Request $request){
        $userID = Auth::user()->kode_user;

        $kode_pengiriman = $request->input('kode_pengiriman');

        $pbb = Pbb::where('kode_user', $userID)
                ->get();

        $kendaraan = Kendaraan_angkut::where('kode_user', $userID)
                ->get();

        return view('supplier.pilih_pbb_kendaraan', compact('pbb', 'kendaraan', 'kode_pengiriman'));
    }

    public function lihat_surat($kode_pengiriman){
        $kode_user = Auth::user()->kode_user;
        $surat = Surat_angkut::where('kode_pengiriman', $kode_pengiriman)
            ->where('kode_user', $kode_user)
            ->first();
        
        $kayu = Detail_kayu::where('kode_pengiriman', $kode_pengiriman)
            ->where('kode_user', $kode_user)
            ->get();
        
        $jml_kayu = Detail_kayu::where('kode_pengiriman', $kode_pengiriman)
            ->where('kode_user', $kode_user)
            ->sum('isi_kayu');

        $jml_kubikasi = Detail_kayu::where('kode_pengiriman', $kode_pengiriman)
            ->where('kode_user', $kode_user)
            ->sum('m3');

        return view('supplier.lihat_surat', compact('surat', 'kayu', 'jml_kayu', 'jml_kubikasi'));
    }

    public function detail_pengiriman($kode_pengiriman){
        $kode_user = Auth::user()->kode_user;
        
        $dataKayu = Detail_kayu::where('kode_pengiriman', $kode_pengiriman)
            ->where('kode_user', $kode_user)
            ->get();
        
        $jml_kayu = Detail_kayu::where('kode_pengiriman', $kode_pengiriman)
            ->where('kode_user', $kode_user)
            ->sum('isi_kayu');

        $jml_kubikasi = Detail_kayu::where('kode_pengiriman', $kode_pengiriman)
            ->where('kode_user', $kode_user)
            ->sum('m3');

        return view('supplier.detail_pengiriman', compact('dataKayu', 'jml_kayu', 'jml_kubikasi'));
    }

    public function profil(){

        $nama_lengkap = Auth::user()->nama_lengkap;

        return view('supplier.profil', compact('nama_lengkap'));
    }

}
