<!-- Modal -->
<div class="modal fade" id="modaleditizin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Perubahan Dokumen Perizinan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formeditizin']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <input type="hidden" class="form-control " id="id" name="id" placeholder="Input Nomor Dokumen" value="<?=$id?>">
      <div class="form-group ">
        <div class="form-row">
          <div class="col">
            <label for="no_izin" class="form-label">No. Perizinan</label>
            <input type="text" class="form-control " id="no_izin" name="no_izin" placeholder="Input Nomor Perizinan" value="<?= $no_izin;?>" >
            <div class="invalid-feedback errorno_izin">
            
          </div>
        </div>
        
        <div class="col">
            
          <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control " id="penerbit" name="penerbit" placeholder="Input Penerbit" value="<?= $rilis_izin;?>" >
            <div class="invalid-feedback errorpenerbit">
            
          </div>
        </div>
    </div>
</div>
        <div class="form-group ">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control " id="deskripsi" name="deskripsi" placeholder="Input Deskripsi" value="<?= $nm_izin;?>" >
            <div class="invalid-feedback errordeskripsi">
            
          </div>
        </div>

        <div class="form-group ">
            <div class="form-row">
          <div class="col">
            <label for="tgl" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tgl" name="tgl"  value="<?= $tgl_izin;?>">
            <div class="invalid-feedback errortgl">
            
          </div>
        </div>
        <div class="col">
            <label for="tgl_masa" class="form-label">Masa Berlaku</label>
            <input type="date" class="form-control" id="tgl_masa" name="tgl_masa"  value="<?= $masa_berlaku;?>">
            <div class="invalid-feedback errortgl_masa">
            
          </div>
        </div>
    </div>
</div>
        <div class="form-group ">
            <label for="dokumen" class="form-label">Dokumen</label>
            <input type="file" class="form-control " id="dokumen" name="dokumen" placeholder="Pilih Dokumen"  >
            *max upload file 2Mb
            <div class="invalid-feedback errordokumen">
            
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btneditsimpan">Simpan</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('.btneditsimpan').click(function(e){
            e.preventDefault();
            let form = $('.formeditizin')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpaneditizin',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,                
                dataType: "json",
                beforeSend: function(e){
                    $('.btneditsimpan').prop('disable', 'disabled');
                    $('.btneditsimpan').html('Proses');
                },

                complete: function(e){
                    $('.btneditsimpan').removeAttr('disable');
                    $('.btneditsimpan').html('Simpan');
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
                        if(response.error.no_izin){
                            $('#no_izin').addClass('is-invalid');
                            $('.errorno_izin').html(response.error.no_izin);
                        }else{
                            $('#no_izin').removeClass('is-invalid');
                            $('.errorno_izin').html('');
                        }
                        if(response.error.deskripsi){
                            $('#deskripsi').addClass('is-invalid');
                            $('.errordeskripsi').html(response.error.deskripsi);
                        }else{
                            $('#deskripsi').removeClass('is-invalid');
                            $('.errordeskripsi').html('');
                        }
                        if(response.error.penerbit){
                            $('#penerbit').addClass('is-invalid');
                            $('.errorpenerbit').html(response.error.penerbit);
                        }else{
                            $('#penerbit').removeClass('is-invalid');
                            $('.errorpenerbit').html('');
                        }
                        if(response.error.tgl){
                            $('#tgl').addClass('is-invalid');
                            $('.errortgl').html(response.error.tgl);
                        }else{
                            $('#tgl').removeClass('is-invalid');
                            $('.errortgl').html('');
                        }
                        if(response.error.tgl_masa){
                            $('#tgl_masa').addClass('is-invalid');
                            $('.errortgl_masa').html(response.error.tgl_masa);
                        }else{
                            $('#tgl_masa').removeClass('is-invalid');
                            $('.errortgl_masa').html('');
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
                        $('#modaleditizin').modal('hide');
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