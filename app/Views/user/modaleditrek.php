<!-- Modal -->
<div class="modal fade" id="modaleditrek" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Perubahan Dokumen Rekaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formeditrek']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <input type="hidden" class="form-control " id="id" name="id" placeholder="Input Nomor Dokumen" value="<?=$id?>">
      <div class="form-group ">
        <div class="form-row">
          <div class="col">
            <label for="no_dok" class="form-label">No. Dokumen</label>
            <input type="text" class="form-control " id="no_dok" name="no_dok" placeholder="Input Nomor Dokumen" value="<?=$no_dok;?>" readonly>
            <div class="invalid-feedback errorno_dok">
            
          </div>
        </div>
        

        <div class="form-group ">
            <div class="col">
            <label for="lokasi" class="form-label">Lokasi Penyimpanan</label>
            <input type="text" class="form-control " id="lokasi" name="lokasi" placeholder="Input Lokasi Simpan" value="<?=$lokasi;?>">
            <div class="invalid-feedback errorlokasi">
            
          </div>
        </div>
        
    </div>
</div>

        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" class="form-control " id="deskripsi" name="deskripsi" placeholder="Input Nomor Dokumen" value="<?=$nm_dok;?>">
        <div class="invalid-feedback errordeskripsi">
        </div>
        </div>

        <div class="form-group ">
            <label for="lama_simpan" class="form-label">Masa Simpan</label>
            <input type="text" class="form-control " id="lama_simpan" name="lama_simpan" placeholder="Input Masa Simpan" value="<?=$lama_simpan;?>">
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
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnaddsimpan">Simpan</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<script>
     $(function(){
  $(".datepicker").datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
  });
 });
    $(document).ready(function(){
        $('.btnaddsimpan').click(function(e){
            e.preventDefault();
            let form = $('.formeditrek')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpaneditrek',
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
                        $('#modaleditrek').modal('hide');
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