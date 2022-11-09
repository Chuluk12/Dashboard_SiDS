<!-- Modal -->
<div class="modal fade" id="modaleditpat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Perubahan Dokumen Rekaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formeditpat']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <input type="hidden" class="form-control " id="id" name="id" placeholder="Input Nomor Dokumen" value="<?=$id?>">
      <div class="form-group ">
        <div class="form-row">
          <div class="col">
            <label for="no_pat" class="form-label">No. Patrol</label>
            <input type="text" class="form-control " id="no_pat" name="no_pat" placeholder="Input Nomor Dokumen" value="<?=$nomor;?>" readonly>
            <div class="invalid-feedback errorno_pat">
            
          </div>
        </div>
        
        <div class="form-group ">
            <div class="col">
          <label for="plh_stat" >Status</label>
          <select class="custom-select" id="plh_stat" name="plh_stat" value="">
          <option selected disabled value=""  >Status Temuan</option>
          <option value="Open">Open</option>
          <option value="Close">Close</option>
          </select>
          <div class="invalid-feedback errorplh_stat">        
          </div>
        </div>
    </div>
    </div>
        
        <div class="form-group ">
            <label for="desk" class="form-label">Deskripsi Temuan</label>
            <textarea type="text" name="desk" class="form-control" id="desk" cols="30" rows="2" placeholder="Catatan Tindakan Perbaikan" value="" > <?=$deskripsi_bahaya;?> </textarea>
            <div class="invalid-feedback errordesk">
          </div>
        </div>

        <div class="form-group ">
            <label for="deskripsi" class="form-label">Catatan</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="2" placeholder="Catatan Tindakan Perbaikan" value=""><?=$keterangan;?></textarea>
            <div class="invalid-feedback errordeskripsi">
          </div>
        </div>

        <div class="form-group ">
            <label for="tgl_tar" class="form-label">Tanggal Penyelesaian</label>
            <input type="datetime-local" class="form-control datepicker" id="tgl_tar" name="tgl_tar" value="<?=$tgl_target;?>">
            <div class="invalid-feedback errortgl_tar">
          </div>
        </div>
    
        <div class="form-group ">
            <label for="ft_akhir" class="form-label">Upload Foto Temuan Akhir</label>
            <input type="file" class="form-control " id="ft_akhir" name="ft_akhir" placeholder="Pilih Foto Temuan"  >
            *max upload file 2Mb
            <div class="invalid-feedback errorft_akhir">  
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
            let form = $('.formeditpat')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpaneditpat',
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
                        if(response.error.tgl_tar){
                            $('#tgl_tar').addClass('is-invalid');
                            $('.errortgl_tar').html(response.error.tgl_tar);
                        }else{
                            $('#tgl_tar').removeClass('is-invalid');
                            $('.errortgl_tar').html('');
                        }
                        if(response.error.plh_stat){
                            $('#plh_stat').addClass('is-invalid');
                            $('.errorplh_stat').html(response.error.plh_stat);
                        }else{
                            $('#plh_stat').removeClass('is-invalid');
                            $('.errorplh_stat').html('');
                        }
                        if(response.error.ft_akhir){
                            $('#ft_akhir').addClass('is-invalid');
                            $('.errorft_akhir').html(response.error.ft_akhir);
                        }else{
                            $('#ft_akhir').removeClass('is-invalid');
                            $('.errorft_akhir').html('');
                        }
                     }else{
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        })
                        $('#modaleditpat').modal('hide');
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