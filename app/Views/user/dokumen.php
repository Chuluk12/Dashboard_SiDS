    <?= $this->extend('user/template');?>
<?= $this->section('content'); ?>  
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master List Dokumen Standar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
              <li class="breadcrumb-item active">Dokumen Standar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th>No. </th>
                    <th>No. Dokumen</th>
                    <th>Deskirpsi</th>
                    <th>Revisi</th>
                    <th>Tanggal</th>
                    <th>Dokumen</th>
                    <th>Aksi</th>                        
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;?>
                    <?php foreach($dokumen as $p) : ?>
                        <?php ?>
                  <td class="text-center"><?= $i++;?></td>
                    <td class="text-center"><?= $p['kd_dokumen'];?></td>
                    <td><?= $p['nm_dokumen'];?></td>
                    <td class="text-center"><?= $p['revisi_dokumen'];?></td>
                    <td class="text-center"><?= $p[ 'tgl_update'];?></td>
                    <td><?= $p[ 'kt_dokumen'];?></td>
                    <td class="text-center">
                                                <div class="btn-group btn-sm" role="group" aria-label="Basic example">
                                                <form action="/user/tampilfile" method="post" class="d-inline" target="_BLANK">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="file" value="<?= $p['dokumen'];?>">
                                                <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Unduh"><i class="fa fa-download"></i></button>
                                                </form> 
                                                </div>
                    </td> 
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
            <div class="viewmodal" style="display: none;"></div>
            <script>
                $('#nav_dokumen').addClass('active');
                $(function () {
                  $('[data-toggle="tooltip"]').tooltip()
                });

                                
            </script>
            
<?= $this->endSection('content'); ?>