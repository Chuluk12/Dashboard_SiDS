    <?= $this->extend('admin/template');?>
<?= $this->section('content'); ?>  
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master List Dokumen Standar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Administrasi</a></li>
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
              <div class="card-header">
              <button type="button" class="btn btn-sm btn-primary  btntambah" ><i class="fa fa-plus"></i> Dokumen</button>
    <br>
                <h3 class="card-title"></h3>
              </div>
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
                                                <button type="button" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Ubah" onclick="edit('<?= $p['id']?>')"><i class=" nav-icon fas fa-edit"></i></button> |
                                                <form action="/admin/tampilfile" method="post" class="d-inline" target="_BLANK">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="file" value="<?= $p['dokumen'];?>">
                                                <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Unduh"><i class="fa fa-download"></i></button> |
                                                </form> 
                                            <button type="submit" class="btn btn-danger btn-sm " data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('<?= $p['id']?>')" ><i
                                                    class="fa fa-trash"></i></button>                                             
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

                $(document).ready(function(){
                $('.btntambah').click(function(e){
                e.preventDefault();
                    $.ajax({
                    url: "/admin/formadddokmodal",
                    dataType: "json",
                    success: function (response){
                        $('.viewmodal').html(response.data).show();

                        $('#modaladddok').modal('show');
                    },
                    error: function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                    }
                    });
                });
                });
                const swal = $('.swal').data('swal');
                if (swal){
                    Swal.fire({
                        icon: 'success',
                        text: swal,
                        title: 'Berhasil'                        
                });
            }

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
            
                
            function hapus(id){
                Swal.fire({
                title: 'Anda yakin hapus data ini ?',
              
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: "post",
                    url: "/admin/hapusdok",
                    data:{
                        id: id
                    },
                    dataType: "json",
                    success: function (response){
                        if(response.message){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                            });
                            location.reload();
                        }
                    },
                    error: function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                    }
                });
                }
                })
            }
            </script>
            
<?= $this->endSection('content'); ?>