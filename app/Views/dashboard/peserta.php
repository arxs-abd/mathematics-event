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
          <form action="<?= base_url('/peserta') ?>" method="POST" class="d-inline">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id">
            <button type="submit" class="btn btn-danger px-3 btn-delete-m-peserta"><i class="fa fa-trash mr-2" aria-hidden="true"></i>Hapus</button>
          </form>
        </div>

        <!-- Card Body -->
        <div class="card-body">
          <?php if (session()->getFlashdata('fail')) {
            generateFlashData('error', session()->getFlashdata('fail'));
          } ?>
          <?php if (session()->getFlashdata('success')) {
            generateFlashData('success', session()->getFlashdata('success'));
          } ?>
          <table class="table table-striped table-bordered" id="dataTable" style="width: 100%;">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Lengkap</th>
                <th>Pin</th>
                <th>Sekolah</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
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