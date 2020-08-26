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
                    <button type="button" class="btn btn-primary px-3 btn-add-peserta"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Add</button>
                    <button type="button" class="btn btn-danger px-3 btn-delete-peserta"><i class="fa fa-trash mr-2" aria-hidden="true"></i>Hapus</button>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <?php if (session()->getFlashdata('fail')) {
                        generateFlashData('error', session()->getFlashdata('fail'));
                    } ?>
                    <?php if (session()->getFlashdata('success')) {
                        generateFlashData('success', session()->getFlashdata('success'));
                    } ?>


                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?= $this->endSection() ?>