 <!-- Footer -->
 <footer class="sticky-footer bg-white">
   <div class="container my-auto">
     <div class="copyright text-center my-auto">
       <span>Copyright &copy; Mathematics Event <?= date('Y', time()) ?></span>
     </div>
   </div>
 </footer>
 <!-- End of Footer -->

 </div>
 <!-- End of Content Wrapper -->

 </div>
 <!-- End of Page Wrapper -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
   <i class="fas fa-angle-up"></i>
 </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"> Logout </h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
       </div>
       <div class="modal-body">Silahkan Pilih Logout Untuk Keluar dari Session Ini</div>
       <div class="modal-footer">
         <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
         <a class="btn btn-primary" href="<?= base_url('/logout') ?>">Logout</a>
       </div>
     </div>
   </div>
 </div>

 <?php if ($page == 'Peserta') : ?>
   <!-- Delete Modal Peserta -->
   <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Hapus Peserta</h5>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <form action="<?= base_url('/peserta') ?>" method="POST">
           <input type="hidden" name="id">
           <input type="hidden" name="token" value="<?= $token ?>">
           <input type="hidden" name="_method" value="DELETE">
           <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
           <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
             <button type="submit" class="btn btn-danger" href="">Hapus</button>
           </div>
         </form>
       </div>
     </div>
   </div>
   <!-- Modal Add, Edit dan Detail Peserta -->
   <div class="modal fade" id="addPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form action="" method="POST">
             <div class="form-group">
               <input type="hidden" name="token" value="<?= $token ?>">
               <input type="hidden" name="_method" value="PUT" />
               <input type="hidden" class="form-control form-control-user" name="id" placeholder="Nama Lengkap">
               <input type="text" class="form-control form-control-user" name="namaLengkap" placeholder="Nama Lengkap">
             </div>
             <div class="form-group">
               <label for="kelamin">Jenis Kelamin:</label>
               <select class="form-control" name="kelamin" value="">
                 <option value="">Pilih Jenis Kelamin</option>
                 <option value="Laki-Laki">Laki-Laki</option>
                 <option value="Perempuan">Perempuan</option>
               </select>
             </div>
             <div class="form-group">
               <input type="text" class="form-control form-control-user" name="namaSekolah" placeholder="Nama Sekolah">
             </div>
             <div class="form-group">
               <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat">
             </div>
             <div class="form-group">
               <input type="text" class="form-control form-control-user" name="telp" placeholder="Nomor Telepon/HP">
             </div>
             <div class=" form-group">
               <input type="text" class="form-control form-control-user" name="email" placeholder="Email">
             </div>
             <div class=" form-group">
               <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
             </div>
             <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
                 <label for="regional">Daerah Regional:</label>
                 <select class="form-control" name="regional" value="">
                   <option value="">Daerah Regional</option>
                   <?php foreach ($regional as $r) : ?>
                     <option value="<?= $r['regional'] ?>"> <?= $r['regional'] ?> </option>
                   <?php endforeach ?>
                 </select>
               </div>
               <div class="col-sm-6">
                 <label for="tingkat">Tingkatan Lomba:</label>
                 <select class="form-control" name="tingkat" value="<?= set_value('tingkat') ?>">
                   <option value="">Tingkat Lomba</option>
                   <?php foreach ($tingkat as $t) : ?>
                     <option value="<?= $t ?>"> <?= $t ?> </option>
                   <?php endforeach ?>
                 </select>
               </div>
             </div>
             <div class="modal-footer">
               <button type="submit" id="peserta" class="btn btn-primary">Tambah Peserta</button>
           </form>
         </div>
       </div>
     </div>
   </div>
   <!-- Modal Delete Peserta -->
 <?php endif ?>

 <?php if ($page == 'Regional') : ?>
   <!-- Delete Modal Regional -->
   <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Hapus Regional</h5>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <form action="<?= base_url('/regional') ?>" method="POST">
           <input type="hidden" name="id">
           <input type="hidden" name="token" value="<?= $token ?>">
           <input type="hidden" name="_method" value="DELETE">
           <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
           <div class="modal-footer">
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
             <button type="submit" class="btn btn-danger">Hapus</button>
           </div>
         </form>
       </div>
     </div>
   </div>
   <!-- Modal Add, Edit dan Detail Peserta -->
   <div class="modal fade" id="addRegional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form action="<?= base_url('/regional') ?>" method="POST">
             <div class="form-group">
               <input type="hidden" name="_method" value="">
               <input type="hidden" name="token" value="<?= $token ?>">
               <input type="hidden" class="form-control form-control-user" name="id" placeholder="Nama Lengkap">
               <input type="text" class="form-control form-control-user" name="regional" placeholder="Regional">
             </div>
             <h6 class="text-center"> Harga Per Tingkat </h6>
             <div class="form-group row">
               <label for="sd" class="col-sm-2 col-form-label">SD</label>
               <div class="col-sm-10">
                 <input type="text" name="sd" class="form-control" id="sd">
               </div>
             </div>
             <div class="form-group row">
               <label for="smp" class="col-sm-2 col-form-label">SMP</label>
               <div class="col-sm-10">
                 <input type="text" name="smp" class="form-control" id="smp">
               </div>
             </div>
             <div class="form-group row">
               <label for="sma" class="col-sm-2 col-form-label">SMA</label>
               <div class="col-sm-10">
                 <input type="text" name="sma" class="form-control" id="sma">
               </div>
             </div>
             <div class="modal-footer">
               <button type="submit" id="regional" class="btn btn-primary">Tambah Regional</button>
           </form>
         </div>
       </div>
     </div>
   </div>
 <?php endif ?>

 <!-- Bootstrap core JavaScript-->
 <script src="<?= base_url() . '/' ?>assets/vendor/jquery/jquery.min.js"></script>
 <script src="<?= base_url() . '/' ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?= base_url() . '/' ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url() . '/' ?>assets/js/sb-admin-2.min.js"></script>

 <!-- Datatables -->
 <!-- Page level plugins -->
 <script src="<?= base_url() . '/' ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= base_url() . '/' ?>assets/vendor/chart.js/Chart.min.js"></script>
 <script src="<?= base_url() . '/' ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- My Script -->
 <script>
   $(document).ready(function() {
     $('#dataTable').DataTable({
       "processing": true,
       "serverSide": true,
       "order": [],
       "ajax": {
         "url": "<?= base_url('/peserta/ajax') ?>",
         "type": "POST"
       },
       "columnDefs": [{
         "className": "text-center",
         "targets": [0, 2, 4, 5]
       }],
     });
     <?php if ($page == 'Peserta') : ?>
       // Delte Banyak
       $('button.btn-delete-m-peserta').click(function(e) {
         e.preventDefault();
         //  $('#hapus input[name="id"]').attr('name', 'x');
         $('#hapus input[name="id[]"]').remove();
         let x = ``;
         $('input[name="md"]:checked').each(function() {
           x += `<input type="hidden" name="id[]" value="${$(this).data('id')}">`;
         })

         $('#hapus input[name="token"]').before(x);

         $('#hapus .modal-body').html(`Apakah Anda Yakin Ingin Menghapus Peserta Yang di Cheklist ?`);
         $('#hapus').modal('show');
         $('#hapus input[name="id"]').remove();
       });

       // Auto Tingkat
       $('input[name="namaSekolah"]').keyup(function(e) {
         let text = $('input[name="namaSekolah"]').val();
         console.log(text);
         const tingkat = ['', 'SD', 'SMP', 'SMA'];
         tingkat.forEach(function(t) {
           if (text.toUpperCase().includes(t)) {
             $('select[name="tingkat"]').val(t);

           } else if (text.toUpperCase().includes('SMK')) {
             $('select[name="tingkat"]').val('SMA');

           }
         });
       });
       // Tambah Peserta
       $(document).on('click', 'button.btn-add-peserta', function(e) {
         e.preventDefault();
         inisialisasi();
         $('#addPeserta .modal-title').html('Tambah Peserta'); // Ubah Judul Modal
         $('.modal-footer button#peserta').html('Tambah Peserta'); // Ubah Nama Tombol
         $('input[name="password"]').parent().show();
         $('#addPeserta form').attr('action', '<?= base_url('/peserta') ?>'); // Url
         $('#addPeserta').modal('show');
       })
       // Edit Peserta
       $(document).on('click', 'a.btn-edit-peserta', function(e) {
         e.preventDefault();
         inisialisasi();
         tampilpeserta($(this));
         $('input[name="_method"]').val('PUT');
         $('#addPeserta .modal-title').html('Tambah Peserta'); // Ubah Judul Modal
         $('.modal-footer button#peserta').html('Ubah Peserta'); // Ubah Nama Tombol
         $('#addPeserta form').attr('action', '<?= base_url('/peserta') ?>') // Url
         $('#addPeserta').modal('show');
       });
       // Detail Peserta
       $(document).on('click', 'a.btn-detail-peserta', function(e) {
         e.preventDefault();
         inisialisasi();
         tampilpeserta($(this).prev());
         $('#addPeserta .modal-title').html('Detail Peserta'); // Ubah Judul Modal
         $('.modal-footer button#peserta').hide();
         $('#addPeserta input, #addPeserta select').attr('disabled', true);
         $('#addPeserta form').attr('action', '') // Url
         $('#addPeserta').modal('show');
       });
       // Hapus Peserta
       $(document).on('click', 'a.btn-delete-peserta', function(e) {
         e.preventDefault();
         $('#hapus input[name="id[]"]').remove();
         $('#hapus input[name="token"]').before(`<input type="hidden" name="id">`);
         $('#hapus input[name="id"]').val($(this).data('id'));
         $('#hapus .modal-body').html(`Apakah Anda Yakin Ingin Menghapus Peserta dengan Nama ${$(this).data('namalengkap')} ?`);
         $('#hapus').modal('show');
       });

       function inisialisasi() {
         $('#addPeserta input, #addPeserta select').attr('disabled', false);
         $('input[name="password"]').parent().hide();
         $('#addPeserta input:not(input[name="token"]), #addPeserta select').val(''); // Reset
         $('.modal-footer button#peserta').show();
         if ($('.modal-footer button#peserta').hasClass('btn-danger')) {
           $('.modal-footer button#peserta').removeClass('btn-danger');
           $('.modal-footer button#peserta').addClass('btn-primary');
         }
       }

       function tampilpeserta(btn) {
         $('input[name="id"]').val(btn.data('id'));
         $('input[name="namaLengkap"]').val(btn.data('namalengkap'));
         $('select[name="kelamin"]').val(btn.data('kelamin'));
         $('input[name="namaSekolah"]').val(btn.data('namasekolah'));
         $('input[name="alamat"]').val(btn.data('alamat'));
         $('input[name="telp"]').val(btn.data('telp'));
         $('input[name="email"]').val(btn.data('email'));
         $('select[name="regional"]').val(btn.data('regional'));
         $('select[name="tingkat"]').val(btn.data('tingkat'));
       }
     <?php endif ?>
     <?php if ($page == 'Regional') : ?>
       $('button.btn-add-regional').click(function() {
         inisialisasi();
         $('#addRegional .modal-title').html('Tambah Regional') // Judul Modal
         $('.modal-footer button#regional').html('Tambah Regional'); // Ubah Nama Tombol
         $('#addRegional').modal('show');
       });
       $('a.btn-edit-regional').click(function(e) {
         inisialisasi();
         e.preventDefault();
         $('input[name="id"]').val($(this).data('id'));
         $('input[name="sd"]').val($(this).data('sd'));
         $('input[name="smp"]').val($(this).data('smp'));
         $('input[name="sma"]').val($(this).data('sma'));
         $('input[name="_method"]').val('PUT');
         $('input[name="regional"]').val($(this).data('regional'));
         $('#addRegional .modal-title').html('Edit Regional') // Judul Modal
         $('.modal-footer button#regional').html('Edit Regional'); // Ubah Nama Tombol
         $('#addRegional').modal('show');
       });
       $('a.btn-detail-regional').click(function() {
         inisialisasi();
         $('input[name="regional"]').val($(this).prev().data('regional'));
         $('input[name="sd"]').val($(this).prev().data('sd'));
         $('input[name="smp"]').val($(this).prev().data('smp'));
         $('input[name="sma"]').val($(this).prev().data('sma'));
         $('#addRegional .modal-title').html('Detail Regional') // Judul Modal
         $('#addRegional input').attr('disabled', true); // Readonly
         $('#addRegional .modal-footer button#regional').hide();
         $('#addRegional').modal('show');
       });
       $('a.btn-delete-regional').click(function() {
         inisialisasi();
         $('#hapus input[name="id"]').val($(this).prev().prev().data('id'));
         $('input[name="_method"]').val('DELETE');
         $('#hapus .modal-body').html(`Apakah Anda Yakin Ingin Menghapus Regional ${$(this).prev().prev().data('regional')} ?`);
         $('#hapus').modal('show');
       });

       function inisialisasi() {
         $('#addRegional input').attr('disabled', false);
         $('.modal-footer button#regional').show();
         $('#addRegional input:not(input[name="token"]), #addRegional select').val(''); // Reset
         if ($('.modal-footer button#regional').hasClass('btn-danger')) {
           $('.modal-footer button#regional').removeClass('btn-danger');
           $('.modal-footer button#regional').addClass('btn-primary');
         }
       }
     <?php endif ?>
     <?php if ($page == 'Statistik') : ?>

       const data = $('.chart-area');
       let all = data.data('sd') + data.data('smp') + data.data('sma');
       $('div.text-count-sd').html(data.data('sd'));
       $('div.text-count-smp').html(data.data('smp'));
       $('div.text-count-sma').html(data.data('sma'));
       $('h6.text-count-all').html(`Jumlah Peserta : ${all}`);

       const chartPeserta = $('canvas#statistik-peserta');
       const chartP = new Chart(chartPeserta, {
         type: 'doughnut',
         data: {
           labels: ["SD", "SMP", "SMA"],
           datasets: [{
             data: [data.data('sd'), data.data('smp'), data.data('sma')],
             backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
             hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
             hoverBorderColor: "rgba(234, 236, 244, 1)",
           }],
         },
         options: {
           maintainAspectRatio: false,
           tooltips: {
             backgroundColor: "rgb(255,255,255)",
             bodyFontColor: "#858796",
             borderColor: '#dddfeb',
             borderWidth: 1,
             xPadding: 15,
             yPadding: 15,
             displayColors: false,
             caretPadding: 10,
           },
           legend: {
             display: true
           },
           cutoutPercentage: 80,
         },
       });
     <?php endif ?>
     <?php if ($page == 'Peserta Info') : ?>
       document.getElementById('pay-button').onclick = function() {
         // SnapToken acquired from previous step
         snap.pay('<?= $snapToken ?>', {
           // Optional
           onSuccess: function(result) {
             /* You may add your own js here, this is just example */
             //  document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
             console.log('berhasil');
           },
           // Optional
           onPending: function(result) {
             /* You may add your own js here, this is just example */
             //  document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
             console.log('berhasil');
           },
           // Optional
           onError: function(result) {
             /* You may add your own js here, this is just example */
             //  document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
             console.log('berhasil');
           }
         });
       };
     <?php endif ?>

   });
 </script>
 </body>

 </html>