    <?= $this->extend('user/template');?>
<?= $this->section('content'); ?>  
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Profil Pengguna</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Data Pribadi Karyawan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                   <div class="form-row">
                    <div class="col">
                    <label for="id_kar" class="form-label">ID Karyawan</label>
                   <input type="text" class="form-control " id="id_kar" name="id_kar" placeholder="Input ID Karyawan"  readonly>
                  </div>

                  <div class="col">
                    <label for="nm_kar" class="form-label">Nama Karyawan</label>
                   <input type="text" class="form-control " id="nm_kar" name="nm_kar" placeholder="Input Nama Karyawan"  readonly>
                  </div>
                  </div>
                  </div>

                  <div class="form-group">
                   <div class="form-row">
                    <div class="col">
                    <label for="div" class="form-label">Divisi</label>
                   <input type="text" class="form-control " id="divisi" name="divisi" placeholder="Input Divisi Karyawan"  readonly>
                  </div>

                  <div class="col">
                    <label for="jab" class="form-label">Jabatan</label>
                   <input type="text" class="form-control " id="jab" name="jab" placeholder="Input Jabatan Karyawan"  readonly>
                  </div>
                  </div>
                  </div>

                  <div class="form-group">
                   <div class="form-row">
                    <div class="col">
                   <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>

                  <div class="col">
                    <label for="exampleInputPassword2">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                  </div>
                  </div>
                  </div>

                  <div class="form-group">
                   <div class="form-row">
                    <div class="col">
                    <label for="almt" class="form-label">Alamat</label>
                   <textarea type="text" name="almt" class="form-control" id="almt" placeholder="Alamat Karyawan" value="" >  </textarea>
                  </div>
                  </div>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


                
                




    </section>
            <div class="viewmodal" style="display: none;"></div>
            <script>
                $('#nav_dokumen').addClass('active');
                $(function () {
                  $('[data-toggle="tooltip"]').tooltip()
                });

            function edit(id){
                $.ajax({
                    type: "post",
                    url: "/admin/editdok",
                    data:{
                        id: id
                    },
                    dataType: "json",
                    success: function (response){
                        if(response.message){
                            $('.viewmodal').html(response.message).show();
                            $('#modaleditdok').modal('show');
                        }
                    },
                    error: function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                    }
                });
            }
</script>
            
<?= $this->endSection('content'); ?>