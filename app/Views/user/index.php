<?= $this->extend('user/template');?>
<?= $this->section('content'); ?>

<!-- bootstrap cdn  --> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<!-- fullcalendar css  -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.css' rel='stylesheet' />

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-5">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $doksids;?></h3>

                <p> Dokumen Standar</p>
              </div>
              <div class="icon">
                <i class="fas fa-columns"></i>
              </div>
              <a href="/user/dokumen" class="small-box-footer">Lihat ! <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-5">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?=$rekaman;?><sup style="font-size: 20px"></sup></h3>

                <p> Rekaman Dokumen</p>
              </div>
              <div class="icon">
                <i class="fas fa-clipboard"></i>
              </div>
              <a href="/user/rekaman" class="small-box-footer">Lihat ! <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-5">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$izin;?><sup style="font-size: 20px"></sup></h3>

                <p> Perizinan &
                   Non-Perizinan</p>
              </div>
              <div class="icon">
                <i class="fas fa-copy"></i>
              </div>
              <a href="/user/perizinan" class="small-box-footer">Lihat ! <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-4 col-5">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$insiden;?></h3>

                <p> Kecelakaan Kerja</p>
              </div>
              <div class="icon">
                <i class="fas fa-shield-virus"></i>
              </div>
              <a href="#" class="small-box-footer">Lihat ! <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-5">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$patrol;?><sup style="font-size: 20px"></sup></h3>

                <p> Patrol / Inspeksi</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-nurse"></i>
              </div>
              <a href="/user/patrol" class="small-box-footer">Lihat ! <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-5">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$apd;?><sup style="font-size: 20px"></sup></h3>

                <p> Alat Pelindung Diri (APD)</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-shield"></i>
              </div>
              <a href="/user/apd" class="small-box-footer">Lihat ! <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>      
              
<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"></h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Pelatihan</a>
                      <a href="#" class="dropdown-item">Safety Induction</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong> Jadwal Kegiatan </strong>
                    </p>

                    <div class="col-lg-12">
                    <div id="calendar"></div>
                </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Pencapaian Kegiatan (DEMO)</strong>
                    </p>

                    <div class="progress-group">
                      Matrik Kompetensi
                      <span class="float-right"><b>60</b>/100</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 60%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Pelatihan K3
                      <span class="float-right"><b>80</b>/100</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 80%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Safety Induction</span>
                      <span class="float-right"><b>55</b>/70</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 55%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Pengenalan Produk
                      <span class="float-right"><b>7</b>/10</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 70%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

    <!-- Awal Section -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: [<?php 

    //melakukan koneksi ke database
    $koneksi    = mysqli_connect('localhost', 'root', '', 'db_sids');
    //mengambil data dari tabel jadwal
    $data       = mysqli_query($koneksi,'select * from tb_kegiatan');
    //melakukan looping
    while($d = mysqli_fetch_array($data)){     
?>
{
    title: '<?php echo $d['kegiatan']; ?>', //menampilkan title dari tabel
    start: '<?php echo $d['mulai']; ?>', //menampilkan tgl mulai dari tabel
    end: '<?php echo $d['selesai']; ?>' //menampilkan tgl selesai dari tabel
},
<?php } ?> ],
                    selectOverlap: function (event) {
                        return event.rendering === 'background';
                    }
                });
    
                calendar.render();
            });
</script>

  <?= $this->endSection('content'); ?>