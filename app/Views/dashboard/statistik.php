<?= $this->extend('dashboard/template/dashboard_template') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Statistik</h1>
  </div>


  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header">
          <h4> Statistik Peserta </h4>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <!-- Area Chart -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Statistik Peserta Berdasarkan Tingkat Sekolah</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-sm-12 mb-5">
                  <div class="chart-area" data-sd="<?= getDataSekolah('SD') ?>" data-smp="<?= getDataSekolah('SMP') ?>" data-sma="<?= getDataSekolah('SMA') ?>">
                    <canvas id="statistik-peserta"></canvas>
                  </div>
                  <h6 class="text-count-all mb-n2 text-right font-weight-bold text-primary">Jumlah Peserta : </h6>
                </div>
                <div class="col-md-6 col-sm-12">
                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl col-md mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">SD</div>
                            <div class="text-count-sd h5 mb-0 font-weight-bold text-gray-800"></div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl col-md mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">SMP</div>
                            <div class="text-count-smp h5 mb-0 font-weight-bold text-gray-800"></div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl col-md mb-4">
                    <div class="card border-left-dark shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">SMA</div>
                            <div class="text-count-sma h5 mb-0 font-weight-bold text-gray-800"></div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?= $this->endSection() ?>