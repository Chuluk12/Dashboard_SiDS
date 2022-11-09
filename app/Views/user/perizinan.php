<?= $this->extend('user/template');?>
<?= $this->section('content'); ?>  
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $judul;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a >Pengguna</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
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
                    <th>Tanggal</th>
                    <th>Berlaku</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>                        
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;?>
                    <?php foreach($dokumen as $p) : ?>
                        <?php ?>
                  <td class="text-center"><?= $i++;?></td>
                    <td><?= $p['no_izin'];?></td>
                    <td><?= $p['nm_izin'];?></td>
                    <td class="text-center"><?= $p['tgl_izin'];?></td>
                    <td class="text-center"><?= $p[ 'masa_berlaku'];?></td>
                    <td><?= $p[ 'rilis_izin'];?></td>
                    <td class="text-center"><div class="btn-group btn-sm" role="group" aria-label="Basic example">
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