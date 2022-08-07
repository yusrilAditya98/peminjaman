<?php if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE ){ ?>
    <div class="container">

<?php }else{?><div class="">
<?php }?>
<?php
        $notif = $this->session->flashdata('gagal');
        if($notif != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong></strong> '.$notif.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
        $notifsukses = $this->session->flashdata('sukses');
        if($notifsukses != NULL){
            echo '
            <div class="alert alert-success alert-dismissible fade show bg-success text-white" role="alert">
              <strong></strong> '.$notifsukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>
  <div class="row mt-4 ">
    <div class="col-md-8 order-md-1 mb-2 pb-2">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold ">Form Data Peminjaman</h6>
        </div>
        <div class="card-body">
        <?php 
        $id = null;
        $tgl_mulai = null;
        $tgl_selesai = null;
        $jam_mulai = null;
        $jam_selesai = null; 
        foreach ($peminjaman as $u){ ?>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Pengguna</label>
                <input disabled type="text"  required name="id_peminjam" class="form-control " value="<?= $id = $u->id_peminjaman; ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nama</label>
                <input disabled type="text"  required name="id_peminjam" class="form-control " value="<?= $u->nama_mahasiswa; ?> <?= $u->nama_peminjam; ?>">
            </div>
            <div class="shadow-none p-2 mb-3 bg-light rounded">
                <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <h5 class="text-dark">Tanggal Dan Jam Penggunaan</h5>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlSelect1">Tanggal Penggunaan</label>
                        <input disabled type="text"  required name="tanggal_mulai_penggunaan" class="form-control " 
                        value="<?php 
                        $day = date("l", strtotime($u->tanggal_mulai_penggunaan));
                        $hari = null;
                        if($day == "Sunday"){
                            echo $hari = "Minggu";
                        }else if($day == "Monday"){
                            echo $hari = "Senin";
                        }else if($day == "Tuesday"){
                            echo $hari = "Selasa";
                        }else if($day == "Wednesday"){
                            echo $hari = "Rabu";
                        }else if($day == "Thursday"){
                            echo $hari = "Kamis";
                        }else if($day == "Friday"){
                            echo $hari = "Jumat";
                        }else if($day == "Saturday"){
                            echo $hari = "Sabtu";
                        }
                        ?><?= ","?>
                    <?= date("d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlSelect1">Tanggal Selesai Penggunaan</label>
                        <input disabled type="text"  required name="tanggal_mulai_penggunaan" class="form-control " 
                        value="<?php 
                        $day = date("l", strtotime($u->tanggal_selesai_penggunaan));
                        $hari = null;
                        if($day == "Sunday"){
                            echo $hari = "Minggu";
                        }else if($day == "Monday"){
                            echo $hari = "Senin";
                        }else if($day == "Tuesday"){
                            echo $hari = "Selasa";
                        }else if($day == "Wednesday"){
                            echo $hari = "Rabu";
                        }else if($day == "Thursday"){
                            echo $hari = "Kamis";
                        }else if($day == "Friday"){
                            echo $hari = "Jumat";
                        }else if($day == "Saturday"){
                            echo $hari = "Sabtu";
                        }
                        ?><?= ","?>
                    <?= date("d-m-Y", strtotime($u->tanggal_selesai_penggunaan)); ?>">
                    </div>
                </div>
                <?php   $tgl_mulai = $u->tanggal_mulai_penggunaan;
                                            $tgl_selesai = $u->tanggal_selesai_penggunaan; 
                                            $jam_mulai = $u->jam_mulai;
                                            $jam_selesai = $u->jam_selesai;?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jam Mulai Penggunaan</label>
                            <input hidden type="text"  required name="tanggal_mulai_penggunaan" class="form-control " value="
                            <?php foreach ($waktu as $a) { 
                                if($a->id_waktu == $u->jam_mulai){
                                    $pieces = explode("-", $a->nama_waktu);
                                    echo $start = $pieces[0];
                                }
                                        ?>
                                <?php } ?>  ">
                            <input disabled type="text" class="form-control" value="<?= $start;?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jam Selesai Penggunaan</label>
                            <input hidden type="text"  required name="tanggal_mulai_penggunaan" class="form-control " value="
                                <?php foreach ($waktu as $a) { 
                                        if($a->id_waktu == $u->jam_selesai){
                                            $pieces = explode("-", $a->nama_waktu);
                                            echo $end = $pieces[1];
                                            }
                                        ?>
                                <?php } ?>  
                                    ">
                            <input disabled type="text" class="form-control" value="<?= $end;?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="shadow-none p-2 mb-3 bg-light rounded">
                <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <h5 class="text-dark">Tanggal Dan Jam Acara</h5>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlSelect1">Tanggal Acara</label>
                        <input disabled type="text"  required name="tanggal_mulai_acara" class="form-control " 
                        value="<?php 
                        $day = date("l", strtotime($u->tanggal_mulai_acara));
                        $hari = null;
                        if($day == "Sunday"){
                            echo $hari = "Minggu";
                        }else if($day == "Monday"){
                            echo $hari = "Senin";
                        }else if($day == "Tuesday"){
                            echo $hari = "Selasa";
                        }else if($day == "Wednesday"){
                            echo $hari = "Rabu";
                        }else if($day == "Thursday"){
                            echo $hari = "Kamis";
                        }else if($day == "Friday"){
                            echo $hari = "Jumat";
                        }else if($day == "Saturday"){
                            echo $hari = "Sabtu";
                        }
                        ?><?= ","?>
                    <?= date("d-m-Y", strtotime($u->tanggal_mulai_acara)); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlSelect1">Tanggal Selesai Acara</label>
                        <input disabled type="text"  required name="tanggal_mulai_penggunaan" class="form-control " 
                        value="<?php 
                        $day = date("l", strtotime($u->tanggal_selesai_acara));
                        $hari = null;
                        if($day == "Sunday"){
                            echo $hari = "Minggu";
                        }else if($day == "Monday"){
                            echo $hari = "Senin";
                        }else if($day == "Tuesday"){
                            echo $hari = "Selasa";
                        }else if($day == "Wednesday"){
                            echo $hari = "Rabu";
                        }else if($day == "Thursday"){
                            echo $hari = "Kamis";
                        }else if($day == "Friday"){
                            echo $hari = "Jumat";
                        }else if($day == "Saturday"){
                            echo $hari = "Sabtu";
                        }
                        ?><?= ","?>
                    <?= date("d-m-Y", strtotime($u->tanggal_selesai_acara)); ?>">
                    </div>
                </div>
                <?php   $tgl_mulai = $u->tanggal_mulai_acara;
                                            $tgl_selesai = $u->tanggal_selesai_acara; 
                                            $jam_mulai = $u->jam_mulai_acara;
                                            $jam_selesai = $u->jam_selesai_acara;?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jam Mulai Acara</label>
                            <input hidden type="text"  required name="tanggal_mulai_penggunaan" class="form-control " value="
                            <?php foreach ($waktu as $a) { 
                                if($a->id_waktu == $u->jam_mulai_acara){
                                    $pieces = explode("-", $a->nama_waktu);
                                    echo $start = $pieces[0];
                                }
                                        ?>
                                <?php } ?>  ">
                            <input disabled type="text" class="form-control" value="<?= $start;?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jam Selesai Acara</label>
                            <input hidden type="text"  required name="tanggal_mulai_penggunaan" class="form-control " value="
                                <?php foreach ($waktu as $a) { 
                                        if($a->id_waktu == $u->jam_selesai_acara){
                                            $pieces = explode("-", $a->nama_waktu);
                                            echo $end = $pieces[1];
                                            }
                                        ?>
                                <?php } ?>  
                                    ">
                            <input disabled type="text" class="form-control" value="<?= $end;?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Penyelenggara</label>
                <input disabled type="text"  required name="penyelenggara" class="form-control " value="<?= $u->penyelenggara; ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">No HP / WA</label>
                <input disabled type="text"  required name="penyelenggara" class="form-control " value="<?= $u->nomor_telpon; ?>">
            </div>
            <div class="form-group">
                <label for="">Nama Kegiatan</label>
                <textarea disabled class="form-control"  name="keterangan" rows="3" value=""><?= $u->keterangan; ?></textarea>
            </div>
            <hr class="mb-4">
            <h5 class="mb-3">Barang yang akan dipinjam</h5>
            <div class="d-block my-3"><?php $jumRuangan = 0; $operator=null;
                foreach ($sarana as $a){ ?>
                <div class="custom-control custom-radio py-1">
                    <label class="" for="credit"><?= $a->nama_barang ?><?php $operator = $a->id_operator;?>
                    <a href="<?php echo site_url('index.php?/Peminjaman/hapusSaranaPeminjaman/'.$jenis_peminjaman.'/'.$id.'/'.$a->id_sarana.'/'.$tgl_mulai.'/'.$tgl_selesai.'/'.$jam_mulai.'/'.$jam_selesai); ?>"  class="btn btn-danger btn-sm text-white" title="Hapus Barang">
                        <i class="fas fa-trash"></i>
                    </a>
                    </label>
                </div>
                <?php $jumRuangan++;} ?>
            </div>

            <form action="<?php echo base_url("index.php?/Peminjaman/kirimPeminjaman")?>" method="post">
                <input type="hidden" name="id_peminjaman" value="<?= $id?>">
                <input type="hidden" name="total_pembayaran" value="0">
                <input type="hidden" name="jenis" value="barang">
                <div class="row">
                    <div class="col-md-3"> <a href="<?php echo site_url('index.php?/Peminjaman/hapusPeminjaman/'.$id); ?>"   type="submit" class="btn btn-user btn-block btn-outline-secondary " title="Batalkan peminjaman">
                        Batalkan Peminjaman
                        </a>
                    </div>
                    <div class="col-md-9"> 
                        <button type="submit" class="btn btn-warning btn-user btn-block">Kirim Peminjaman</button>
                    </div>
                </div>
            </form>
        <?php } ?>
        </div>
      </div>
    </div>
    
    <div class="col-md-4 order-md-2 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold  d-flex justify-content-between">Pilih Barang 
            <a  data-toggle="modal" data-target="#modalPanduan"><span class="" title="panduan"><i class="far fa-question-circle"></i></span></a></h6>
        </div>
        
        <div class="card-body" style="height:500px; overflow-y: scroll;">
            <div class="my-2">
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Cari Barang" class="form-control">
            </div>
                     
            <ul id="myUL" class="list-group mb-1 anyClass" >  
                <?php 
                    $no = 1;
                    foreach ($sarana_tersedia as $u){ 
                ?>
                <li class="list-group-item ">
                <div class="justify-content-between lh-condensed d-flex">
                <div>
                    <h6 class="my-0"><?php echo $u->nama_barang ?></h6>
                </div>
                <span class="text-muted"> <form action="<?php echo site_url('index.php?/Peminjaman/tambahSaranaPeminjaman'); ?>" method="post">
                        <input type="text" hidden name="jenis" value="barang">
                        <input type="text" hidden name="id_peminjaman" value="<?= $id?>">
                        <input type="text" hidden name="id_sarana" value="<?= $u->id_barang?>">
                        <input type="text" hidden name="tgl_mulai" value="<?= $tgl_mulai?>">
                        <input type="text" hidden name="id_operator" value="<?= $u->id_operator?>">
                        <input type="text" hidden name="tgl_selesai" value="<?= $tgl_selesai?>">
                        <input type="text" hidden name="jam_mulai" value="<?= $jam_mulai?>">
                        <input type="text" hidden name="jam_selesai" value="<?= $jam_selesai?>">
                        <button class="btn btn-secondary text-white" title="Tambahkan" type="submit"><i class="fas fa-plus-square"></i> </button>
                    </form>
                </span>
                </div>
                </li>
                <?php } ?>
            </ul>
        </div>
      </div>
    </div>
  </div>


</div>



<div class="modal fade" id="modalPanduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Panduan Meminjam Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>Tahapan peminjaman</div>
        <div>
            <p>1. Mengisi form data peminjaman dan menekan tombol Lanjut ke proses selanjutnya</p>
            <p>2. Sistem kemudian menampilkan barang yang boleh dipinjamkan</p>
            <p>2. User dapat memilih barang dengan menekan tombol plus yang berada disamping nama barang</p>
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
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("div")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
