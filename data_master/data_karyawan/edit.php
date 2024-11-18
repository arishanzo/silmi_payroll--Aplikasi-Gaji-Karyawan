<?php
require_once "../../config/config.php";



include_once('header.php');
// 


?>


<div class="card">
    <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
    <div class="card-body">
        <div class="row ">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Updhate Data Karyawan</h4>
                        <div class="card-header-action text-right">
                            <a href="index.php" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card-body">
                                    <?php
                                    $id = @$_GET['id'];
                                    $sql_user = mysqli_query($con, "SELECT * FROM dt_karyawan WHERE nip = '$id'") or die(mysqli_error($con));
                                    $data = mysqli_fetch_array($sql_user)
                                    ?>
                                    <form action="" enctype="multipart/form-data" method="post">

                                        <div class="form-group">
                                            <div class="section-title mt-0">Nip</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" value="<?= $data['nip'] ?>" name="nip" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Nama Karyawan</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" value="<?= $data['nama_karyawan'] ?>" name="nama_karyawan" required>
                                            </div>
                                        </div>
                                        <div class="widget-body mt-3">
                                            <div class="form-group">
                                                <select class="custom-select" name="jenis_kelamin">
                                                    <option <?= $data['jenis_kelamin'] ?>><?= $data['jenis_kelamin']  ?></option>

                                                    <option value="L">Laki - Laki</option>

                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="section-title mt-0">Tanggal Lahir</div>
                                            <div class="input-group mb-2">
                                                <input type="date" class="form-control" value="<?= $data['ttl'] ?>" name="ttl" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Jabatan</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" value="<?= $data['devisi'] ?>" name="jabatan" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Tangal Masuk</div>
                                            <div class="input-group mb-2">
                                                <input type="date" class="form-control" value="<?= $data['tgl_masuk'] ?>" name="tgl_masuk" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Alamat</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" value="<?= $data['alamat'] ?>" name="alamat" required>
                                            </div>
                                        </div>


                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit" name="submit">Submit</button>
                            <!-- <button class="btn btn-danger" type="reset">Reset</button> -->
                        </div>
                        </from>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

</section>
<?php
if (isset($_POST['submit'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama_karyawan'];
    $ttl = $_POST['ttl'];
    $jabatan = $_POST['jabatan'];
    $tglmasuk = $_POST['tgl_masuk'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];


    $update1 = mysqli_query($con, "UPDATE dt_karyawan set nip = '$nip', nama_karyawan='$nama', jenis_kelamin='$jk', ttl='$ttl', devisi='$jabatan', tgl_masuk='$tglmasuk', alamat='$alamat' WHERE nip = '$id'") or die(mysqli_error($con));

    echo "<script type='text/javascript'>
                        setTimeout(function () { 
                            swal({ 
                                title: 'success', 
                                text: 'Berhasil Di Update', 
                                type: 'success',
                                icon: 'success',
                                 timer: 3000,
                                  buttons: false });
                        },10);  
                        window.setTimeout(function(){ 
                          window.location.replace('index.php');
                        } ,3000); 
                        </script>";
}

?>

<?php

include_once('footer.php');


// 
?>