@extends('supplier.master')

@section('title', 'Preview Surat')

@section('content')

<div class="card p-4">

    <form action="/supplier/simpan_surat" method="POST">
    @csrf
    <div class="judul text-center mb-4">
        <h1>SURAT ANGKUTAN KAYU RAKYAT</h1>
        <h4> (berlaku sebagai Deklarasi Hasil Hutan)</h4>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
              <input type="text" name="nomor_surat" class="form-control text-center" value="{{$nomorSurat}}" readonly>
            </div>
        </div>
    </div>

    <input type="hidden" name="kode_pengiriman" value="{{$kode_pengiriman}}">
    <input type="hidden" name="pbb_id" value="{{$pbbID}}">
    <input type="hidden" name="kendaraan_id" value="{{$kendaraanID}}">
    
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td>Desa</td>
                <td>:</td>
                <td>
                   <input type="text" name="desa" class="form-control" value="{{$desa}}" readonly>
                </td>
                <td></td>
                <td>Kabupaten/Kota</td>
                <td>:</td>
                <td>
                    <input type="text" name="kabupaten" class="form-control" value="{{$kabupaten}}" readonly>
                </td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td>
                    <input type="text" name="kecamatan" class="form-control" value="{{$kecamatan}}" readonly>
                </td>
                <td></td>
                <td>Provinsi</td>
                <td>:</td>
                <td>
                    <input type="text" name="provinsi" class="form-control" value="{{$provinsi}}" readonly>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">ASAL KAYU</td>
                <td></td>
                <td></td>
                <td></td>
                <td class="font-weight-bold">TUJUAN PENGANGKUT</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Bukti Kepemilikan</td>
                <td>:</td>
                <td><input type="text" name="bukti_kepemilikan" class="form-control" value="PBB" readonly></td>
                <td></td>
                <td>Penerima</td>
                <td>:</td>
                <td><input type="text" name="penerima" class="form-control" value="{{$penerima}}" readonly></td>
            </tr>
            <tr>
                <td>No. Bukti Kepemilikan</td>
                <td>:</td>
                <td><input type="text" name="no_bukti" class="form-control" value="{{$nomor_pbb}}" readonly></td>
                <td></td>
                <td>Alamat Penerima</td>
                <td>:</td>
                <td><input type="text" name="alamat_penerima" class="form-control" value="{{$alamat_penerima}}" readonly></td>
            </tr>
            <tr>
                <td>Nama Pengirim</td>
                <td>:</td>
                <td><input type="text" class="form-control" name="nama_pengirim" value="{{$nama_pengirim}}" readonly></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>NIK Pengirim</td>
                <td>:</td>
                <td><input type="text" class="form-control" name="nik_pengirim" value="{{$nik}}" readonly></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Alamat Pengirim</td>
                <td>:</td>
                <td><input type="text" name="alamat_pengirim" class="form-control" value="{{$alamat_pengirim}}" readonly></td>
                <td></td>
                <td class="font-weight-bold">MASA BERLAKU</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Tempat muat</td>
                <td>:</td>
                <td><input type="text" name="tempat_muat" class="form-control" value="{{$tempat_muat}}" readonly></td>
                <td></td>
                <td>Selama</td>
                <td>:</td>
                <td><input type="text" name="hari_berlaku" class="form-control" value="{{$hari_berlaku}}" readonly></td>
            </tr>
            <tr>
                <td>Nomor PLAT</td>
                <td>:</td>
                <td><input type="text" name="nomor_plat" class="form-control" value="{{$nomor_plat}}" readonly></td>
                <td></td>
                <td>Dari tanggal</td>
                <td>:</td>
                <td><input type="text" name="dari_tanggal" class="form-control" value="{{$dari_tanggal}}" readonly></td>
            </tr>
            <tr>
                <td>Alat angkut</td>
                <td>:</td>
                <td><input type="text" name="alat_angkut" class="form-control" value="{{$jenis_kendaraan}}" readonly></td>
                <td></td>
                <td>Sampai tanggal</td>
                <td>:</td>
                <td><input type="text" name="sampai_tanggal" class="form-control" value="{{$sampai_tanggal}}" readonly></td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nomor</th>
                <th>Jenis Kayu</th>
                <th>Isi Kayu</th>
                <th>M3</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kayu as $index => $data_kayu)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data_kayu->jenis_kayu }}</td>
                <td>{{ $data_kayu->isi_kayu }}</td>
                <td>{{ $data_kayu->m3 }}</td>
                <td>{{ $data_kayu->keterangan }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-center">
                    Jumlah
                </td>
                <td>
                    {{$jml_kayu}}
                </td>
                <td>
                    {{$jml_kubikasi}}
                </td>
            </tr>
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary mt-4">Simpan Surat</button>
    </form>

</div>

    
@endsection