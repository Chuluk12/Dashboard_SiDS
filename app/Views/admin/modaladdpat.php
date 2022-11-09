<!-- Modal -->
<div class="modal fade" id="modaladdpat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Temuan Patrol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formaddpat']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <div class="form-group ">
        <div class="form-row">
          <div class="col">
          <label for="plh_lok" >Lokasi/Area</label>
          <select class="custom-select" id="plh_lok" name="plh_lok" value="">
          <option selected disabled value="">Lokasi Temuan</option>
          <option value="HSE-QA">HSE-QA</option>
          <option value="Marketing">Marketing</option>
          <option value="Purchasing">Purchasing</option>
          <option value="Acounting">Acounting</option>
          <option value="HRGA">HRGA</option>
          <option value="Engineering">Engineering</option>
          <option value="Logistic">Logistic</option>
          <option value="Production">Production</option>
          </select>
          <div class="invalid-feedback errorplh_lok">
          </div>
        </div>

          <div class="col">
          <label for="plh_ktg" >Kondisi</label>
          <select class="custom-select" id="plh_ktg" name="plh_ktg" value="">
          <option selected disabled value=""  >Kondisi Temuan</option>
          <option value="Safe Action">Safe Action</option>
          <option value="Unsafe Action">Unsafe Action</option>
          <option value="Safe Condition">Safe Condition</option>
          <option value="Unsafe Condition">Unsafe Condition</option>
          </select>
          <div class="invalid-feedback errorplh_ktg">
          </div>
        </div>

        <div class="form-row">
          <div class="col">
          <label for="plh_bhy" >Jenis</label>
          <select class="custom-select" id="plh_bhy" name="plh_bhy" value="">
          <option selected disabled value="">Jenis Bahaya</option>
          <option value="Terjatuh">Terjatuh</option>
          <option value="Terpeleset">Terpeleset</option>
          <option value="Terbakar">Terbakar</option>
          <option value="Tersetrum">Tersetrum</option>
          </select>
          <div class="invalid-feedback errorplh_bhy">
          </div>
        </div>
        </div>
        </div>
        </div>

          <div class="form-group">  
          <div class="form-row">
          <div class="col">
            <label for="no_pat" class="form-label">No. Patrol</label>
            <input type="text" class="form-control " id="no_pat" name="no_pat" placeholder="Input Nomor Patrol" >
            <div class="invalid-feedback errorno_pat">
          </div>
        </div>

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
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="2" placeholder="Deskripsi Bahaya"></textarea>
            <div class="invalid-feedback errordeskripsi">
            
          </div>
        </div>

        <div class="form-group ">
            <label for="tindakan" class="form-label">Tindak Lanjut</label>
            <textarea name="tindakan" class="form-control" id="tindakan" cols="30" rows="2" placeholder="Tindakan yang dilakukan"></textarea>
            <div class="invalid-feedback errortindakan">
          </div>
        </div>

        <div class="form-group ">
            <div class="form-row">
          <div class="col">
            <label for="tgl_pat" class="form-label">Tgl. Temuan</label>
            <input type="datetime-local" class="form-control" id="tgl_pat" name="tgl_pat" >
            <div class="invalid-feedback errortgl_pat">
          </div>
        </div>

        <div class="col">
            <label for="tgl_tar" class="form-label">Target Penyelesaian </label>
            <input type="datetime-local" class="form-control" id="tgl_tar" name="tgl_tar"  >
            <div class="invalid-feedback errortgl_tar">
          </div>
        </div>
    </div>
</div>
    
        <div class="form-group ">
            <label for="ft_awal" class="form-label">Upload Foto Temuan Awal</label>
            <input type="file" class="form-control " id="ft_awal" name="ft_awal" placeholder="Pilih Foto"  >
            *max upload file 2Mb
            <div class="invalid-feedback errorft_awal">  
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
            let form = $('.formaddpat')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpanaddpatrolmodal',
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
                        if(response.error.plh_ktg){
                            $('#plh_ktg').addClass('is-invalid');
                            $('.errorplh_ktg').html(response.error.plh_ktg);
                        }else{
                            $('#plh_ktg').removeClass('is-invalid');
                            $('.errorplh_ktg').html('');
                        }
                        if(response.error.plh_stat){
                            $('#plh_stat').addClass('is-invalid');
                            $('.errorplh_stat').html(response.error.plh_stat);
                        }else{
                            $('#plh_stat').removeClass('is-invalid');
                            $('.errorplh_stat').html('');
                        }
                        if(response.error.deskripsi){
                            $('#deskripsi').addClass('is-invalid');
                            $('.errordeskripsi').html(response.error.deskripsi);
                        }else{
                            $('#deskripsi').removeClass('is-invalid');
                            $('.errordeskripsi').html('');
                        }
                        if(response.error.no_pat){
                            $('#no_pat').addClass('is-invalid');
                            $('.errorno_pat').html(response.error.no_pat);
                        }else{
                            $('#no_pat').removeClass('is-invalid');
                            $('.errorno_pat').html('');
                        }
                        if(response.error.plh_lok){
                            $('#plh_lok').addClass('is-invalid');
                            $('.errorplh_lok').html(response.error.plh_lok);
                        }else{
                            $('#plh_lok').removeClass('is-invalid');
                            $('.errorplh_lok').html('');
                        }
                        if(response.error.plh_bhy){
                            $('#plh_bhy').addClass('is-invalid');
                            $('.errorplh_bhy').html(response.error.plh_bhy);
                        }else{
                            $('#plh_bhy').removeClass('is-invalid');
                            $('.errorplh_bhy').html('');
                        }
                        if(response.error.tindakan){
                            $('#tindakan').addClass('is-invalid');
                            $('.errortindakan').html(response.error.tindakan);
                        }else{
                            $('#tindakan').removeClass('is-invalid');
                            $('.errortindakan').html('');
                        }
                        if(response.error.tgl_pat){
                            $('#tgl_pat').addClass('is-invalid');
                            $('.errortgl_pat').html(response.error.tgl_pat);
                        }else{
                            $('#tgl_pat').removeClass('is-invalid');
                            $('.errortgl_pat').html('');
                        }
                        if(response.error.tgl_tar){
                            $('#tgl_tar').addClass('is-invalid');
                            $('.errortgl_tar').html(response.error.tgl_tar);
                        }else{
                            $('#tgl_tar').removeClass('is-invalid');
                            $('.errortgl_tar').html('');
                        }
                        if(response.error.ft_awal){
                            $('#ft_awal').addClass('is-invalid');
                            $('.errorft_awal').html(response.error.ft_awal);
                        }else{
                            $('#ft_awal').removeClass('is-invalid');
                            $('.errorft_awal').html('');
                        }
                     }else{
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        })
                        $('#modaladdpat').modal('hide');
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