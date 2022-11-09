<!-- Modal -->
<div class="modal fade" id="modaleditdok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Perubahan Dokumen Standar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formeditdok']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <input type="hidden" class="form-control " id="id" name="id" placeholder="Input Nomor Dokumen" value="<?=$id?>">
      
        <div class="form-group ">
            <div class="form-row">
                <div class="col">
            <label for="pemilik" class="form-label">Pemilik Dokumen</label>
            <input type="text" class="form-control " id="pemilik" name="pemilik" placeholder="Input Nomor Dokumen" value="<?=$pemilik;?>" readonly>
            <div class="invalid-feedback errorpemilik">
            
          </div>
        </div>
        <div class="col">
        <label for="no_dok" class="form-label">No. Dokumen</label>
            <input type="text" class="form-control " id="no_dok" name="no_dok" placeholder="Input Nomor Dokumen" value="<?=$kd_dokumen;?>" readonly>
            <div class="invalid-feedback errorno_dok">
        </div>
    </div>
</div>
</div>
        <div class="form-group ">
            <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" class="form-control " id="deskripsi" name="deskripsi" placeholder="Input Nomor Dokumen" value="<?=$nm_dokumen;?>">
        </div>

        <div class="form-group ">
        <div class="form-row">
          <div class="col">        
            <label for="tgl" class="form-label">Tanggal</label>
            <input type="date" class="form-control datepicker" id="tgl" name="tgl" value="<?=$tgl_update;?>">
            <div class="invalid-feedback errortgl">
            
          </div>
        </div>
        <div class="col">        
            <label for="distribusi" class="form-label">Distribusi</label>
            <input type="date" class="form-control datepicker" id="distribusi" name="distribusi" value="<?=$tgl_dis;?>">
            <div class="invalid-feedback errortgl">
            
          </div>
        </div>
    </div>
</div>
        <div class="form-group ">
            <label for="dokumen" class="form-label">Dokumen</label>
            <input type="file" class="form-control " id="dokumen" name="dokumen" placeholder="Pilih Dokumen"  ">
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
            let form = $('.formeditdok')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpaneditdokumen',
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
                        if(response.error.tgl){
                            $('#tgl').addClass('is-invalid');
                            $('.errortgl').html(response.error.tgl);
                        }else{
                            $('#tgl').removeClass('is-invalid');
                            $('.errortgl').html('');
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
                        $('#modaleditdok').modal('hide');
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