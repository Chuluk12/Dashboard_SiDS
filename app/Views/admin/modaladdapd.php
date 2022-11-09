<!-- Modal -->
<div class="modal fade" id="modaladdapd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Alat Pelindung Diri (APD)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formaddapd']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <div class="form-group ">
            <div class="form-row">
            <div class="col">
            <label for="no_apd" class="form-label">No. APD</label>
            <input type="text" class="form-control " id="no_apd" name="no_apd" placeholder="Input Nomor APD" >
            <div class="invalid-feedback errorno_apd">
            
          </div>
        </div>
          <div class="col">
                <label for="jenis_apd" >Jenis APD</label>
              <select class="custom-select " id="jenis_apd" name="jenis_apd" placeholder="Pilih Kategori" value="">
              <option selected disabled value="">Jenis Pelindung</option>
              <option value="Pelindung Kepala" >Pelindung Kepala</option>
              <option value="Pelindung Wajah">Pelindung Wajah</option>
              <option value="Pelindung Pendengaran">Pelindung Pendengaran</option>
              <option value="Pelindung Pernapasan" >Pelindung Pernapasan</option>
              <option value="Pelindung Tangan" >Pelindung Tangan</option>
              <option value="Pelindung Kaki" >Pelindung Kaki</option>
              <option value="Pelindung Badan" >Pelindung Badan</option>
              <option value="Pelindung Jatuh" >Pelindung Jatuh</option>
              </select>
          <div class="invalid-feedback errorjenis_apd">
            
          </div>
        </div>
    </div>
</div>
        <div class="form-group ">
            <label for="nm_apd" class="form-label">Deskripsi</label>
            <input type="text" class="form-control " id="nm_apd" name="nm_apd" placeholder="Input Nama APD" >
            <div class="invalid-feedback errornm_apd">
            
          </div>
        </div>

        <div class="form-group ">
            <div class="form-row">
            <div class="col">
            <label for="pengguna" class="form-label">Penggunaan</label><br>
            
            <select class="custom-select " id="pengguna" name="pengguna" placeholder="Pilih Kategori" value="">
              <option selected disabled value="">Pilih Penggunaan</option>
              <option value="Instalasi" >Instalasi</option>
              <option value="Pengukuran">Pengukuran</option>
              <option value="Pengiriman">Pengiriman</option>
              <option value="Welder" >Welder</option>
              <option value="Paparan Debu" >Paparan Debu</option>
              
              </select>
            
        </div>
        <div class="col">
            <label for="area" class="form-label">Area</label><br>
            
            <select class="custom-select " id="area" name="area" placeholder="Pilih Kategori" value="">
              <option selected disabled value="">Pilih Area</option>
              <option value="On Site" >On Site</option>
              <option value="Produksi">Produksi</option>
              <option value="Gudang">Gudang</option>
              <option value="Admin" >Admin</option>
              <option value="Lainnya" >Lainnya</option>
              
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
            let form = $('.formaddapd')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpanaddapdmodal',
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
                        $('#modaladdapd').modal('hide');
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