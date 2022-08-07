<?php if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){ ?>
    <div class="container">
<?php }else{?><div class="">
<?php }?>
<?php
        $gagal = $this->session->flashdata('gagal');
        if($gagal != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong></strong> '.$gagal.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
        $sukses = $this->session->flashdata('sukses');
        if($sukses != NULL){
            echo '
            <div class="alert alert-success alert-dismissible fade show bg-success text-white" role="alert">
              <strong></strong> '.$sukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>
  <div class="row mt-4 ">
    


    <div class="col-md-4 order-md-2 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold  d-flex justify-content-between">Pilih <?= $jenis_peminjaman?> 
            <a  data-toggle="modal" data-target="#modalPanduan"><span class="" title="panduan"><i class="far fa-question-circle"></i></span></a></h6>
        </div>
        <div class="card-body">
          <small class="text-muted"><?= ucfirst($jenis_peminjaman);?> yang dapat dipinjam akan tampil setelah form data peminjaman diisi dan user telah menekan tombol "Lanjut ke proses selanjutnya"</small>
        </div>
      </div>
    </div>
    


    <div class="col-md-8 order-md-1 mb-2 pb-2">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold ">Form Data Peminjaman</h6>
        </div>
        <div class="card-body">

      
        <!-- -->

          <form class="user" action="<?php echo base_url().'index.php?/Peminjaman/tambahPeminjaman'; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
          
                <?php if($this->session->userdata('logged_in') == FALSE){ ?>
                  <div class="form-group">
                  <label for="exampleFormControlSelect1">Pengguna<span class="text-danger" title="harus diisi">*</span></label>
                  <input type="text"   value="-" name="nama_peminjam" class="form-control ">
                  </div>
                <?php }else{ ?>
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Pengguna<span class="text-danger" title="harus diisi">*</span></label>                    
                    <input type="text"  value="-" hidden name="nama_peminjam" class="form-control " value="<?= $this->session->userdata('username')?>">

                    <input type="text"  disabled name="" class="form-control " value="<?= $this->session->userdata('username')?>">
                    <input type="text"  hidden name="id_peminjam" class="form-control " value="<?= $this->session->userdata('username')?>">
                  </div>
                <?php }?>
              <input type="text"   hidden name="jenis_peminjaman" class="form-control " value="<?= $jenis_peminjaman?>">
              <div class="form-group">
                  <label for="exampleFormControlSelect1">NIM/NIK/NIP<span class="text-danger" title="harus diisi">*</span></label>
                  <input type="text"   value="-" name="id_peminjam" class="form-control ">
                  <small>Silahkan isi dengan tanda "-" tanpa kutip, jika tidak mempunyai</small>
                </div>

            <div class="shadow-none p-3 mb-3 bg-light rounded ">
            
                <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <h5 class="text-dark">Tanggal Dan Jam Penggunaan <?= ucfirst($jenis_peminjaman);?></h5>
                          <small>Input tanggal dan jam berapa <?= $jenis_peminjaman;?> akan digunakan</small>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Tanggal Mulai Penggunaan <?= ucfirst($jenis_peminjaman);?><span class="text-danger" title="harus diisi">*</span></label>
                          <input type="text" required class="form-control" name="tanggal_mulai_penggunaan" id="tanggal_mulai_penggunaan">
                      </div>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Tanggal Selesai Penggunaan <?= ucfirst($jenis_peminjaman);?><span class="text-danger" title="harus diisi">*</span></label>
                          <input type="text" required class="form-control" name="tanggal_selesai_penggunaan" id="tanggal_selesai_penggunaan">
                      </div>
                  </div>
                </div>
                
              <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jam Mulai Penggunaan <?= ucfirst($jenis_peminjaman);?> <span class="text-danger" title="harus diisi">*</span></label>
                        <select name="jam_mulai_penggunaan" required class="form-control" id="jam_mulai_penggunaan">
                                <?php foreach ($waktu as $u) { 
                                  $pieces = explode("-", $u->nama_waktu);
                                  $start = $pieces[0];
                                  $end = $pieces[1];
                                  ?>
                                <option value="<?= $u->id_waktu ?>">
                                <?= $start?>
                                </option>
                            <?php } ?>         
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jam Selesai Penggunaan <?= ucfirst($jenis_peminjaman);?> <span class="text-danger" title="harus diisi">*</span></label>
                        <select name="jam_selesai_penggunaan" required class="form-control" id="jam_selesai_penggunaan">
                          <?php foreach ($waktu as $u) { 
                                  $pieces = explode("-", $u->nama_waktu);
                                  $start = $pieces[0];
                                  $end = $pieces[1];
                                  ?>
                                <option value="<?= $u->id_waktu ?>">
                                <?= $end?>
                                </option>
                            <?php } ?>        
                        </select>
                    </div>
                </div>
              </div>
            </div>

            <?php if($jenis_peminjaman == 'ruangan'){?>
            <div class="shadow-none p-3 mb-3 bg-light rounded ">
            
                <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <h5 class="text-dark">Tanggal Dan Jam Acara</h5>
                          <small>Input tanggal dan jam berapa pelaksanaan acara saat menggunakan ruangan</small>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <h6 class="text-dark"><input type="checkbox" name="" value="1" onclick='some_func();'> Tanggal Dan Jam Acara Mengikuti Tanggan Dan Jam Penggunaan</h6>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Tanggal Mulai Acara<span class="text-danger" title="harus diisi">*</span></label>
                          <input type="text" required class="form-control" name="tanggal_mulai_acara" id="tanggal_mulai_acara">
                      </div>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Tanggal Selesai Acara<span class="text-danger" title="harus diisi">*</span></label>
                          <input type="text" required class="form-control" name="tanggal_selesai_acara" id="tanggal_selesai_acara">
                      </div>
                  </div>
                </div>
                
              <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jam Mulai Acara<span class="text-danger" title="harus diisi">*</span></label>
                        <select name="jam_mulai_acara" required class="form-control" id="jam_mulai_acara">
                                <?php foreach ($waktu as $u) { 
                                  $pieces = explode("-", $u->nama_waktu);
                                  $start = $pieces[0];
                                  $end = $pieces[1];
                                  ?>
                                <option value="<?= $u->id_waktu ?>">
                                <?= $start?>
                                </option>
                            <?php } ?>         
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jam Selesai Acara<span class="text-danger" title="harus diisi">*</span></label>
                        <select name="jam_selesai_acara" required class="form-control" id="jam_selesai_acara">
                          <?php foreach ($waktu as $u) { 
                                  $pieces = explode("-", $u->nama_waktu);
                                  $start = $pieces[0];
                                  $end = $pieces[1];
                                  ?>
                                <option value="<?= $u->id_waktu ?>">
                                <?= $end?>
                                </option>
                            <?php } ?>        
                        </select>
                    </div>
                </div>
              </div>
            </div>
            <?php } ?>


           
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nama Instansi<span class="text-danger" title="harus diisi">*</span></label>
                <input type="text"  value="-" required name="penyelenggara" class="form-control " >
            </div>     
            <div class="form-group">
                <label for="exampleFormControlSelect1">No Hp / WA<span class="text-danger" title="harus diisi">*</span></label>
                <input type="text"  value="-" required name="nomor_telpon" class="form-control " placeholder="ex: 081358xxxx">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nama Kegiatan<span class="text-danger" title="harus diisi">*</span></label>
                <input type="text"  value="-" required name="keterangan" class="form-control ">
            </div>
            <div class="form-group">
                <label for="">Lampiran surat tugas atau surat peminjaman<span class="text-danger" title="harus diisi">*</span></label>
            
                  <input type="file"   name="file_peminjaman" class="form-control " multiple>   
                       
               <?php if($this->session->userdata('logged_in') == FALSE){?>
                <input type="hidden"  required name="jenis_sarana" class="pinjam">
              <?php }else{ ?>
                <input type="hidden"  required name="jenis_sarana" class="sewa">
              <?php }?>
            </div>
            <?php if($this->session->userdata('status_validasi') == 'belum divalidasi' || $this->session->userdata('status_validasi') == 'tidak valid'){?>
              <a href="#" class="btn btn-secondary btn-user btn-block">
                  Peminjaman tidak dapat dilakukan, Silahkan validasi akun anda terlebih dahulu dengan menghubungi operator
              </a>
             <?php }else{ ?>
             <span><span class="text-danger" title="harus diisi">*</span> Wajib diisi</span>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                  Lanjut ke proses selanjutnya
              </button>
            <?php }?>
          </form> 
        </div>
      </div>
    </div>
  </div>

</div>


<div class="modal fade" id="modalPanduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Panduan Meminjam <?= ucfirst($jenis_peminjaman);?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>Tahapan peminjaman</div>
        <div>
            <p>1. Mengisi form data peminjaman dan menekan tombol Lanjut ke proses selanjutnya</p>
            <p>2. Sistem kemudian menampilkan <?= $jenis_peminjaman;?> yang boleh dipinjamkan</p>
            <p>2. User dapat memilih <?= $jenis_peminjaman;?> dengan menekan tombol plus yang berada disamping nama <?= $jenis_peminjaman;?></p>
            <p>4. User kemudian menekan tombol kirim peminjaman untuk menyelesaikan proses peminjaman</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>

some_func = function() {
    var tanggal_mulai_penggunaan = document.getElementById('tanggal_mulai_penggunaan');
    var tanggal_selesai_penggunaan = document.getElementById('tanggal_selesai_penggunaan');
    var jam_mulai_penggunaan = document.getElementById('jam_mulai_penggunaan');
    var jam_selesai_penggunaan = document.getElementById('jam_selesai_penggunaan');

    var tanggal_mulai_acara = document.getElementById('tanggal_mulai_acara');
    var tanggal_selesai_acara = document.getElementById('tanggal_selesai_acara');
    var jam_mulai_acara = document.getElementById('jam_mulai_acara');
    var jam_selesai_acara = document.getElementById('jam_selesai_acara');

    

    tanggal_mulai_acara.value = tanggal_mulai_penggunaan.value;
    tanggal_selesai_acara.value = tanggal_selesai_penggunaan.value;
    jam_mulai_acara.value = jam_mulai_penggunaan.value;
    jam_selesai_acara.value = jam_selesai_penggunaan.value;
}</script>




