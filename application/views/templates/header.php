<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <link rel="icon" href="<?= base_url()?>assets/img/logo.png" type="image/icon type">
  <title><?= $title?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  
  <!-- Custom styles for data tables -->
  <link href="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- modal plugins css -->
  <!-- <link rel="stylesheet" href="<?= base_url()?>assets/css/jquery.modal.min.css"> -->

  <!-- customku -->
  <link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
  
    <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url()?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url()?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url()?>assets/js/demo/datatables-demo.js"></script>

  <!-- modal plugin -->
  <!-- <script src="<?= base_url()?>assets/js/jquery.modal.min.js"></script> -->

  <!-- sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body id="body">  
  <!-- modal cetak data login -->
  <div class="modal fade" id="laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporanTitle">Cetak Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font">
              <form action="laporan/cetak_laporan" method="post">
                  <div class="form-group">
                      <label for="laporan">Laporan</label>
                      <select name="laporan" class="form-control form-control-sm" required>
                          <option value="">Pilih Laporan</option>
                          <option value="Laporan Login">Laporan Login</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="tgl_awal">Tgl Awal</label>
                    <input type="date" name="tgl_awal" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group">
                    <label for="tgl_akhir">Tgl Akhir</label>
                    <input type="date" name="tgl_akhir" class="form-control form-control-sm" required>
                  </div>
                  <div class="d-flex justify-content-end">
                      <input type="submit" value="Cetak Laporan" class="btn btn-sm btn-primary" id="btnlaporan">
                  </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  <!-- modal cetak data login -->

  <!-- Page Wrapper -->
  <div id="wrapper">

  <script>
    $("#btnAddPeserta").click(function(){
      var c = confirm("Yakin akan menambahkan peserta?");
      return c;
    })
    
    $("#btnAddKelas").click(function(){
      var c = confirm("Yakin akan menambahkan kelas?");
      return c;
    })
  </script>