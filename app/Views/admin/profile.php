    <?= $this->extend('admin/template');?>
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
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row" id="load_data">
          <!-- left column -->
          <div class="col">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Identitas Karyawan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                   <div class="form-row">
                    <div class="col">
                    <label for="id_kar" class="form-label">ID</label>
                   <input type="text" class="form-control " id="id_kar" name="id_kar" placeholder="ID Karyawan" value="" readonly>
                  </div>

                  <div class="col">
                    <label for="nm_kar" class="form-label">Nama </label>
                   <input type="text" class="form-control " id="nm_kar" name="nm_kar" placeholder="Nama Karyawan" value="" readonly>
                  </div>
                  </div>
                  </div>

                  <div class="form-group">
                   <div class="form-row">
                    <div class="col">
                    <label for="div" class="form-label">Divisi</label>
                   <input type="text" class="form-control " id="divisi" name="divisi" placeholder="Divisi Karyawan" value="" readonly>
                  </div>

                  <div class="col">
                    <label for="jab" class="form-label">Jabatan</label>
                   <input type="text" class="form-control " id="jab" name="jab" placeholder="Jabatan Karyawan" value=""  readonly>
                  </div>
                  </div>
                  </div>

                  <div class="form-group">
                   <div class="form-row">
                    <div class="col">
                    <label for="tmp_lhr" class="form-label">Tempat Lahir</label>
                   <input type="text" class="form-control " id="tmp_lhr" name="tmp_lhr" placeholder="Tempat Lahir" value="" readonly>
                  </div>

                  <div class="col">
                    <label for="tgl_lhr" class="form-label">Tanggal Lahir</label>
                   <input type="date" class="form-control " id="tgl_lhr" name="tgl_lhr" placeholder="" value=""  readonly>
                  </div>
                  

                  <div class="col">
                  <label for="email" class="form-label">E-mail</label>
                   <input type="text" class="form-control " id="email" name="email" placeholder="" value=""  readonly>
                  </div>
                  

                  <div class="col">
                  <label for="telp" class="form-label">Telepon</label>
                  <input type="text" class="form-control " id="telp" name="telp" placeholder="" value=""  >
                  </div>
                  </div>
                  </div>
                  

                  <div class="form-group">
                   <div class="form-row">
                    <div class="col">
                   <label for="exampleInputPassword1">Password*</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>

                  <div class="col">
                    <label for="exampleInputPassword2">Konfirmasi Password*</label>
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


<?= $this->endSection('content'); ?>