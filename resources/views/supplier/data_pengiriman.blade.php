@extends('supplier.master')

@section('title', 'Data pengiriman')

@section('content')


    <div class="row">
        <div class="col">
            <h3 class="mb-4">Data pengiriman kayu</h3>
            <div class="card p-4">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Kode pengiriman</th>
                                <th>Jenis kayu</th>
                                <th>Jumlah kayu</th>
                                <th>Total kubikasi</th>
                                <th>Waktu ditambahkan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataKayu as $item => $data_kayu)
                                <tr>
                                    <td class="text-center">{{ $item + 1 }}</td>
                                    <td>{{ $data_kayu->kode_pengiriman }}</td>
                                    <td>{{ $data_kayu->jenis_kayu }}</td>
                                    <td>{{ $data_kayu->jumlah_kayu }}</td>
                                    <td>{{ $data_kayu->total_kubikasi }}</td>
                                    <td>{{ $data_kayu->created_at }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('supplier.detail_pengiriman', ['kode_pengiriman' => $data_kayu->kode_pengiriman])}}" class="btn btn-success m-2">
                                                <i class="fa fa-chevron-right"></i> Selengkapnya
                                            </a>
                                            
                                            @if(!is_null($data_kayu->surat_id))
                                                <a href="{{route('supplier.lihat_surat', ['kode_pengiriman' => $data_kayu->kode_pengiriman])}}" class="btn btn-primary m-2">
                                                    <i class="fa fa-file-alt"></i> Lihat Surat Angkutan
                                                </a>
                                            @else
                                                <form action="{{ route('supplier.buat_surat_angkutan') }}" method="POST" class="m-2">
                                                    @csrf
                                                    <input type="hidden" name="kode_pengiriman" value="{{ $data_kayu->kode_pengiriman }}">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-plus-circle"></i> Buat Surat Angkutan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
@endsection