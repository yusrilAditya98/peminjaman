
<div class="

<?php 
if($this->session->userdata('status') == "pengguna" || $this->session->userdata('status') == ""){
    echo "container";
}
?>">
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
    <div class="mt-2">
            <div class="row py-2">
                <div class="col-6 col-md-6 ">
                    <h3 class="text-muted">History Peminjaman</h3>
                </div>
            </div>
        </div>
        <div class="collapse my-2" id="collapseExample">
            <div class="p-2 bg-white shadow">
                <div class="">
                    <h6>FILTER DATA PEMINJAMAN</h6>
                </div>
            </div>
        </div>
    <div class="bg-white  shadow p-2" >
        <table id="dataTable" class="table table-bordered">
            <thead class="bg-thead text-white">
                <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">QR CODE</th>
                <th class="text-center" scope="col">Kode Booking</th>
                <th class="text-center" scope="col">Pengguna</th>
                <th class="text-center" scope="col">Tgl Penggunaan</th>
                <th class="text-center" scope="col">Ruangan</th>
                <th class="text-center" scope="col">Jam Mulai</th>
                <th class="text-center" scope="col">Validasi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
                foreach ($peminjaman as $u){ 
            ?>
                <tr class="text-center">
                    <td><?php echo $no++; ?></td>						
                    <td>
                    <?php 
                        if($u->qr_code == null){ ?>
                            <a class="btn btn-sm btn-secondary" href="<?php echo site_url('Peminjaman/qrcode/'.$u->id_peminjaman.'/'.$u->jenis_peminjaman); ?>" title="tampilkan QR CODE"> Generate QR CODE</a>
                        <?php }else{?>
                           
                            <a href="#gardenImage" data-id="<?php echo base_url().'assets/images/'.$u->qr_code;?>" data-peminjaman="<?= $u->id_peminjaman; ?>" class="openImageDialog thumbnail" data-toggle="modal">
                                <img style="width: 30px;" src="<?php echo base_url().'assets/images/'.$u->qr_code;?>">
                            </a>
                            <?php
                        }
                    ?>
                    </td>

                    <td><a href="<?php echo site_url('Peminjaman/detailPeminjaman/'.$u->id_peminjaman.'/'.$u->jenis_peminjaman); ?>"><?php echo $u->id_peminjaman; ?></a></td>
                    
                    <td><?php echo $u->nama_mahasiswa; ?><?php echo $u->nama_peminjam; ?></td>
                    <td><?= date("d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?>s/d<?= date("d-m-Y", strtotime($u->tanggal_selesai_penggunaan)); ?></td>
                    <td>
                    
                    <?php echo $u->nama_ruangan; ?><?php echo $u->nama_barang; ?></td>
                    
                    <td><?php $mulai = explode("-", $u->nama_waktu);
                                echo $start = $mulai[0]; ?></td>
                    <td
                    <?php
                        if($u->validasi_akademik == 'setuju'){ ?>
                            class="text-success"
                        <?php }else if($u->validasi_akademik == 'terkirim'){ ?>
                            class="text-warning"
                        <?php }else if($u->validasi_akademik == 'pending'){ ?>
                            class="text-darik"
                        <?php }else{ ?>
                            class="text-danger"
                        <?php }
                    ?>><?= $u->validasi_akademik;?>
                    </td>
                    <?php if($this->session->userdata('status') == 'staff pelayanan' || $this->session->userdata('status') == 'admin' ) { ?>
                        <td class="text-center">
                        <?php if( $u->validasi_akademik == 'terkirim'){ ?>
                            <form action="<?php echo base_url("index.php?/Peminjaman/validasiPeminjaman");?>" method="post">
                                <input hidden type="text" name="id_peminjaman" value="<?= $u->id_peminjaman;?>">
                                <input hidden type="text" name="jenis_peminjaman" value="<?= $u->jenis_peminjaman;?>">
                                <button type="submit" class="btn btn-success btn-sm" title="Setuju Peminjaman">Setuju</button>
                            </form>
                            <a data-toggle="modal" data-id="<?php echo $u->id_peminjaman; ?>" data-jenis="<?php echo $u->jenis_peminjaman; ?>" title="Tolak Peminjaman" class="modalTolakPeminjaman btn btn-outline-danger btn-sm" href="#modalTolakPeminjaman">Tolak</a>
                            <a data-toggle="modal" data-id="<?php echo $u->id_peminjaman; ?>" data-jenis="<?php echo $u->jenis_peminjaman; ?>" title="Batalkan Peminjaman" class="modalBatalPeminjaman btn btn-outline-secondary btn-sm" href="#modalBatalPeminjaman">Batal</a>

                        <?php } ?> 
                        <?php if( $u->validasi_akademik == 'setuju'){ ?>
                           <?php if( $u->id_peminjam == $this->session->userdata('username') || $this->session->userdata('username') == 'admin'){ ?>
                                <a href="https://api.whatsapp.com/send?phone=<?= $u->nomor_telpon?>&text=Hi%20Peminjaman%20Ruangan%20<?=$u->nama_ruangan;?>%20Telah%20Disetujui.%20 Terimakasih" 
                            target="_blank"class="btn btn-outline-success btn-sm" title="Kirim Pesan WA"><i class="fab fa-whatsapp"></i></a>
                            <?php } ?> 
                        <?php } ?>  
                           <?php if($u->validasi_akademik == 'tolak'){ ?>
                            <a href="https://api.whatsapp.com/send?phone=<?= $u->nomor_telpon?>&text=Hi%20Peminjaman%20Ruangan%20<?=$u->nama_ruangan;?>%20Telah%20Ditolak.%20 Dengan alasan penolakan <?= $u->catatan_penolakan?>Terimakasih" 
                            target="_blank"class="btn btn-outline-success btn-sm" title="Kirim Pesan WA"><i class="fab fa-whatsapp"></i></a>
                           
                           <?php } ?>
                        </td>
                    <?php } ?>
                    
                    <?php if($this->session->userdata('status') == 'pengguna' && $u->validasi_akademik == 'terkirim' ) { ?>
                        <td class="text-center">
                        <a data-toggle="modal" data-id="<?php echo $u->id_peminjaman; ?>" title="Batalkan Peminjaman" class="modalBatalPeminjaman btn btn-outline-secondary btn-sm" href="#modalBatalPeminjaman">Batal</a>

                        </td>
                    <?php } ?>
                    
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div> 
</div>






<script>
$(document).on("click", ".modalTolakPeminjaman", function () {
     var peminjaman = $(this).data('id');
     $(".modal-body #id_peminjaman").val( peminjaman );
     $(".peminjaman").val( peminjaman );
     var jenis = $(this).data('jenis');
     $(".modal-body #jenis").val( jenis );
     $(".jenis").val( jenis );
});
</script>

<script>
$(document).on("click", ".modalBatalPeminjaman", function () {
     var peminjaman = $(this).data('id');
     $(".modal-body #id_peminjaman").val( peminjaman );
     $(".peminjaman").val( peminjaman );
});
</script>

<div class="modal fade" id="gardenImage" tabindex="-1" role="dialog" aria-labelledby="gardenImageLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form hidden action="<?php echo base_url("index.php?/Peminjaman/buktiPeminjaman")?>" method="post">
                <div class="modal-body text-center">
                    <img id="myImage" style="width: 300px;" class="img-responsive" src="" alt="">
                    <h6><input type="text" name="id_peminjaman" class="form-control text-center" style="border-width:0px; border:none;" id="id_peminjaman" value=""/></h6>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary center-block" ><i class="fas fa-download fa-sm text-white-50"></i> Bukti Peminjaman</button>
            </form>
                    <button type="button" class="btn btn-sm btn-danger center-block" data-dismiss="modal">close</button>
                </div>
        </div>
    </div>
</div>

<script>
$(document).on("click", ".openImageDialog", function () {
    var myImageId = $(this).data('id');
    $(".modal-body #myImage").attr("src", myImageId);
});
</script>
<script>
$(document).on("click", ".openImageDialog", function () {
     var peminjaman = $(this).data('peminjaman');
     $(".modal-body #id_peminjaman").val( peminjaman );
});
</script>