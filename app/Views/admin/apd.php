<?= $this->extend('admin/template');?>
<?= $this->section('content'); ?>  
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Alat Pelindung Diri (APD)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Administrasi</a></li>
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
              <div class="card-header">
              <button type="button" class="btn btn-sm btn-primary  btntambah" ><i class="fa fa-plus"></i> APD</button>
    <br>
                <h3 class="card-title"></h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable2" class="table table-bordered table-striped">
                  <thead class="text-center">
                  <tr>
                    <th>No. </th>
                    <th>Jenis APD</th>
                    <th>Nama APD</th>
                    <th>Peggunaan</th>
                    <th>Area</th>
                    <th>Stok</th>
                    <th>Aksi</th>                        
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;?>
                    <?php foreach($dokumen as $p) : ?>
                        <?php ?>
                        
                  <td class="text-center"><?= $i++;?></td>
                    <td><?= $p['jenis_apd'];?></td>
                    <td><?= $p['nm_apd'];?></td>
                    
                    <td>
                        <?= $p[ 'user_apd'];?>
                                            <br>
                        
                    </td>
                    <td>
                        <?= $p[ 'area_apd'];?>
                                            <br>
                        
                    </td>
                    <td class="text-right"><?= $p[ 'stok'];?></td>
                    <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Ubah" onclick="edit('<?= $p['id']?>')"><i class=" nav-icon fas fa-edit"></i></button> |
                                                         <button type="button" class="btn btn-info btn-sm"  data-toggle="tooltip" data-placement="top" title="Detail" onclick="detail('<?= $p['id']?>')"><i class=" nav-icon fas fa-eye"></i></button> |
                                                         
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
                    url: "/admin/formaddapdmodal",
                    dataType: "json",
                    success: function (response){
                        $('.viewmodal').html(response.data).show();

                        $('#modaladdapd').modal('show');
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
                    url: "/admin/editapd",
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
            function detail(id){
                $.ajax({
                    type: "post",
                    url: "/admin/fotoapd",
                    data:{
                        id: id
                    },
                    dataType: "json",
                    success: function (response){
                        if(response.message){
                            $('.viewmodal').html(response.message).show();
                            $('#modalfotoapd').modal('show');
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
                    url: "/admin/hapusapd",
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