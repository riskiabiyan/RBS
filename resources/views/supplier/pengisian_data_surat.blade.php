
@extends('supplier.master')

@section('title', 'Pengisian Data Surat')

@section('content')

<h4 class="mb-4">Pengisian Data Surat</h4>
<div class="card p-4">
    <form action="/supplier/preview_surat" method="POST">
        @csrf
        <input type="hidden" name="kode_pengiriman" value="{{ $kode_pengiriman }}">
        <input type="hidden" name="pbb_id" value="{{ $pbb }}">
        <input type="hidden" name="kendaraan_id" value="{{ $kendaraan }}">
    
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="alamat_pengirim">Alamat Pengirim</label>
                        <input type="text" id="alamat_pengirim" name="alamat_pengirim" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="tempat_muat">Tempat Muat</label>
                        <input type="text" id="tempat_muat" name="tempat_muat" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Preview Surat Angkut</button>
            </div>
        </div>
    </form>
</div>
    
@endsection