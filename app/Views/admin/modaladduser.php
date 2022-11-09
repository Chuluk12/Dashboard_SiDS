<!-- Modal -->
<div class="modal fade" id="modaladduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'adduser']); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <div class="form-group">
        <div class="form-row">
          <div class="col">          
            <label for="id_kar" class="form-label">ID Karyawan</label>
            <input type="text" class="form-control " id="id_kar" name="id_kar" placeholder="Input ID Karyawan" >
            <div class="invalid-feedback errorid_kar">
          </div>
        </div>
    </div>
      </div>

          <div class="form-group">
          <div class="form-row">
          <div class="col">
            <label for="nm_depan">Nama Depan</label>
            <input type="text" class="form-control" id="nm_depan" name="nm_depan" placeholder="Input Nama Depan" style="text-transform:capitalize;">
            <div class="invalid-feedback errornm_depan">
            </div>
          </div>


            <div class="col">
            <label for="nm_belakang">Nama Belakang</label>
            <input type="text" class="form-control" id="nm_belakang" name="nm_belakang" placeholder="Input Nama Belakang" style="text-transform:capitalize;">
            <div class="invalid-feedback errornm_belakang">
            </div>
          </div>
        </div>
      </div>

        <div class="form-group">
        <div class="form-row">
          <div class="col">          
            <label for="tmp_lhr" class="form-label">Tempat </label>
            <input type="text" class="form-control " id="tmp_lhr" name="tmp_lhr" placeholder="Input Tempat Lahir" >
            <div class="invalid-feedback errortmp_lhr">
          </div>
        </div>

          <div class="col">
            <label for="tgl_lhr">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lhr" name="tgl_lhr" placeholder="" >
            <div class="invalid-feedback errortgl_lhr">
            </div>
          </div>
        </div>
        </div>

        <div class="form-group">
        <div class="form-row">
          <div class="col">          
            <label for="email" class="form-label">E-mail </label>
            <input type="inputEmail" class="form-control " id="email" name="email" placeholder="Input E-mail" >
            <div class="invalid-feedback erroremail">
          </div>
        </div>

          <div class="col">
            <label for="telp">No. Telepon</label>
            <input type="text" class="form-control" id="telp" name="telp" placeholder="Input No. Telepon" >
            <div class="invalid-feedback errortelp">
            </div>
          </div>
        </div>
        </div>

        <div class="form-group">
        <div class="form-row">
        <div class="col">  
        <label for="div" >Divisi</label>
          <select class="custom-select " id="div" name="div" placeholder="Pilih Kategori" value="">
          <option selected disabled value="">Pilih Divisi</option>
          <option value="HSE-QA">HSE-QA</option>
          <option value="Marketing">Marketing</option>
          <option value="Purchasing">Purchasing</option>
          <option value="Acounting">Acounting</option>
          <option value="HRGA">HRGA</option>
          <option value="Engineering">Engineering</option>
          <option value="Logistic">Logistic</option>
          <option value="Production">Production</option>
          </select>
          <div class="invalid-feedback errordiv">
          </div>
          </div>
      
        <div class="col">
        <label for="jab" >Jabatan</label>
          <select class="custom-select " id="jab" name="jab" placeholder="Pilih Kategori" value="">
          <option selected disabled value="">Pilih Jabatan</option>
          <option value="Manager">Manager</option>
          <option value="Supervisor">Supervisor</option>
          <option value="Leader">Leader</option>
          <option value="Staff">Staff</option>
          </select>
          <div class="invalid-feedback errorjab">
          </div>
      </div>
    </div>
    </div>

      <div class="form-group">
        <div class="form-row">
          <div class="col">
            <label for="almt">Alamat</label>
            <textarea type="text" class="form-control" id="almt" name="almt" placeholder="Input Alamat" style="text-transform:capitalize;"></textarea>
            <div class="invalid-feedback erroralmt">
            </div>
          </div>
          </div>
          </div>

            <div class="form-group ">
            <label for="foto" class="form-label">Foto <small>(Optional)</small></label>
            <input type="file" class="form-control " id="foto" name="foto" placeholder="Pilih Foto"  >
            <div class="invalid-feedback errorfoto">
            
          </div>
        </div> 

        <div class="form-group">
        <div class="form-row">
          <label for="lvl" > Level Pengguna : </label>
          <br>
          <div class="custom-control custom-radio">
          <input class="form-check-input" type="radio" name="level" id="level1" value="Admin">
          <label class="form-check-label" for="level1">Admin |</label>
        </div>
        <div class="custom-control custom-radio">
          <input class="form-check-input" type="radio" name="level" id="level2" value="User">
          <label class="form-check-label" for="level2">User </label>
          <div class="invalid-feedback errorlevel" >

          
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary btnaddsimpan">Simpan</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<script>
$(document).ready(function (){
  $('.adduser').submit(function(e){
    e.preventDefault();
    let form = $('.adduser')[0];

    let data = new FormData(form);
    $.ajax({
      type: "post",
      url:'/admin/simpanadduser',
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

      success: function (response){
        if(response.error){
          if(response.error.id_kar){
            $('#id_kar').addClass('is-invalid');
            $('.errorid_kar').html(response.error.id_kar);
          }else{
            $('#id_kar').removeClass('is-invalid');
            $('.errorid_kar').html('');
          }
          if(response.error.nm_depan){
            $('#nm_depan').addClass('is-invalid');
            $('.errornm_depan').html(response.error.nm_depan);
          }else{
            $('#nm_depan').removeClass('is-invalid');
            $('.errornm_depan').html('');
          }
          if(response.error.nm_belakang){
            $('#nm_belakang').addClass('is-invalid');
            $('.errornm_belakang').html(response.error.nm_belakang);
          }else{
            $('#nm_belakang').removeClass('is-invalid');
            $('.errornm_belakang').html('');
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
          if(response.error.foto){
            $('#foto').addClass('is-invalid');
            $('.errorfoto').html(response.error.foto);
          }else{
            $('#foto').removeClass('is-invalid');
            $('.errorfoto').html('');
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
        }else{
          Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: response.message,
        })
          $('#modaladduser').modal('hide');
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