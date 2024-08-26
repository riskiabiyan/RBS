@extends('supplier.master')

@section('title', 'Pembuatan Surat Angkut')

@section('content')


<div class="card card-primary">
    <div class="card-header">Pilih data PBB</div>
    <form action="/supplier/simpan_pbb_kendaraan" method="POST">
        <div class="card-body p-4">
            @csrf
            <div class="row">
                <input type="hidden" name="kode_pengiriman" value="{{ $kode_pengiriman }}">
                @foreach ($pbb as $data_pbb)
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <!-- Nama radio button disesuaikan -->
                            <input class="form-check-input" type="radio" name="pbb_id" id="pbbRadios{{ $loop->index }}" value="{{ $data_pbb->id }}" {{ $loop->first ? 'checked' : '' }}>
                            <label class="form-check-label" for="pbbRadios{{ $loop->index }}">
                                <img src="{{ asset($data_pbb->foto_pbb) }}" alt="Foto" class="img-fluid img-thumbnail" width="200px">
                                <p class="font-weight-bold">Nomor PBB : {{$data_pbb->nomor_pbb}}</p>
                            </label>
                        </div>
                    </div>
                @endforeach
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPBB">
                    <i class="fa fa-plus-circle"></i>
                    Tambah PBB
                  </button>
            </div>
        </div>
</div>

<div class="card card-primary mt-4">
    <div class="card-header">Pilih kendaraan</div>
    <div class="card-body p-4">
        @csrf
        <div class="row">
            @foreach ($kendaraan as $data_kendaraan)
                <div class="col-md-3 mb-3">
                    <div class="form-check">
                        <!-- Nama radio button disesuaikan -->
                        <input class="form-check-input" type="radio" name="kendaraan_id" id="kendaraanRadios{{ $loop->index }}" value="{{ $data_kendaraan->id }}" {{ $loop->first ? 'checked' : '' }}>
                        <label class="form-check-label" for="kendaraanRadios{{ $loop->index }}">
                            <img src="{{ asset($data_kendaraan->foto_kendaraan) }}" alt="Foto" class="img-fluid img-thumbnail" width="200px">
                            <p class="font-weight-bold">Nomor PLAT : {{$data_kendaraan->nomor_plat}}</p>
                        </label>
                    </div>
                </div>
            @endforeach
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKendaraan">
                <i class="fa fa-plus-circle"></i>
                Tambah Kendaraan
              </button>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success float-right"><i class="fa fa-arrow-right"></i>  Selanjutnya</button>
<a href="{{route('supplier.data_pengiriman')}}" class="btn btn-danger float-right ml-3">Keluar</a>

</form>

@include('supplier.tambah_pbb')
@include('supplier.tambah_kendaraan')

    
@endsection