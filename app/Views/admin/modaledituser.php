<!-- Modal -->
<div class="modal fade" id="modaledituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Perubahan </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formedituser']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <input type="hidden" class="form-control " id="id" name="id" placeholder="Input Nomor Dokumen" value="<?=$id?>">
      <div class="form-group ">
        <div class="form-row">
          <div class="col">
            <label for="id_kar" class="form-label">NIK</label>
            <input type="text" class="form-control " id="id_kar" name="id_kar" placeholder="Input Nomor Perizinan" value="<?= $id_karyawan;?>" readonly>
            <div class="invalid-feedback errorid_kar">
            
          </div>
        </div>
        
        <div class="col">
            
          <label for="nm_user" class="form-label">Nama</label>
            <input type="text" class="form-control " id="nm_user" name="nm_user" placeholder="Input Penerbit" value="<?= $nm_user;?>" >
            <div class="invalid-feedback errornm_user">
            
          </div>
        </div>
    </div>
</div>

        <div class="form-group">
        <div class="form-row">
            <div class="col">
            <label for="div" >Divisi</label>
          <select class="custom-select " id="div" name="div" placeholder="Pilih Kategori" value="">
          <option selected disabled value="" >Pilih Divisi</option>
          <option value="HSE-QA" <?= $divisi == "HSE-QA" ? "selected" : "" ?> >HSE-QA</option>
          <option value="Marketing" <?= $divisi == "Marketing" ? "selected" : "" ?> >Marketing</option>
          <option value="Purchasing" <?= $divisi == "Purchasing" ? "selected" : "" ?> >Purchasing</option>
          <option value="Acounting" <?= $divisi == "Acounting" ? "selected" : "" ?> >Acounting</option>
          <option value="HRGA" <?= $divisi == "HRGA" ? "selected" : "" ?> >HRGA</option>
          <option value="Engineering" <?= $divisi == "Engineering" ? "selected" : "" ?> >Engineering</option>
          <option value="Logistic" <?= $divisi == "Logistic" ? "selected" : "" ?> >Logistic</option>
          <option value="Production" <?= $divisi == "Production" ? "selected" : "" ?> >Production</option>
          </select>
          <div class="invalid-feedback errordiv">
            
          </div>
          </div>
          <div class="col">
          <label for="jab" >Jabatan</label>
          <select class="custom-select " id="jab" name="jab" placeholder="Pilih Kategori" value="">
          <option selected disabled value="" >Pilih Jabatan</option>
          <option value="Manager" <?= $jabatan == "Manager" ? "selected" : "" ?> >Manager</option>
          <option value="Supervisor" <?= $jabatan == "Supervisor" ? "selected" : "" ?> >Supervisor</option>
          <option value="Leader" <?= $jabatan == "Leader" ? "selected" : "" ?> >Leader</option>
          <option value="Staff" <?= $jabatan == "Staff" ? "selected" : "" ?> >Staff</option>
          </select>
          <div class="invalid-feedback errorjab">
            
          </div>
        </div>
        </div>
        </div>


        <div class="form-group ">
            <label for="tmp_lhr">Tempat</label>
            <input type="text" class="form-control" id="tmp_lhr" name="tmp_lhr" placeholder="Input Tempat Lahir" style="text-transform:capitalize;" value="<?= $tmp_lahir;?>" >
            <div class="invalid-feedback errortmp_lhr">
            
          </div>
        </div>

        <div class="form-group ">
            <div class="form-row">
          <div class="col">
            <label for="tgl_lhr">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lhr" name="tgl_lhr" placeholder="" value="<?= $tgl_lahir;?>">
            <div class="invalid-feedback errortgl_lhr">
            
          </div>
        </div>
    </div>
</div>

        <div class="form-group">
        <div class="form-row">
          <div class="col">          
            <label for="email" class="form-label">E-mail </label>
            <input type="inputEmail" class="form-control " id="email" name="email" placeholder="Input E-mail" value="<?= $email;?>">
            <div class="invalid-feedback erroremail">
          </div>
        </div>

          <div class="col">
            <label for="telp">No. Telepon</label>
            <input type="text" class="form-control" id="telp" name="telp" placeholder="Input No. Telepon" value="<?= $no_telp;?>" >
            <div class="invalid-feedback errortelp">
            </div>
          </div>
        </div>
        </div>

        <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="almt" class="form-label">Alamat</label>
            <textarea type="text" class="form-control" id="almt" name="almt" placeholder="Input Alamat" style="text-transform:capitalize;" ></textarea>
            <div class="invalid-feedback erroralmt">
            </div>
          </div>
          </div>
          </div>

        <div class="form-group">
        <div class="form-row">
          <label for="lvl" > Level Pengguna : </label>
          <br>
          <div class="custom-control custom-radio">
          <input class="form-check-input" type="radio" name="level" id="level1" value="Admin" <?= $kt_user == "Admin" ? "checked" : "" ?>>
          <label class="form-check-label" for="level1">Admin |</label>
        </div>
        <div class="custom-control custom-radio">
          <input class="form-check-input" type="radio" name="level" id="level2" value="User" <?= $kt_user == "User" ? "checked" : "" ?>>
          <label class="form-check-label" for="level2">User </label>
          <div class="invalid-feedback errorlevel" >
          </div>
          </div>
          </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btneditsimpan">Simpan</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('.btneditsimpan').click(function(e){
            e.preventDefault();
            let form = $('.formedituser')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpanedituserpak',
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
                if(response.error.nm_user){
                $('#nm_user').addClass('is-invalid');
                $('.errornm_user').html(response.error.nm_user);
              }else{
                $('#nm_user').removeClass('is-invalid');
                $('.errornm_user').html('');
              }
              if(response.error.tmp_lhr){
                $('#tmp_lhr').addClass('is-invalid');
                $('.errortmp_lhr').html(response.error.tmp_lhr);
              }else{
                $('#tmp_lhr').removeClass('is-invalid');
                $('.errortmp_lhr').html('');
              }
              if(response.error.tgl_lhr){
                $('#tgl_lhr').addClass('is-invalid');
                $('.errortgl_lhr').html(response.error.tgl_lhr);
              }else{
                $('#tgl_lhr').removeClass('is-invalid');
                $('.errortgl_lhr').html('');
              }
              if(response.error.email){
                $('#email').addClass('is-invalid');
                $('.erroremail').html(response.error.email);
              }else{
                $('#email').removeClass('is-invalid');
                $('.erroremail').html('');
              }
              if(response.error.telp){
                $('#telp').addClass('is-invalid');
                $('.errortelp').html(response.error.telp);
              }else{
                $('#telp').removeClass('is-invalid');
                $('.errortelp').html('');
              }
              if(response.error.almt){
                $('#almt').addClass('is-invalid');
                $('.erroralmt').html(response.error.almt);
              }else{
                $('#almt').removeClass('is-invalid');
                $('.erroralmt').html('');
              }
              if(response.error.div){
                $('#div').addClass('is-invalid');
                $('.errordiv').html(response.error.div);
              }else{
                $('#div').removeClass('is-invalid');
                $('.errordiv').html('');
              }
              if(response.error.jab){
                $('#jab').addClass('is-invalid');
                $('.errorjab').html(response.error.jab);
              }else{
                $('#jab').removeClass('is-invalid');
                $('.errorjab').html('');
              }
              if(response.error.lvl){
                $('#lvl').addClass('is-invalid');
                $('.errorlvl').html(response.error.lvl);
              }else{
                $('#lvl').removeClass('is-invalid');
                $('.errorlvl').html('');
              }
              }else{
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        })
                        $('#modaledituser').modal('hide');
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