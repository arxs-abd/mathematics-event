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
                    <h4> Pengaturan Umum </h4>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <?php if (session()->getFlashdata('fail')) {
                        generateFlashData('error', session()->getFlashdata('fail'));
                    } ?>
                    <?php if (session()->getFlashdata('success')) {
                        generateFlashData('success', session()->getFlashdata('success'));
                    } ?>

                    <form action="<?= base_url('/pengaturan') ?>" method="POST">
                        <div class="form-group row">
                            <input type="hidden" name="_method" value="PUT">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                            <div class="col-sm-10">
                                <input type="input" class="form-control" name="namaKegiatan" id="inputEmail3" autofocus placeholder="Nama Kegiatan" value="<?= $setting[0]['value'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Koordinator Acara</label>
                            <div class="col-sm-10">
                                <input type="input" class="form-control" name="namaKorca" id="inputPassword3" placeholder="Nama Koordinator Acara" value="<?= $setting[1]['value'] ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right"> Simpan </button>

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