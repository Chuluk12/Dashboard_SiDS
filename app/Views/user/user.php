<?= $this->extend('admin/template');?>
<?= $this->section('content'); ?>  
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Administrasi</a></li>
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
              <div class="card-header">
                <button type="button" class="btn btn-sm btn-primary btntambah" ><i class="fa fa-plus"></i> Pengguna</button>
                  <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
    <table id="dataTable2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Pengguna</th>
                    <th>Nama Pengguna</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                    <tbody>
                    <?php $i = 1;?>
                    <?php foreach($dokumen as $p) : ?>
                        <?php ?>
                            <tr>
                            <td><?= $i++;?></td>
                            <td><?= $p['id_karyawan'];?></td>
                            <td><?= $p['nm_user'];?></td>
                            <td><?= $p['divisi'];?></td>
                            <td><?= $p['jabatan'];?></td>
                            <td><?= $p[ 'kt_user'];?></td>
                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Ubah" onclick="edit('<?= $p['kd_user']?>')"><i class=" nav-icon fas fa-edit"></i></button>
                                               
                                            <button type="submit" class="btn btn-danger btn-sm " data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('<?= $p['kd_user']?>')" ><i
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
                $('#nav_user').addClass('active');
            $(document).ready(function(){

                $('.btntambah').click(function(e){
                e.preventDefault();
                    $.ajax({
                    url: "/admin/formadduser",
                    dataType: "json",
                    success: function (response){
                        $('.viewmodal').html(response.data).show();

                        $('#modaladduser').modal('show');
                    },
                    error: function(xhr, ajaxOptions, throwError){
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                    }
                    });
                });
            });
            function edit(kd_user){
                $.ajax({
                    type: "post",
                    url: "/admin/edituser",
                    data:{
                        kd_user: kd_user
                    },
                    dataType: "json",
                    success: function (response){
                        if(response.message){
                            $('.viewmodal').html(response.message).show();
                            $('#modaledituser').modal('show');
                        }
                    },
                    error: function(xhr, ajaxOptions, throwError){
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                    }
                });
            }
            function hapus(kd_user){
                Swal.fire({
                title: 'Hapus?',
                text: 'Yakin menghapus data user ini ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Tidak',
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: "post",
                    url: "/admin/hapususer",
                    data:{
                        kd_user: kd_user
                    },
                    dataType: "json",
                    success: function (response){
                        if(response.message){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                            });
                            setInterval( () => {
                                location.reload();
                            }, 1500);
                            
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
                </div>
            </div>
<?= $this->endSection('content'); ?>