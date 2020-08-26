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
          <?php if ($peserta['status'] == 3) : ?>
            <a href="" class="btn btn-success mr-2 float-right"><i class="fa fa-fw fa-print"></i> Cetak Kartu Peserta </a>
          <?php endif ?>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <?php if (session()->getFlashdata('fail')) {
            generateFlashData('error', session()->getFlashdata('fail'));
          } else if (session()->getFlashdata('success')) {
            generateFlashData('success', session()->getFlashdata('success'));
          }
          ?>
          <form action="<?= base_url('/peserta') ?>" method="POST">
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
              <div class="col-sm-10">
                <input type="text" name="namaLengkap" class="form-control" id="nama" placeholder="Nama Lengkap" value="<?= $peserta['namaLengkap'] ?>">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="token" value="<?= $token ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="kelamin" class="col-sm-2 col-form-label">Jenis Kelamin:</label>
              <div class="col-sm-10">
                <select class="form-control" name="kelamin" value="<?= (set_value('kelamin')) ? set_value('kelamin') : $peserta['kelamin'] ?>">
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="Laki-Laki" <?= (set_value('kelamin') == 'Laki-Laki' || $peserta['kelamin'] == 'Laki-Laki') ? 'selected' : '' ?>>Laki-Laki</option>
                  <option value="Perempuan" <?= (set_value('kelamin') == 'Perempuan' || $peserta['kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="sekolah" class="col-sm-2 col-form-label">Nama Sekolah</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="sekolah" name="namaSekolah" placeholder="Nama Sekolah" value="<?= $peserta['namaSekolah'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $peserta['alamat'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">Nomor Telphone</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="telp" name="telp" placeholder="Alamat" value="<?= $peserta['telp'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $peserta['email'] ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Daerah Regional</label>
              <div class="col-sm-4">
                <select class="form-control" name="regional" value="<?= set_value('regional') ?>">
                  <option value="">Daerah Regional</option>
                  <?php foreach ($regional as $r) : ?>
                    <option value="<?= $r['regional'] ?>" <?= ($r['regional'] == set_value('regional') || $r['regional'] == $peserta['regional']) ? 'selected' : '' ?>> <?= $r['regional'] ?> </option>
                  <?php endforeach ?>
                </select>
              </div>
              <label for="email" class="col-sm-2 col-form-label">Tingkat Lomba</label>
              <div class="col-sm-4">
                <select class="form-control" name="tingkat" value="<?= set_value('tingkat') ?>">
                  <option value="">Tingkat Lomba</option>
                  <?php foreach ($tingkat as $t) : ?>
                    <option value="<?= $t ?>" <?= ($t == set_value('tingkat') || $t == $peserta['tingkat']) ? 'selected' : '' ?>> <?= $t ?> </option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="float-right col-sm-2">
              <button type="submit" class="btn btn-success btn-user btn-block float-right">
                Ubah
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?= $this->endSection() ?>