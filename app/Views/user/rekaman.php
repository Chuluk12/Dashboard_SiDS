<?= $this->extend('user/template');?>
<?= $this->section('content'); ?>  
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Dokumen Rekaman</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Administrasi</a></li>
              <li class="breadcrumb-item active">Dokumen Rekaman</li>
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
              <button type="button" class="btn btn-sm btn-primary  btntambah" ><i class="fa fa-plus"></i> Rekaman</button>
    <br>
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th>No. </th>
                    <th>No. Dok</th>
                    <th>Deskirpsi</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Lama Simpan</th>
                    <th>Pemusnahan</th>
                    <th>Status</th>
                    <th>Aksi</th>                        
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;?>
                    <?php foreach($dokumen as $p) : ?>
                        <?php ?>
                  <td class="text-center"><?= $i++;?></td>
                    <td><?= $p['no_dok'];?></td>
                    <td><?= $p['nm_dok'];?></td>
                    <td class="text-center"><?= $p['kategori'];?></td>
                    <td class="text-center"><?= $p[ 'lokasi'];?></td>
                    <td><?= $p[ 'lama_simpan'];?></td>
                    <td><?= $p[ 'cara_musnah'];?></td>
                    <td><?= $p[ 'status'];?></td>
                    <td class="text-center">
                                                <form action="/admin/tampilfile" method="post" class="d-inline" target="_BLANK">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="file" value="<?= $p['dokumen'];?>">
                                                <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Unduh"><i class="fa fa-download"></i></button> 
                                                </form> 
                                                                                        
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
                    url: "/admin/formaddrekmodal",
                    dataType: "json",
                    success: function (response){
                        $('.viewmodal').html(response.data).show();

                        $('#modaladdrek').modal('show');
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
                    url: "/admin/editrek",
                    data:{
                        id: id
                    },
                    dataType: "json",
                    success: function (response){
                        if(response.message){
                            $('.viewmodal').html(response.message).show();
                            $('#modaleditrek').modal('show');
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
                    url: "/admin/hapusrek",
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