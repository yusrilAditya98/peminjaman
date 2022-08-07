
<div class="col-md-12">
<?php
        $gagal = $this->session->flashdata('gagal');
        if($gagal != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong>Gagal! </strong> '.$gagal.'
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
              <strong>Sukses! </strong> '.$sukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>

<div class="card shadow mb-4 mt-2">
        <div class="card-header bg-thead  py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">Tambah Data Operator</h6>
        </div>
        <div class="card-body">
            <form class="user" action="<?php echo base_url().'index.php?/User/tambahOperator'; ?>" method="post">
                <div class="form-group">
                    <label for="">Username</label>
                    <input required type="text" name="username" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Nama Operator</label>
                    <input required type="text" name="nama_operator" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input required type="text" name="email" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input required type="text" name="password" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Nama Fakultas</label>
                    <input required type="text" name="nama_fakultas" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Status</label>
                    <select name="status_operator" class="form-control" id="exampleFormControlSelect1">
                    <option>admin</option>
                    <option>staff pelayanan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Tambah Operator
                </button>
            </form> 
        </div>
    </div>
    