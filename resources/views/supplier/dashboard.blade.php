@extends('supplier.master')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$jml_kayu}}</h3>

            <p>Jumlah Kayu</p>
          </div>
          <div class="icon">
            <i class="fas fa-leaf"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$jml_pengiriman}}</h3>

            <p>Jumlah Pengiriman</p>
          </div>
          <div class="icon">
            <i class="fas fa-book"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$jml_surat}}</h3>

            <p>Surat Angkut</p>
          </div>
          <div class="icon">
            <i class="fas fa-file-alt"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>...</h3>

            <p> ... </p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
</div>

  {{-- /////////////////////////////// --}}

    
@endsection