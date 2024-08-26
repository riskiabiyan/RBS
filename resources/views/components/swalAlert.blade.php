<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session()->has('data_disimpan'))
    <script>
        console.log('Session data_disimpan detected');
        Swal.fire({
            title: 'Berhasil',
            text: 'Data berhasil disimpan',
            icon: 'success'
        });
    </script>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('cek_verifikasi'))
<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Silahkan cek Email anda',
        icon: 'success'
    });
</script>
@endif

@if (session()->has('kesalahan'))
<script>
    Swal.fire({
        title: 'Gagal',
        text: 'Email atau password salah',
        icon: 'error'
    });
</script>
@endif

@if (session()->has('verify_berhasil'))
<script>
    Swal.fire({
        title: 'Berhasil',
        text: 'Email telah terverifikasi',
        icon: 'success'
    });
</script>
@endif

@if (session()->has('tindakan_dibatasi'))
<script>
    Swal.fire({
        title: 'Peringatan',
        text: 'Hak akses ditolak',
        icon: 'warning'
    });
</script>
@endif