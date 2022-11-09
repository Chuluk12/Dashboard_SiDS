<!-- Modal -->
<div class="modal fade" id="modaladdpro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Program</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formaddprogram']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <div class="form-group ">
        <div class="form-row">
          <div class="col">
        <label for="pilih_kt" >Kategori Peserta</label>
          <select class="custom-select" id="pilih_kt" name="pilih_kt" value="">
          <!-- <option selected disabled value=""  >Kategori Peserta</option> -->
          <option value="Umum">Umum</option>
          <option value="Khusus">Khusus</option>
          </select>
          <div class="invalid-feedback errorpilih_kt">
            
          </div>
    </div>
</div>
        <div class="form-group ">
            <label for="no_reg" class="form-label">No. Program</label>
            <input type="text" class="form-control " id="no_reg" name="no_reg" placeholder="Input Nomor Program" >
            <div class="invalid-feedback errorno_reg">
            
          </div>
        </div>
        
        <div class="form-group ">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control " id="deskripsi" name="deskripsi" placeholder="Input Deskripsi"  >
            <div class="invalid-feedback errordeskripsi">
            
          </div>
        </div>

        <div class="form-group ">
            <label for="lama_pro" class="form-label">Lama Pelaksanaan</label>
            <input type="text" class="form-control " id="lama_pro" name="lama_pro" placeholder="Input Lama Pelaksanaan">
            <div class="invalid-feedback errorlama_pro">
            
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
            let form = $('.formaddprogram')[0];

            let data = new FormData(form);
    $.ajax({
      type: "post",
      url:'/admin/simpanaddpro',
      data: data,
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,                
      dataType: "json",

      beforeSend: function(){
        $('.btnaddsimpan').attr('disable', 'disabled');
        $('.btnaddsimpan').html('Proses');
      },

      complete: function(){
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
                    if(response.error.no_reg){
                            $('#no_reg').addClass('is-invalid');
                            $('.errorno_reg').html(response.error.no_reg);
                        }else{
                            $('#no_reg').removeClass('is-invalid');
                            $('.errorno_reg').html('');
                        }
                    if(response.error.deskripsi){
                            $('#deskripsi').addClass('is-invalid');
                            $('.errordeskripsi').html(response.error.deskripsi);
                        }else{
                            $('#deskripsi').removeClass('is-invalid');
                            $('.errordeskripsi').html('');
                        }
                    if(response.error.lama_pro){
                            $('#lama_pro').addClass('is-invalid');
                            $('.errorlama').html(response.error.lama_pro);
                        }else{
                            $('#lama_pro').removeClass('is-invalid');
                            $('.errorlama_pro').html('');
                        }
                        }else{
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        })
                        $('#modaladdpro').modal('hide');
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