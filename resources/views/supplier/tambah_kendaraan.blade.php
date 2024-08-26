<div class="modal fade" id="tambahKendaraan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kendaraan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/supplier/simpan_kendaraan" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="kode_pengiriman" value="{{$kode_pengiriman}}">
            <div class="form-group">
                <label for="nomor_plat">Nomor PLAT</label>
                <input type="text" class="form-control" name="nomor_plat" required autofocus>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Jenis Kendaraan</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="jenis_kendaraan">
                  <option value="Truk" selected>Truk</option>
                  <option value="Pickup">Pickup</option>
                  <option value="Kapal laut">Kapal laut</option>
                </select>
            </div>
            <div class="form-group">
                <label for="foto_kendaraan">Foto Kendaraan</label>
                <input type="file" class="form-control" name="foto_kendaraan">
            </div>
            <button type="submit" id="hiddenSubmitButton2" class="d-none">Submit</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button id="externalButton2" class="btn btn-primary">Simpan Data</button>
        </div>
      </div>
    </div>
  </div>

<script>
    document.getElementById('externalButton2').addEventListener('click', function() {
        document.getElementById('hiddenSubmitButton2').click();
    });
</script>