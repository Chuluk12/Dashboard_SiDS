<!-- Modal -->
<div class="modal fade" id="modaleditapd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Alat Pelindung Diri</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formeditapd']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <div class="text-center">
            <img src="/fotoapd/<?=$foto_apd;?>" class="imgs" alt="Responsive image">
        </div>
        <br>
        <div class="form-group ">
            <div class="form-row">
            <div class="col">
            <label for="no_apd" class="form-label">No. APD</label>
            <input type="text" class="form-control " id="no_apd" name="no_apd" placeholder="Input Nomor APD" value="<?=$no_apd;?>" readonly>
        </div>
          <div class="col">
                <label for="jenis_apd" >Jenis APD</label>
              <input type="text" class="form-control " id="no_apd" name="no_apd" placeholder="Input Nomor APD" value="<?=$jenis_apd;?>" readonly>  
        </div>
    </div>
</div>
        <div class="form-group ">
            <label for="nm_apd" class="form-label">Deskripsi</label>
            <input type="text" class="form-control " id="nm_apd" name="nm_apd" placeholder="Input Nama APD" value="<?=$nm_apd;?>" readonly>
            <div class="invalid-feedback errornm_apd">
            
          </div>
        </div>

        <div class="form-group ">
            <div class="form-row">
            <div class="col">
            <label for="pengguna" class="form-label">Pengguna</label><br>
            
            <input type="text" class="form-control " id="no_apd" name="no_apd" placeholder="Input Nomor APD" value="<?=$user_apd;?>" readonly>
            
        </div>
        <div class="col">
            <label for="area" class="form-label">Area</label><br>
            <input type="text" class="form-control " id="no_apd" name="no_apd" placeholder="Input Nomor APD" value="<?=$area_apd;?>" readonly>
            
          </div>
        </div>
    </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>