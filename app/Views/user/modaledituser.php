<!-- Modal -->
<div class="modal fade" id="modaledituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'edituser']); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <div class="text-center">
            <img src="/fotouser/<?=$foto;?>" class="imgs" alt="Responsive image">
            <input type="hidden" class="form-control" name="fotolama" id="fotolama" placeholder="Masukan Nama Depan" value="<?= $foto;?>"> 
            <input type="hidden" class="form-control" name="kd_user" id="kd_user" placeholder="Masukan Nama Depan" value="<?= $kd_user;?>"> 
        </div>
        <br>
        <div class="form-group">
          <div class="form-row">
            <div class="col">
            <label for="id_karyawan">ID Pengguna</label>
            <input type="text" class="form-control" name="id_karyawan" id="id_karyawan" placeholder="Masukan ID Karyawan" value="<?= $id_karyawan;?>">
            <div class="invalid-feedback errorid_karyawan">
            
          </div>            
          </div>
            
        
        <div class="col">
            <label for="nm_user">Nama Lengkap</label>
            <input type="text" class="form-control" name="nm_user" id="nm_user" placeholder="Masukan Nama Depan" value="<?= $nm_user;?>" >
            <div class="invalid-feedback errornm_user">
            
          </div>
            </div>
            </div>
        </div>
        <div class="form-group">
        <div class="form-row">
            <div class="col">
            <label for="divisi" >Divisi</label>
          <select class="custom-select " id="divisi" name="divisi" placeholder="Pilih Kategori" value="">
          <option selected disabled value="">Pilih Divisi</option>
          <option value="HSE-QA" <?= $divisi == "HSE-QA" ? "selected" : "" ?>>HSE-QA</option>
          <option value="Marketing" <?= $divisi == "Marketing" ? "selected" : "" ?>>Marketing</option>
          <option value="Purchasing" <?= $divisi == "Purchasing" ? "selected" : "" ?>>Purchasing</option>
          <option value="Acounting" <?= $divisi == "Acounting" ? "selected" : "" ?>>Acounting</option>
          <option value="HRGA" <?= $divisi == "HRGA" ? "selected" : "" ?>>HRGA</option>
          <option value="Engineering" <?= $divisi == "Engineering" ? "selected" : "" ?>>Engineering</option>
          <option value="Logistic" <?= $divisi == "Logistic" ? "selected" : "" ?>>Logistic</option>
          <option value="Production" <?= $divisi == "Production" ? "selected" : "" ?>>Production</option>
          </select>
          <div class="invalid-feedback errordivisi">
            
          </div>
          </div>
          <div class="col">
          <label for="jabatan" >Jabatan</label>
          <select class="custom-select " id="jabatan" name="jabatan" placeholder="Pilih Kategori" value="">
          <option selected disabled value="">Pilih Jabatan</option>
          <option value="Manager" <?= $jabatan == "Manager" ? "selected" : "" ?>>Manager</option>
          <option value="Supervisor" <?= $jabatan == "Supervisor" ? "selected" : "" ?>>Supervisor</option>
          <option value="Leader" <?= $jabatan == "Leader" ? "selected" : "" ?>>Leader</option>
          <option value="Staff" <?= $jabatan == "Staff" ? "selected" : "" ?>>Staff</option>
          </select>
          <div class="invalid-feedback errorjabatan">
            
          </div>
        </div>
        </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username" value="<?= $pass;?>" >
            <div class="invalid-feedback errorusername">
            
          </div>
        </div>
        <div class="col">
            <label for="pass">Password</label>
            <input type="text" class="form-control" name="pass" id="pass" placeholder="Password" value="<?= $pass;?>">
            <div class="invalid-feedback errorpass">
            
          </div>
            </div>
        </div>
        <div class="form-group ">
            <label for="foto" class="form-label">Foto  <small>(Optional)</small></label>
            <input type="file" class="form-control " id="foto" name="foto" placeholder="Pilih Foto"  >
            <div class="invalid-feedback errorfoto">            
          </div>
        </div> 
        <div class="form-group">
          <label for="jabatan" >Level Pengguna </label>
          <br>
          <div class="custom-control custom-radio">
          <input class="form-check-input" type="radio" name="level" id="level1" value="Admin" <?= $kt_user == "Admin" ? "checked" : "" ?>>
          <label class="form-check-label" for="level1">Admin</label>
        </div>
        <div class="custom-control custom-radio">
          <input class="form-check-input" type="radio" name="level" id="level2" value="User" <?= $kt_user == "User" ? "checked" : "" ?>>
          <label class="form-check-label" for="level2">User </label>
          <div class="invalid-feedback errorlevel" >

          
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary btneditsimpan">Simpan</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<script>
$(document).ready(function (){
  $('.edituser').submit(function(e){
    e.preventDefault();
    let form = $('.edituser')[0];

    let data = new FormData(form);
    $.ajax({
      type: "post",
      url:'/admin/simpanedituser',
      data: data,
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,                
      dataType: "json",

      beforeSend: function(){
        $('.btneditsimpan').attr('disable', 'disabled');
        $('.btneditsimpan').html('Proses');
      },

      complete: function(){
        $('.btneditsimpan').removeAttr('disable');
        $('.btneditsimpan').html('Simpan');
      },

      success: function (response){
        if(response.error){
          if(response.error.id_karyawan){
            $('#id_karyawan').addClass('is-invalid');
            $('.errorid_karyawan').html(response.error.id_karyawan);
          }else{
            $('#id_karyawan').removeClass('is-invalid');
            $('.errorid_karyawan').html('');
          }
          if(response.error.nm_user){
            $('#nm_user').addClass('is-invalid');
            $('.errornm_user').html(response.error.nm_user);
          }else{
            $('#nm_user').removeClass('is-invalid');
            $('.errornm_user').html('');
          }
          if(response.error.divisi){
            $('#divisi').addClass('is-invalid');
            $('.errordivisi').html(response.error.divisi);
          }else{
            $('#divisi').removeClass('is-invalid');
            $('.errordivisi').html('');
          }
          if(response.error.jabatan){
            $('#jabatan').addClass('is-invalid');
            $('.errorjabatan').html(response.error.jabatan);
          }else{
            $('#jabatan').removeClass('is-invalid');
            $('.errorjabatan').html('');
          }
          if(response.error.username){
            $('#username').addClass('is-invalid');
            $('.errorusername').html(response.error.username);
          }else{
            $('#username').removeClass('is-invalid');
            $('.errorusername').html('');
          }
          if(response.error.pass){
            $('#pass').addClass('is-invalid');
            $('.errorpass').html(response.error.pass);
          }else{
            $('#pass').removeClass('is-invalid');
            $('.errorpass').html('');
          }
          if(response.error.level){
            $('#level1').addClass('is-invalid');
            $('.errorlevel').html(response.error.level);
          }else{
            $('#level1').removeClass('is-invalid');
            $('.errorlevel').html('');
          }
          if(response.error.level){
            $('#level2').addClass('is-invalid');
            $('.errorlevel').html(response.error.level);
          }else{
            $('#level2').removeClass('is-invalid');
            $('.errorlevel').html('');
          }
          if(response.error.foto){
            $('#foto').addClass('is-invalid');
            $('.errorfoto').html(response.error.file);
          }else{
            $('#foto').removeClass('is-invalid');
            $('.errorfoto').html('');
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