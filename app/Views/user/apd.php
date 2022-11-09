<?= $this->extend('user/template');?>
<?= $this->section('content'); ?>  
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Alat Pelindung Diri (APD)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
              <li class="breadcrumb-item active"><?= $title;?></li>
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
                    <th>Jenis APD</th>
                    <th>Nama APD</th>
                    <th>Area</th>
                    <th>Pengguna</th>
                    <th>Aksi</th>                        
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;?>
                    <?php foreach($dokumen as $p) : ?>
                        <?php ?>
                        
                  <td><?= $i++;?></td>
                    <td><?= $p['jenis_apd'];?></td>
                    <td><?= $p['nm_apd'];?></td>
                    <td>
                        <?= $p[ 'area_apd'];?><br>
                        
                    </td>
                    <td>
                        <?= $p[ 'user_apd'];?><br>
                        
                    </td>
                    <td class="text-center"><div class="btn-group btn-sm" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Lihat" onclick="edit('<?= $p['id']?>')"><i class=" nav-icon fas fa-eye"></i></button>
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

            function edit(id){
                $.ajax({
                    type: "post",
                    url: "/user/editapd",
                    data:{
                        id: id
                    },
                    dataType: "json",
                    success: function (response){
                        if(response.message){
                            $('.viewmodal').html(response.message).show();
                            $('#modaleditapd').modal('show');
                        }
                    },
                    error: function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                    }
                });
            }
            </script>
            
<?= $this->endSection('content'); ?>