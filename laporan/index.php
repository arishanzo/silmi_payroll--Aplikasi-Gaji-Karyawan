<?php
require_once "../config/config.php";



if (isset($_SESSION['username'])) {

    include_once('header.php');
    // 


?>


    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>LAPORAN GAJI DEVISI PER BULAN DAN TAHUN </h4>
                            <div class="card-header-action text-right">
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
                                        <form action="cetak.php" method="POST">
                                            <div class="widget-body mt-3">
                                                <div class="form-group">
                                                    <select class="custom-select" name="devisi" id="devisi">
                                                        <option disabled selected>Pilih Devisi </option>
                                                        <?php

                                                        $sql2 = mysqli_query($con, "SELECT DISTINCT devisi FROM dt_karyawan ");
                                                        while ($row2 = mysqli_fetch_array($sql2)) {
                                                        ?>
                                                            <option value="<?= $row2['devisi'] ?>"><?= $row2['devisi'] ?></option>
                                                        <?php

                                                        }

                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="widget-body mt-3">
                                                    <div class="form-group">
                                                        <select class="custom-select" name="bulan">
                                                            <option disabled selected>Pilih Bulan </option>
                                                            <?php
                                                            $bln = array(
                                                                1 => "Januari", "Februari", "Maret", "April", "Mei",
                                                                "Juni", "July", "Agustus", "September", "Oktober",
                                                                "November", "Desember"
                                                            );
                                                            for ($bulan = 1; $bulan <= 12; $bulan++) {
                                                            ?>
                                                                <option value="<?= $bulan ?>"><?= $bln[$bulan] ?></option>
                                                            <?php

                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="widget-body mt-3">
                                                    <div class="form-group">
                                                        <select class="custom-select" name="tahun">
                                                            <option disabled selected>Pilih Tahun </option>
                                                            <?php
                                                            $now = date("Y");
                                                            for ($thn = 2010; $thn <= $now; $thn++) {
                                                            ?>
                                                                <option value="<?= $thn ?>"><?= $thn ?></option>
                                                            <?php

                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-danger mr-1" name="pdf">CETAK PDF</button>

                                                    <!-- <button type="submit" class="btn btn-success" name="excel">EXCEL</button> -->

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br><br><br>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        $nip = $_POST['nip'];
        $nama = $_POST['nama_karyawan'];
        $ttl = $_POST['ttl'];
        $jabatan = $_POST['jabatan'];
        $tglmasuk = $_POST['tgl_masuk'];
        $alamat = $_POST['alamat'];



        $update1 = mysqli_query($con, "UPDATE dt_karyawan set nip = '$nip', nama_karyawan='$nama', ttl='$ttl', devisi='$jabatan', tgl_masuk='$tglmasuk', alamat='$alamat' WHERE nip = '$id'") or die(mysqli_error($con));

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
} else {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
}

// 
?>