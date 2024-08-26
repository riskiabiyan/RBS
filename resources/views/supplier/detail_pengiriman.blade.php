@extends('supplier.master')

@section('title', 'Detail Data')

@section('content')
    <h3 class="mb-4">Detail Data Kayu</h3>
    <div class="row">
        <div class="col">
            <div class="card p-4">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-center">Nomor</th>
                            <th class="text-center">Kode pengiriman</th>
                            <th class="text-center">Jenis kayu</th>
                            <th class="text-center">Tebal kayu (CM)</th>
                            <th class="text-center">Lebar kayu (CM)</th>
                            <th class="text-center">Panjang kayu (CM)</th>
                            <th class="text-center">Isi kayu</th>
                            <th class="text-center">M3</th>
                            <th class="text-center">Keterangan</th>
                        </thead>
                        <tbody>
                            @foreach ($dataKayu as $index => $dataKayu)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $dataKayu->kode_pengiriman }}</td>
                                <td>{{ $dataKayu->jenis_kayu }}</td>
                                <td class="text-center">{{ $dataKayu->tebal_kayu }}</td>
                                <td class="text-center">{{ $dataKayu->lebar_kayu }}</td>
                                <td class="text-center">{{ $dataKayu->panjang_kayu }}</td>
                                <td class="text-center">{{ $dataKayu->isi_kayu }}</td>
                                <td class="text-center">{{ $dataKayu->m3 }}</td>
                                <td>{{ $dataKayu->keterangan }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-center">
                                    Jumlah
                                </td>
                                <td class="text-center">
                                    {{$jml_kayu}}
                                </td>
                                <td class="text-center">
                                   {{$jml_kubikasi}}
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex">
                    <a href="{{ route('supplier.data_pengiriman') }}" class="btn btn-danger">
                        <i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection