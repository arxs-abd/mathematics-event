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

    <!-- Area Chart -->
    <div class="col-xl-12">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header">
          <button type="button" class="btn btn-primary px-3  btn-add-regional"><i class="fa fa-plus" aria-hidden="true"></i>Add</button>
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
                <th>Nama Regional</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($regional as $row) : ?>
                <tr>
                  <td><?= $row['regional']; ?></td>
                  <td>
                    <a href="#" data-id="<?= $row['id'] ?>" data-regional="<?= $row['regional'] ?>" data-sd="<?= getHarga($row['regional'], 'sd'); ?>" data-smp="<?= getHarga($row['regional'], 'smp'); ?>" data-sma="<?= getHarga($row['regional'], 'sma'); ?>" class="btn btn-info btn-sm btn-edit-regional">Edit</a>
                    <a href="#" class="btn btn-warning btn-sm btn-detail-regional">Detail</a>
                    <a href="#" class="btn btn-danger btn-sm btn-delete-regional">Hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>
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