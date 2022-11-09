<!-- Modal -->
<div class="modal fade" id="modaleditpel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Perubahan Pelatihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formeditpel']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <input type="hidden" class="form-control " id="id" name="id" placeholder="Input Nomor Dokumen" value="<?= $id?>">
      <div class="form-group ">
        <div class="form-row">
          <div class="col">
            <label for="nomor" class="form-label">No. Agenda</label>
            <input type="text" class="form-control " id="nomor" name="nomor" placeholder="Input Nomor Agenda" value="<?= $nomor;?>" readonly>
            <div class="invalid-feedback errornomor">
            
          </div>
        </div>
        
        <div class="col">
            
          <label for="status" class="form-label">Status Pelatihan</label>
            <input type="text" class="form-control " id="status" name="status" placeholder="Input Penerbit" value="<?= $status;?>" >
            <div class="invalid-feedback errorstatus">
            
          </div>
        </div>
    </div>
</div>
        <div class="form-group ">
            <label for="kegiatan" class="form-label">Deskripsi</label>
            <input type="text" class="form-control " id="kegiatan" name="kegiatan" placeholder="Input Deskripsi" value="<?= $kegiatan;?>" >
            <div class="invalid-feedback errorkegiatan">
            
          </div>
        </div>

        <div class="form-group ">
            <div class="form-row">
          <div class="col">
            <label for="mulai" class="form-label">Tgl. Awal</label>
            <input type="datetime-local" class="form-control" id="mulai" name="mulai"  value="<?= $mulai;?>">
            <div class="invalid-feedback errormulai">
            
          </div>
        </div>
        <div class="col">
            <label for="selesai" class="form-label">Tgl. Akhir</label>
            <input type="datetime-local" class="form-control" id="selesai" name="selesai"  value="<?= $selesai;?>">
            <div class="invalid-feedback errorselesai">
            
          </div>
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
            let form = $('.formeditpel')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpaneditpel',
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
                        if(response.error.no_reg){
                            $('#no_reg').addClass('is-invalid');
                            $('.errorno_reg').html(response.error.no_reg);
                        }else{
                            $('#no_reg').removeClass('is-invalid');
                            $('.errorno_reg').html('');
                        }
                        if(response.error.nomor){
                            $('#nomor').addClass('is-invalid');
                            $('.errornomor').html(response.error.nomor);
                        }else{
                            $('#nomor').removeClass('is-invalid');
                            $('.errornomor').html('');
                        }
                        if(response.error.kegiatan){
                            $('#kegiatan').addClass('is-invalid');
                            $('.errorkegiatan').html(response.error.kegiatan);
                        }else{
                            $('#kegiatan').removeClass('is-invalid');
                            $('.errorkegiatan').html('');
                        }
                        if(response.error.status){
                            $('#status').addClass('is-invalid');
                            $('.errorstatus').html(response.error.status);
                        }else{
                            $('#status').removeClass('is-invalid');
                            $('.errorstatus').html('');
                        }
                        if(response.error.mulai){
                            $('#mulai').addClass('is-invalid');
                            $('.errormulai').html(response.error.mulai);
                        }else{
                            $('#mulai').removeClass('is-invalid');
                            $('.errormulai').html('');
                        }
                        if(response.error.selesai){
                            $('#selesai').addClass('is-invalid');
                            $('.errorselesai').html(response.error.selesai);
                        }else{
                            $('#selesai').removeClass('is-invalid');
                            $('.errorselesai').html('');
                        }
                        if(response.error.no_reg){
                            $('#no_reg').addClass('is-invalid');
                            $('.errorno_reg').html(response.error.no_reg);
                        }else{
                            $('#no_reg').removeClass('is-invalid');
                            $('.errorno_reg').html('');
                        }
                     }else{
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        })
                        $('#modaleditpel').modal('hide');
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