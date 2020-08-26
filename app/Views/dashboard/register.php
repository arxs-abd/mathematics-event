<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register Mathematics Event</title>

  <!-- Favicons -->
  <link href="<?= base_url() . '/' ?>assets/img/favicon.png" rel="icon">
  <link href="<?= base_url() . '/' ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Custom fonts for this template-->
  <link href="<?= base_url() . '/' ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url() . '/' ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Daftar</h1>
              </div>
              <form action="<?= base_url() ?>/register" method="post" class="user">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="namaLengkap" placeholder="Nama Lengkap" value="<?= set_value('namaLengkap') ?>">
                  <?php if (isset($errors['namaLengkap'])) : ?>
                    <small class="text-danger pl-3"> <?= $errors['namaLengkap'] ?> </small>
                  <?php endif ?>
                </div>
                <div class="form-group">
                  <div>
                    <label for="kelamin">Jenis Kelamin:</label>
                    <select class="form-control" name="kelamin" value="<?= set_value('kelamin') ?>">
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value="Laki-Laki" <?= (set_value('kelamin') == 'Laki-Laki') ? 'selected' : '' ?>>Laki-Laki</option>
                      <option value="Perempuan" <?= (set_value('kelamin') == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                  </div>
                  <?php if (isset($errors['kelamin'])) : ?>
                    <small class="text-danger pl-3"> <?= $errors['kelamin'] ?> </small>
                  <?php endif ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="namaSekolah" placeholder="Nama Sekolah" value="<?= set_value('namaSekolah') ?>">
                  <?php if (isset($errors['namaSekolah'])) : ?>
                    <small class="text-danger pl-3"> <?= $errors['namaSekolah'] ?> </small>
                  <?php endif ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat" value="<?= set_value('alamat') ?>">
                  <?php if (isset($errors['alamat'])) : ?>
                    <small class="text-danger pl-3"> <?= $errors['alamat'] ?> </small>
                  <?php endif ?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="telp" placeholder="Nomor Telepon/HP" value="<?= set_value('telp') ?>">
                  <?php if (isset($errors['telp'])) : ?>
                    <small class="text-danger pl-3"> <?= $errors['telp'] ?> </small>
                  <?php endif ?>
                </div>
                <div class=" form-group">
                  <input type="text" class="form-control form-control-user" name="email" placeholder="Email" value="<?= set_value('email') ?>">
                  <?php if (isset($errors['email'])) : ?>
                    <small class="text-danger pl-3"> <?= $errors['email'] ?> </small>
                  <?php endif ?>
                </div>
                <div class=" form-group">
                  <input type="password" class="form-control form-control-user" name="password" placeholder="Password" value="">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="regional">Daerah Regional:</label>
                    <select class="form-control" name="regional" value="<?= set_value('regional') ?>">
                      <option value="">Daerah Regional</option>
                      <?php foreach ($regional as $r) : ?>
                        <option value="<?= $r['regional'] ?>" <?= ($r['regional'] == set_value('regional')) ? 'selected' : '' ?>> <?= $r['regional'] ?> </option>
                      <?php endforeach ?>
                    </select>
                    <?php if (isset($errors['regional'])) : ?>
                      <small class="text-danger pl-3"> <?= $errors['regional'] ?> </small>
                    <?php endif ?>
                  </div>
                  <div class="col-sm-6">
                    <label for="tingkat">Tingkatan Lomba:</label>
                    <select class="form-control" name="tingkat" value="<?= set_value('tingkat') ?>">
                      <option value="">Tingkat Lomba</option>
                      <?php foreach ($tingkat as $t) : ?>
                        <option value="<?= $t ?>" <?= ($t == set_value('tingkat')) ? 'selected' : '' ?>> <?= $t ?> </option>
                      <?php endforeach ?>
                    </select>
                    <?php if (isset($errors['tingkat'])) : ?>
                      <small class="text-danger pl-3"> <?= $errors['tingkat'] ?> </small>
                    <?php endif ?>
                  </div>
                </div>
                <div class="form-group row">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Simpan
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url() . '/' ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() . '/' ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() . '/' ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() . '/' ?>assets/js/sb-admin-2.min.js"></script>

  <script>
    $('input[name="namaSekolah"]').keyup(function(e) {
      let text = $('input[name="namaSekolah"]').val();
      const tingkat = ['', 'SD', 'SMP', 'SMA'];
      tingkat.forEach(function(t) {
        if (text.toUpperCase().includes(t)) {
          $('select[name="tingkat"]').val(t);
        }
      });
    });
  </script>
</body>

</html>