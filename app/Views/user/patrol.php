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
              <!-- <button type="button" class="btn btn-sm btn-primary  btntambah" ><i class="fa fa-plus"></i> Temuan Patrol</button> -->
    <br> 
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th>No. </th>
                    <th>No. Patrol</th>
                    <th>Tgl. Patrol</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Deskripsi Temuan</th>
                    <th>Status</th>
                    <th>Aksi</th>                        
                  </tr>
                  </thead> 
                  <tbody>
                    <?php $i = 1;?>
                    <?php foreach($dokumen as $p) : ?>
                        <?php ?>
                  <td class="text-center"><?= $i++;?></td>
                    <td><?= $p['nomor'];?></td>
                    <td class="text-center"><?= $p['tgl_patrol'];?></td>
                    <td><?= $p[ 'lokasi'];?></td>
                    <td><?= $p[ 'kategori'];?></td>
                    <td><?= $p[ 'deskripsi_bahaya'];?></td>
                    <td class="text-center"><?= $p[ 'status'];?></td>
                    <td class="text-center">                                            
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
                    url: "/admin/formaddpat",
                    dataType: "json",
                    success: function (response){
                        $('.viewmodal').html(response.data).show();

                        $('#modaladdpat').modal('show');
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
                    url: "/admin/editpat",
                    data:{
                        id: id
                    },
                    dataType: "json",
                    success: function (response){
                        if(response.message){
                            $('.viewmodal').html(response.message).show();
                            $('#modaleditpat').modal('show');
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
                    url: "/admin/hapuspat",
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