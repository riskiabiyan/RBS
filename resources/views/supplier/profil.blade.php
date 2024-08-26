@extends('supplier.master')

@section('title', 'Profil')

@section('content')

<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{asset('templates/dist/img/user4-128x128.jpg')}}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{Auth::user()->nama_lengkap}}</h3>

              <p class="text-muted text-center">Supplier</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>NIK</b> <b class="float-right">{{Auth::user()->nik}}</b>
                </li>
                <li class="list-group-item">
                  <b>No HP</b> <b class="float-right">{{Auth::user()->no_hp}}</b>
                </li>
                <li class="list-group-item">
                  <b>Alamat</b> <b class="float-right">{{Auth::user()->kabupaten}},
                    {{Auth::user()->provinsi}}
                  </b>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <b class="float-right">{{Auth::user()->email}}
                  </b>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Ubah Profil</b></a>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-block mt-2">Keluar</button>
              </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
    
@endsection