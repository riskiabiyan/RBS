@extends('auth.master')

@section('title', 'Login')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-4 mt-custom">
        <div class="card card-outline card-primary">
            <div class="card-header text-center h1">
                <b>RBS</b>
            </div>
            <div class="card-body">
                <form action="cek_user" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary w-100 mt-3">Masuk</button>
                      <p class="text-center mt-3">
                        Belum punya akun ? <a href="{{route('register')}}">Daftar</a>
                      </p>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection