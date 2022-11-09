<!-- Modal -->
<div class="modal fade" id="modaladdrek" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Rekaman Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formaddrek']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <div class="form-group ">
        <div class="form-row">
          <div class="col">
          <label for="pilih_kt" >Kategori</label>
          <select class="custom-select" id="pilih_kt" name="pilih_kt" value="">
          <option selected disabled value=""  >Kategori Dokumen</option>
          <option value="Rahasia">Rahasia</option>
          <option value="Umum">Umum</option>
          </select>
          <div class="invalid-feedback errorpilih_kt">
          </div>
        </div>

          <div class="col">
          <label for="pilih_status" >Status</label>
          <select class="custom-select" id="pilih_status" name="pilih_status" value="">
          <option selected disabled value=""  >Status Dokumen</option>
          <option value="Berlaku">Berlaku</option>
          <option value="Tidak Berlaku">Tidak Berlaku</option>
          </select>
          <div class="invalid-feedback errorpilih_status">            
          </div>
        </div>


        <div class="col">
        <label for="pilih_cara" >Cara Pemusnahan</label>
          <select class="custom-select" id="pilih_cara" name="pilih_cara" value="">
          <option selected disabled value=""  >Pilih Cara Pemusnahan</option>
          <option value="Dihancurkan">Dihancurkan</option>
          <option value="Dihapus">Dihapus</option>
          <option value="Dibakar">Dibakar</option>
          </select>
          <div class="invalid-feedback errorpilih_cara">
          </div>
        </div>
    </div>
</div>
        <div class="form-group ">
            <label for="no_dok" class="form-label">No. Dokumen</label>
            <input type="text" class="form-control " id="no_dok" name="no_dok" placeholder="Input Nomor Dokumen" >
            <div class="invalid-feedback errorno_dok">
            
          </div>
        </div>
        
        <div class="form-group ">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control " id="deskripsi" name="deskripsi" placeholder="Input Deskripsi"  >
            <div class="invalid-feedback errordeskripsi">
            
          </div>
        </div>

        <div class="form-group ">
            <label for="lokasi" class="form-label">Lokasi Penyimpanan</label>
            <input type="text" class="form-control " id="lokasi" name="lokasi" placeholder="Input Lokasi Simpan"  >
            <div class="invalid-feedback errorlokasi">
            
          </div>
        </div>

        <div class="form-group ">
            <label for="lama_simpan" class="form-label">Masa Simpan</label>
            <input type="text" class="form-control " id="lama_simpan" name="lama_simpan" placeholder="Input Masa Simpan"  >
            <div class="invalid-feedback errorlama_simpan">
            
          </div>
        </div>
    

        <div class="form-group ">
            <label for="dokumen" class="form-label">Upload Dokumen</label>
            <input type="file" class="form-control " id="dokumen" name="dokumen" placeholder="Pilih Dokumen"  >
            *max upload file 2Mb
            <div class="invalid-feedback errordokumen">  
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
            let form = $('.formaddrek')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpanaddrekmodal',
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
                        if(response.error.pilih_kt){
                            $('#pilih_kt').addClass('is-invalid');
                            $('.errorpilih_kt').html(response.error.pilih_kt);
                        }else{
                            $('#pilih_kt').removeClass('is-invalid');
                            $('.errorpilih_kt').html('');
                        }
                        if(response.error.pilih_status){
                            $('#pilih_status').addClass('is-invalid');
                            $('.errorpilih_status').html(response.error.pilih_status);
                        }else{
                            $('#pilih_status').removeClass('is-invalid');
                            $('.errorpilih_status').html('');
                        }
                        if(response.error.pilih_cara){
                            $('#pilih_cara').addClass('is-invalid');
                            $('.errorpilih_cara').html(response.error.pilih_cara);
                        }else{
                            $('#pilih_cara').removeClass('is-invalid');
                            $('.errorpilih_cara').html('');
                        }
                        if(response.error.no_dok){
                            $('#no_dok').addClass('is-invalid');
                            $('.errorno_dok').html(response.error.no_dok);
                        }else{
                            $('#no_dok').removeClass('is-invalid');
                            $('.errorno_dok').html('');
                        }
                        if(response.error.deskripsi){
                            $('#deskripsi').addClass('is-invalid');
                            $('.errordeskripsi').html(response.error.deskripsi);
                        }else{
                            $('#deskripsi').removeClass('is-invalid');
                            $('.errordeskripsi').html('');
                        }
                        if(response.error.lokasi){
                            $('#lokasi').addClass('is-invalid');
                            $('.errorlokasi').html(response.error.lokasi);
                        }else{
                            $('#lokasi').removeClass('is-invalid');
                            $('.errorlokasi').html('');
                        }
                        if(response.error.lama_simpan){
                            $('#lama_simpan').addClass('is-invalid');
                            $('.errorlama_simpan').html(response.error.lama_simpan);
                        }else{
                            $('#lama_simpan').removeClass('is-invalid');
                            $('.errorlama_simpan').html('');
                        }
                        if(response.error.dokumen){
                            $('#dokumen').addClass('is-invalid');
                            $('.errordokumen').html(response.error.dokumen);
                        }else{
                            $('#dokumen').removeClass('is-invalid');
                            $('.errordokumen').html('');
                        }
                     }else{
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        })
                        $('#modaladdrek').modal('hide');
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