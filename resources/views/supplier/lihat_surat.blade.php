@extends('supplier.master')

@section('title', 'Preview Surat')

@section('content')

<div class="card p-4 card-a4">

    <form action="/supplier/simpan_surat" method="POST">
    @csrf
    <div class="judul text-center mb-4">
        <h3>SURAT ANGKUTAN KAYU RAKYAT</h3>
        <h4> (berlaku sebagai Deklarasi Hasil Hutan)</h4>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
              {{$surat->nomor_surat}}
            </div>
        </div>
    </div>
    
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td>Desa</td>
                <td>:</td>
                <td>
                    {{$surat->desa}}
                </td>
                <td></td>
                <td>Kabupaten/Kota</td>
                <td>:</td>
                <td>
                    {{$surat->kabupaten}}                
                </td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td>
                    {{$surat->kecamatan}}                
                </td>
                <td></td>
                <td>Provinsi</td>
                <td>:</td>
                <td>
                    {{$surat->provinsi}}                
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
                <td>{{$surat->bukti_kepemilikan}}</td>
                <td></td>
                <td>Penerima</td>
                <td>:</td>
                <td>{{$surat->penerima}} </td>           
            </tr>
            <tr>
                <td>No. Bukti Kepemilikan</td>
                <td>:</td>
                <td>
                    {{$surat->no_bukti}}
                </td>
                <td></td>
                <td>Alamat Penerima</td>
                <td>:</td>
                <td>
                    {{$surat->alamat_penerima}}
                </td>
            </tr>
            <tr>
                <td>Nama Pengirim</td>
                <td>:</td>
                <td>
                    {{$surat->nama_pengirim}}
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>NIK Pengirim</td>
                <td>:</td>
                <td>
                    {{$surat->nik_pengirim}}
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Alamat Pengirim</td>
                <td>:</td>
                <td>{{$surat->alamat_pengirim}}</td>
                <td></td>
                <td class="font-weight-bold">MASA BERLAKU</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Tempat muat</td>
                <td>:</td>
                <td>{{$surat->tempat_muat}}</td>
                <td></td>
                <td>Selama</td>
                <td>:</td>
                <td>{{$surat->hari_berlaku}}</td>
            </tr>
            <tr>
                <td>Nomor PLAT</td>
                <td>:</td>
                <td>{{$surat->nomor_plat}}</td>
                <td></td>
                <td>Dari tanggal</td>
                <td>:</td>
                <td>{{$surat->dari_tanggal}}</td>
            </tr>
            <tr>
                <td>Alat angkut</td>
                <td>:</td>
                <td>{{$surat->alat_angkut}}</td>
                <td></td>
                <td>Sampai tanggal</td>
                <td>:</td>
                <td>{{$surat->sampai_tanggal}}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">Nomor</th>
                <th class="text-center">Jenis Kayu</th>
                <th class="text-center">Isi Kayu</th>
                <th class="text-center">M3</th>
                <th class="text-center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kayu as $index => $data_kayu)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $data_kayu->jenis_kayu }}</td>
                <td class="text-center">{{ $data_kayu->isi_kayu }}</td>
                <td class="text-center">{{ $data_kayu->m3 }}</td>
                <td class="text-center">{{ $data_kayu->keterangan }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-center">
                    Jumlah
                </td>
                <td class="text-center">
                    {{$jml_kayu}}
                </td>
                <td class="text-center">
                    {{$jml_kubikasi}}
                </td>
            </tr>
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary mt-4">Unduh Surat</button>
    </form>

</div>

    
@endsection