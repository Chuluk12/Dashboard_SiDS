    <?= $this->extend('admin/template');?>
<?= $this->section('content'); ?>  
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Program & Pelatihan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
              <li class="breadcrumb-item active">Program</li>
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
              <button type="button" class="btn btn-sm btn-primary  btntambah" ><i class="fa fa-plus"></i> Program</button>
    <br>
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th>No. </th>
                    <th>No. Program</th>
                    <th>Deskripsi</th>
                    <th>Tipe Peserta</th>
                    <th>Lama Pelaksanaan</th>
                    <th>Aksi</th>                        
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;?>
                    <?php foreach($program as $p) : ?>
                        <?php ?>
                  <td class="text-center"><?= $i++;?></td>
                    <td class="text-center"><?= $p['no_reg'];?></td>
                    <td><?= $p['nm_reg'];?></td>
                    <td class="text-center"><?= $p[ 'tipe_peserta'];?></td>
                    <td><?= $p[ 'lama_pelaksanaan'];?></td>
                    <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Ubah" onclick="edit('<?= $p['id']?>')"><i class=" nav-icon fas fa-edit"></i></button> |
                                                 
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
                    url: "/admin/formaddprogram",
                    dataType: "json",
                    success: function (response){
                        $('.viewmodal').html(response.data).show();

                        $('#modaladdpro').modal('show');
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
                    url: "/admin/editpro",
                    data:{
                        id: id
                    },
                    dataType: "json",
                    success: function (response){
                        if(response.message){
                            $('.viewmodal').html(response.message).show();
                            $('#modaleditpro').modal('show');
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
                // text: 'No. <?= $p['no_reg'];?> - <?= $p['nm_reg'];?>',
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
                    url: "/admin/hapusprogram",
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