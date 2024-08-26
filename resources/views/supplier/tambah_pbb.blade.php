<div class="modal fade" id="tambahPBB" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data PBB</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/supplier/simpan_pbb" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="kode_pengiriman" value="{{$kode_pengiriman}}">
            <div class="form-group">
                <label for="nomor_pbb">Nomor PBB</label>
                <input type="text" class="form-control" name="nomor_pbb" required autofocus>
            </div>
            <div class="form-group">
                <label for="foto_pbb">Foto PBB</label>
                <input type="file" class="form-control" name="foto_pbb">
            </div>
            <button type="submit" id="hiddenSubmitButton" class="d-none">Submit</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button id="externalButton" class="btn btn-primary">Simpan Data</button>
        </div>
      </div>
    </div>
  </div>

<script>
    document.getElementById('externalButton').addEventListener('click', function() {
        document.getElementById('hiddenSubmitButton').click();
    });
</script>