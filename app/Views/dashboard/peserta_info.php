<?= $this->extend('dashboard/template/dashboard_template') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $page ?></h1>
  </div>

  <!-- Content Row -->

  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header">
          <h4 class="d-inline my-auto"> Selamat Datang <?= session()->get('name') ?> </h4>
          <?php if ($peserta['status'] < 3) : ?>
            <button class="btn btn-success float-right" id="pay-button"> <i class="fas fa-fw fa-money-bill-alt mr-1"></i> Bayar </button>
          <?php endif; ?>
          <?php if ($peserta['status'] == 3) : ?>
            <a href="<?= base_url('/cetak') . "/{$peserta['pin']}" ?>" target="_blank" class="btn btn-success mr-2 float-right"><i class="fa fa-fw fa-print"></i> Cetak Kartu Peserta </a>
          <?php endif ?>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <?php if (session()->getFlashdata('fail')) {
            generateFlashData('error', session()->getFlashdata('fail'));
          } else if (session()->getFlashdata('success')) {
            generateFlashData('success', session()->getFlashdata('success'));
          } ?>
          <?php ($peserta['status'] == 1) ? generateFlashDataV2('danger', 'Silahkan Lakukan Verifikasi Pembayaran Terlebih Dahulu') : '' ?>
          <?php ($peserta['status'] == 2) ? generateFlashDataV2('warning', 'Silahkan Tunggu Verifikasi Pembayaran Terlebih Dahulu') : '' ?>
          <?php ($peserta['status'] == 3) ? generateFlashDataV2('success', 'Selamat, Anda Terdaftar Sebagai Peserta, Silahkan Cetak Kartu Peserta Anda') : '' ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Data Diri</th>
                <th scope="col">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Nama Lengkap</th>
                <td> <?= $peserta['namaLengkap'] ?> </td>
              </tr>
              <tr>
                <th scope="row">Jenis Kelamin</th>
                <td> <?= $peserta['kelamin'] ?> </td>
              </tr>
              <tr>
                <th scope="row">Nama Sekolah</th>
                <td> <?= $peserta['namaSekolah'] ?> </td>
              </tr>
              <tr>
                <th scope="row"> Pin </th>
                <td> <?= $peserta['pin'] ?> </td>
              </tr>
              <tr>
                <th scope="row"> Status </th>
                <td> <?= getStatus($peserta['status']) ?> </td>
              </tr>
              <tr>
                <th scope="row"> Alamat </th>
                <td> <?= $peserta['alamat'] ?> </td>
              </tr>
              <tr>
                <th scope="row"> Nomor Telphone </th>
                <td> <?= $peserta['telp'] ?> </td>
              </tr>
              <tr>
                <th scope="row"> Email </th>
                <td> <?= $peserta['email'] ?> </td>
              </tr>
              <tr>
                <th scope="row"> Regional / Tingkat </th>
                <td> Regional <?= $peserta['regional'] ?> / <?= $peserta['tingkat'] ?> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?= $this->endSection() ?>