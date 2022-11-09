<!-- Modal -->
<div class="modal fade" id="modaladddok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Dokumen Standar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('', ['class' => 'formadddok']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      <div class="form-group ">
        <div class="form-row">
          <div class="col">
        <label for="pilih_kt" >Kategori Dokumen</label>
          <select class="custom-select" id="pilih_kt" name="pilih_kt" value="">
          <option selected disabled value=""  >Kategori Dokumen</option>
          <option value="Prosedur">Prosedur</option>
          <option value="Intruksi Kerja">Intruksi Kerja</option>
          <option value="Formulir">Formulir</option>
          <option value="Dokumen Lain-Lain">Dokumen Lain-lain</option>
          </select>
          <div class="invalid-feedback errorpilih_kt">
            
          </div>
        </div>
        <div class="col">
        <label for="pilih_status" >Status</label>
          <select class="custom-select" id="pilih_status" name="pilih_status" value="">
          <option selected disabled value=""  >Status Dokumen</option>
          <option value="Rahasia">Rahasia</option>
          <option value="Umum">Umum</option>
          </select>
          <div class="invalid-feedback errorpilih_status">
            
          </div>
        </div>
    </div>
</div>
        <div class="form-group ">
            <label for="no_dok" class="form-label">No. Dokumen</label>
            <input type="text" class="form-control " id="no_dok" name="no_dok" placeholder="Input Nomor Dokumen" >
            <div class="invalid-feedback errorno_dok">
            
          </div>
        </div>
        
        <div class="form-group ">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control " id="deskripsi" name="deskripsi" placeholder="Input Deskripsi"  >
            <div class="invalid-feedback errordeskripsi">
            
          </div>
        </div>

        <div class="form-group ">
            <div class="form-row">
          <div class="col">
            <label for="tgl" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tgl" name="tgl"  >
            <div class="invalid-feedback errortgl">
            
          </div>
        </div>
        <div class="col">
            <label for="tgl_dis" class="form-label"> Distribusi</label>
            <input type="date" class="form-control" id="tgl_dis" name="tgl_dis"  >
            <div class="invalid-feedback errortgl_dis">
            
          </div>
        </div>
    </div>
    </div>

        <div class="form-group ">
        <label for="pemilik" >Pemilik Dokumen</label>
          <select class="custom-select" id="pemilik" name="pemilik" value="">
          <option selected disabled value=""  >Pilih Pemilik Dokumen</option>
          <option value="Accounting & Finance">Accounting & Finance</option>
          <option value="Engineering">Engineering</option>
          <option value="HRGA">HRGA</option>
          <option value="HSE-QA">HSE-QA</option>
          <option value="Logistic">Logistic</option>
          <option value="Marketing">Marketing</option>
          <option value="Production">Production</option>
          <option value="Purchasing">Purchasing</option>
          <option value="QC">Quality Control</option>
          <option value="Warehouse">Warehouse</option>
          </select>
          <div class="invalid-feedback errorpemilik"> 
        </div>
        </div>
    

        <div class="form-group ">
            <label for="dokumen" class="form-label">Upload Dokumen</label>
            <input type="file" class="form-control " id="dokumen" name="dokumen" placeholder="Pilih Dokumen"  >
            *max upload file 2Mb
            <div class="invalid-feedback errordokumen">
            
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
</div>
<script>
    $(document).ready(function(){
        $('.btnaddsimpan').click(function(e){
            e.preventDefault();
            let form = $('.formadddok')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url:'/admin/simpanadddokmodal',
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
                        if(response.error.pilih_kt){
                            $('#pilih_kt').addClass('is-invalid');
                            $('.errorpilih_kt').html(response.error.pilih_kt);
                        }else{
                            $('#pilih_kt').removeClass('is-invalid');
                            $('.errorpilih_kt').html('');
                        }
                        if(response.error.pilih_status){
                            $('#pilih_status').addClass('is-invalid');
                            $('.errorpilih_status').html(response.error.pilih_status);
                        }else{
                            $('#pilih_status').removeClass('is-invalid');
                            $('.errorpilih_status').html('');
                        }
                        if(response.error.no_dok){
                            $('#no_dok').addClass('is-invalid');
                            $('.errorno_dok').html(response.error.no_dok);
                        }else{
                            $('#no_dok').removeClass('is-invalid');
                            $('.errorno_dok').html('');
                        }
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
                        if(response.error.tgl_dis){
                            $('#tgl_dis').addClass('is-invalid');
                            $('.errortgl_dis').html(response.error.tgl_dis);
                        }else{
                            $('#tgl_dis').removeClass('is-invalid');
                            $('.errortgl_dis').html('');
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
                        $('#modaladddok').modal('hide');
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