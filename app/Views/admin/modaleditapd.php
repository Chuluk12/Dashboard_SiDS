<!-- Modal -->
<div class="modal fade" id="modaleditapd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Perubahan Alat Pelindung Diri (APD)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formeditapd']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <div class="text-center">
            
            <input type="hidden" class="form-control" name="fotolama" id="fotolama" placeholder="" value="<?= $foto_apd;?>"> 
            <input type="hidden" class="form-control" name="id" id="id" placeholder="Masukan Nama Depan" value="<?= $id;?>"> 
        </div>
        <br>
        <div class="form-group ">
            <div class="form-row">
            <div class="col">
            <label for="no_apd" class="form-label">No. APD</label>
            <input type="text" class="form-control " id="no_apd" name="no_apd" placeholder="Input Nomor APD" value="<?=$no_apd;?>" readonly>
            <div class="invalid-feedback errorno_apd">
            
          </div>
        </div>
          <div class="col">
                <label for="jenis_apd" >Jenis APD</label>
                <select class="custom-select " id="jenis_apd" name="jenis_apd" placeholder="Pilih Kategori" value="">
              <option selected disabled value="">Jenis Pelindung</option>
              <option value="Pelindung Kepala" <?= $jenis_apd == "Pelindung Kepala" ? "selected" : "" ?>>Pelindung Kepala</option>
              <option value="Pelindung Wajah" <?= $jenis_apd == "Pelindung Wajah" ? "selected" : "" ?>>Pelindung Wajah</option>
              <option value="Pelindung Pendengaran" <?= $jenis_apd == "Pelindung Pendengaran" ? "selected" : "" ?>>Pelindung Pendengaran</option>
              <option value="Pelindung Pernapasan" <?= $jenis_apd == "Pelindung Pernapasan" ? "selected" : "" ?>>Pelindung Pernapasan</option>
              <option value="Pelindung Tangan" <?= $jenis_apd == "Pelindung Tangan" ? "selected" : "" ?>>Pelindung Tangan</option>
              <option value="Pelindung Kaki" <?= $jenis_apd == "Pelindung Kaki" ? "selected" : "" ?>>Pelindung Kaki</option>
              <option value="Pelindung Badan" <?= $jenis_apd == "Pelindung Badan" ? "selected" : "" ?>>Pelindung Badan</option>
              <option value="Pelindung Jatuh" <?= $jenis_apd == "Pelindung Jatuh" ? "selected" : "" ?>>Pelindung Jatuh</option>
              </select>
          <div class="invalid-feedback errorjenis_apd">
            
          </div>
        </div>
    </div>
</div>
        <div class="form-group ">
            <label for="nm_apd" class="form-label">Deskripsi</label>
            <input type="text" class="form-control " id="nm_apd" name="nm_apd" placeholder="Input Nama APD" value="<?=$nm_apd;?>">
            <div class="invalid-feedback errornm_apd">
            
          </div>
        </div>

        <div class="form-group ">
            <div class="form-row">
            <div class="col">
            <label for="pengguna" class="form-label">Penggunaan</label><br>
            
            <select class="custom-select " id="pengguna" name="pengguna" placeholder="Pilih Kategori" value="">
              <option selected disabled value="">Pilih Penggunaan</option>
              <option value="Instalasi" <?= $user_apd == "Instalasi" ? "selected" : "" ?>>Instalasi</option>
              <option value="Pengukuran" <?= $user_apd == "Pengukuran" ? "selected" : "" ?>>Pengukuran</option>
              <option value="Pengiriman" <?= $user_apd == "Pengiriman" ? "selected" : "" ?>>Pengiriman</option>
              <option value="Welder" <?= $user_apd == "Welder" ? "selected" : "" ?>>Welder</option>
              <option value="Paparan Debu" <?= $user_apd == "Paparan Debu" ? "selected" : "" ?>>Paparan Debu</option>
              
              </select>
            
        </div>
        <div class="col">
            <label for="area" class="form-label">Area</label><br>
            
            <select class="custom-select " id="area" name="area" placeholder="Pilih Kategori" value="">
              <option selected disabled value="">Pilih Area</option>
              <option value="On Site" <?= $area_apd == "On Site" ? "selected" : "" ?>>On Site</option>
              <option value="Produksi" <?= $area_apd == "Produksi" ? "selected" : "" ?>>Produksi</option>
              <option value="Gudang" <?= $area_apd == "Gudang" ? "selected" : "" ?>>Gudang</option>
              <option value="Admin" <?= $area_apd == "Admin" ? "selected" : "" ?>>Admin</option>
              <option value="Lainnya" <?= $area_apd == "Lainnya" ? "selected" : "" ?>>Lainnya</option>
              
              </select>
            
          </div>
        </div>
    </div>
        <div class="form-group ">
            <label for="foto_apd" class="form-label">Foto APD</label>
            <input type="file" class="form-control " id="foto_apd" name="foto_apd" placeholder="Pilih File Gambar"  >
            *max upload file 2Mb & tipe file .PNG/.Jpg
            <div class="invalid-feedback errorfoto_apd">
            
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnaddsimpan">Simpan</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('.btnaddsimpan').click(function(e){
            e.preventDefault();
            let form = $('.formeditapd')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpaneditapdmodal',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,                
                dataType: "json",
                beforeSend: function(e){
                    $('.btnaddsimpan').prop('disable', 'disabled');
                    $('.btnaddsimpan').html('Proses');
                },

                complete: function(e){
                    $('.btnaddsimpan').removeAttr('disable');
                    $('.btnaddsimpan').html('Simpan');
                },
                success: function(response){
                    if(response.error){
                        if(response.error.no_apd){
                            $('#no_apd').addClass('is-invalid');
                            $('.errorno_apd').html(response.error.no_apd);
                        }else{
                            $('#no_apd').removeClass('is-invalid');
                            $('.errorno_apd').html('');
                        }
                        if(response.error.jenis_apd){
                            $('#jenis_apd').addClass('is-invalid');
                            $('.errorjenis_apd').html(response.error.jenis_apd);
                        }else{
                            $('#jenis_apd').removeClass('is-invalid');
                            $('.errorjenis_apd').html('');
                        }
                        if(response.error.nm_apd){
                            $('#nm_apd').addClass('is-invalid');
                            $('.errornm_apd').html(response.error.nm_apd);
                        }else{
                            $('#nm_apd').removeClass('is-invalid');
                            $('.errornm_apd').html('');
                        }
                        if(response.error.foto_apd){
                            $('#foto_apd').addClass('is-invalid');
                            $('.errorfoto_apd').html(response.error.foto_apd);
                        }else{
                            $('#foto_apd').removeClass('is-invalid');
                            $('.errorfoto_apd').html('');
                        }                        
                     }else{
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        })
                        $('#modaleditapd').modal('hide');
                        setInterval( () => {
                        location.reload();
                        }, 1500);
                        }
                    },
                error: function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
        });
    });
</script>