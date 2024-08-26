@extends('auth.master')

@section('title', 'Register')

@section('content')

<div class="row justify-content-center m-4">
    <div class="col-lg-4">
        <div class="card card-outline card-primary">
            <div class="card-header text-center h1">
                <b>RBS</b>
            </div>
            <div class="card-body">
                <form action="/simpan_user" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="role" value="supplier">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" class="form-control" name="nik" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="number" class="form-control" name="no_hp" required>
                    </div>
                    <div class="form-group">
                        <label for="desa">Desa</label>
                        <input type="text" class="form-control" name="desa" required>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" required>
                    </div>
                    <div class="form-group">
                        <label for="kabupaten">Kabupaten</label>
                        <input type="text" class="form-control" name="kabupaten" required>
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" class="form-control" name="provinsi" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_ktp">Foto KTP</label>
                        <input type="file" class="form-control" name="foto_ktp">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" name="password" required>
                            <div class="input-group-append">
                                <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                    <i id="passwordIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                            <div class="input-group-append">
                                <button type="button" id="togglePassword2" class="btn btn-outline-secondary">
                                    <i id="passwordIcon2" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form> 
                <p class="text-center mt-4">Sudah punya akun ?
                    <a href="{{url('/login')}}"> Login</a>
                </p>
            </div>
        </div>
    </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            togglePassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Toggle the icon
                passwordIcon.classList.toggle('fa-eye');
                passwordIcon.classList.toggle('fa-eye-slash');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword2');
            const password = document.getElementById('password_confirmation');
            const passwordIcon = document.getElementById('passwordIcon2');

            togglePassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Toggle the icon
                passwordIcon.classList.toggle('fa-eye');
                passwordIcon.classList.toggle('fa-eye-slash');
            });
        });
    </script>
    
@endsection