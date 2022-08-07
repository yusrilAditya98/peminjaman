<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIBORU - UB</title>
  <meta property="og:title" content="SIBORU Universitas Brawijaya">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Official Site - Siboru (Universitas Brawijaya) ">
  <meta name="keywords" content="Siboru,Universitas,Brawijaya,UB, Siboru UB">
  <meta name="robots" content="index, follow">
  <meta name="HandheldFriendly" content="true">
  <meta http-equiv="cleartype" content="on">


  <meta property="og:site_name" content="Siboru Universitas Brawijaya">

  <meta property="og:description" content="Official Site - Siboru Universitas Brawijaya">
  <meta http-equiv="cache-control" content="no-cache">
  <meta name="rating" content="Mature">
  <link rel="icon" href="<?php echo base_url() ?>/assets/img/ub.png">
  <!-- Custom fonts for this template-->

  <link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?php echo base_url() ?>/assets/css/image-css.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.11.2/css/pro.min.css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>/assets/css/user-style.css" rel="stylesheet" type="text/css">


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
  <script scr="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
  <script scr="https://pagination.js.org/dist/2.1.5/pagination.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.3.7/css/swiper.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.3.7/js/swiper.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link href="<?php echo base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


  <link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css'>


</head>

<body>

  <div class="">
    <nav class="navbar navbar-expand-lg navbar-light bg-biru shadow">
      <div class="container">
        <a class="navbar-brand text-white " href="<?php echo base_url('SaranaPrasarana/saranaPrasarana'); ?>"><img src="<?php echo base_url(); ?>/assets/img/ub.png" width="35" height="35" alt="" id="page-top"> Siboru <sup>UB</sup></a>
        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto ml-3">
            <li class="nav-item active">
              <a class="nav-link text-white" href="<?php echo base_url('SaranaPrasarana/saranaPrasarana'); ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link text-white" href="<?php echo base_url('Agenda'); ?>">Agenda <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link text-white" href="<?php echo base_url('SaranaPrasarana/penggunaanRuangan'); ?>">Ruangan <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link text-white" href="<?php echo base_url('SaranaPrasarana/penggunaanBarang'); ?>">Barang <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link text-white" href="<?php echo base_url('Peminjaman/pilihPeminjaman'); ?>">Peminjaman</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?php echo base_url('Peminjaman/formCekPeminjaman'); ?>">Cek Peminjaman</a>
            </li>

            <?php
            if ($this->session->userdata('status') == "pengguna") { ?>
              <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo base_url('Peminjaman/historyPeminjaman'); ?>">History Peminjaman</a>
              </li>
            <?php
            }
            ?>
          </ul>
          <form class="form-inline my-2 my-lg-0 ">
            <?php if ($this->session->userdata('logged_in') == FALSE) { ?>
              <a class="my-2 my-sm-0 text-white" href="<?php echo base_url('Auth/login') ?>">Login</a>
            <?php } else { ?>
              <div class="btn-group">
                <a class="dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?= $this->session->userdata('nama') ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="my-2 my-sm-0  dropdown-item" href="<?php echo base_url('Auth/profil') ?>">Profil</a>
                  <a class="my-2 my-sm-0  text-danger dropdown-item" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
              </div>

            <?php } ?>
          </form>
        </div>
      </div>
    </nav>
  </div>

  <div class="">
    <?php $this->load->view($main_view); ?>
  </div>


  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout dari sistem?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Logout" untuk keluar dari sistem.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('Auth/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalPeminjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Peminjaman?</h5>


        </div>
        <div class="modal-body">
          <div class="row text-center">
            <div class="col-md-6 text-right">
              <a class="btn btn-outline-secondary" href="<?php echo base_url("Peminjaman/formTambahPeminjaman/ruangan") ?>"><i class="fas fa-home"></i> <br>Ruangan</a>
            </div>
            <div class="col-md-6 text-left">
              <a class="btn btn-outline-secondary" href="<?php echo base_url("Peminjaman/formTambahPeminjaman/barang") ?>"><i class="fas fa-car"></i> <br>Barang</a>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>/assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url() ?>/assets/js/demo/datatables-demo.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

  <script>
    var dateToday = new Date();
    var dates = $("#tanggal_mulai_penggunaan, #tanggal_selesai_penggunaan").datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd',
      minDate: dateToday,
      onSelect: function(selectedDate) {
        var option = this.id == "tanggal_mulai_penggunaan" ? "minDate" : "maxDate",
          instance = $(this).data("datepicker"),
          date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
      }
    });
  </script>

  <script>
    var dateTodayAcara = new Date();
    var datesAcara = $("#tanggal_mulai_acara, #tanggal_selesai_acara").datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      dateFormat: 'yy-mm-dd',
      minDate: dateTodayAcara,
      onSelect: function(selectedDate) {
        var option = this.id == "tanggal_mulai_acara" ? "minDate" : "maxDate",
          instance = $(this).data("datepicker"),
          date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        datesAcara.not(this).datepicker("option", option, date);
      }
    });
  </script>



</body>

</html>