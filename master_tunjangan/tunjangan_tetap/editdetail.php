<?php
require_once "../../config/config.php";



include_once('header.php');
// 
if (isset($_GET['idkeahlian'])) {
    $id = @$_GET['idkeahlian'];

?>


    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Updhate Data Tunjangan Kepala Keluarga</h4>
                            <div class="card-header-action text-right">
                                <?php
                                $sql_keahlian = mysqli_query($con, "SELECT * FROM t_keahlian as t INNER JOIN dt_karyawan as d on t.nip = d.nip where id_keahlian = '$id'") or die(mysqli_error($con));
                                $data = mysqli_fetch_array($sql_keahlian);

                                $nip = $data['nip'];
                                ?>
                                <a href="detail.php?id=<?= $nip ?>" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <?php

                                        $sql_user = mysqli_query($con, "SELECT * FROM t_keahlian where id_keahlian = '$id'") or die(mysqli_error($con));
                                        $data = mysqli_fetch_array($sql_user)
                                        ?>
                                        <form action="" enctype="multipart/form-data" method="post">


                                            <div class="form-group">
                                                <div class="section-title mt-0">Tunjungan Keahlian</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="<?= $data['nama_keahlian'] ?>" name="tunjungankeahlian" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Jumlah Tunjangan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="<?= $data['jumlah_tunjangan_keahlian'] ?>" name="jmlh_tunjangan" required>
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
        $namakeahlian = $_POST['tunjungankeahlian'];
        $jmlh_tunjangan = $_POST['jmlh_tunjangan'];

        $sql_keahlian = mysqli_query($con, "SELECT * FROM t_keahlian as t INNER JOIN dt_karyawan as d on t.nip = d.nip where id_keahlian = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_keahlian);

        $nip = $data['nip'];

        $update1 = mysqli_query($con, "UPDATE t_keahlian set nama_keahlian = '$namakeahlian', jumlah_tunjangan_keahlian = '$jmlh_tunjangan' WHERE id_keahlian = '$id'") or die(mysqli_error($con));

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
                          window.location.replace('detail.php?id=$nip');
                        } ,3000); 
                        </script>";
    }
} else  if (isset($_GET['idkepalakeluarga'])) {
    $id = @$_GET['idkepalakeluarga'];

    ?>


    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Updhate Data Tunjangan Keahlian</h4>
                            <div class="card-header-action text-right">
                                <?php
                                $sql_keahlian = mysqli_query($con, "SELECT * FROM t_keahlian where nip") or die(mysqli_error($con));
                                $data = mysqli_fetch_array($sql_keahlian);

                                $nip = $data['nip'];
                                ?>
                                <a href="detail.php?id=<?= $nip ?>" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <?php

                                        $sql_user = mysqli_query($con, "SELECT * FROM t_kepalakeluarga where id_tkepalakeluarga = '$id'") or die(mysqli_error($con));
                                        $data = mysqli_fetch_array($sql_user)
                                        ?>
                                        <form action="" enctype="multipart/form-data" method="post">


                                            <div class="form-group">
                                                <div class="section-title mt-0">Jumlah Tunjangan Kepala Keluarga</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" value="<?= $data['jumlah_tkepalakeluarga'] ?>" name="jmlh_tkepalakeluarga" required>
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
        $jmlh_tkepalakeluarga = $_POST['jmlh_tkepalakeluarga'];

        $sql_kepalakeluarga = mysqli_query($con, "SELECT * FROM t_kepalakeluarga as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_tkepalakeluarga = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_kepalakeluarga);

        $nip = $data['nip'];

        $update1 = mysqli_query($con, "UPDATE t_kepalakeluarga set jumlah_tkepalakeluarga = ' $jmlh_tkepalakeluarga' WHERE id_tkepalakeluarga = '$id'") or die(mysqli_error($con));

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
                              window.location.replace('detail.php?id=$nip');
                            } ,3000); 
                            </script>";
    }
} else  if (isset($_GET['idmasakerja'])) {
    $id = @$_GET['idmasakerja'];

    ?>


    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Updhate Data Tunjangan Keahlian</h4>
                            <div class="card-header-action text-right">
                                <?php
                                $sql_masakerja = mysqli_query($con, "SELECT * FROM t_masakkerja as t inner join dt_karyawan as d on t.nip = d.nip where t.id_tmasakerja = '$id'") or die(mysqli_error($con));
                                $data = mysqli_fetch_array($sql_masakerja);

                                $nip = $data['nip'];
                                ?>
                                <a href="detail.php?id=<?= $nip ?>" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <?php

                                        $sql_user = mysqli_query($con, "SELECT * FROM t_masakkerja where id_tmasakerja = '$id'") or die(mysqli_error($con));
                                        $data = mysqli_fetch_array($sql_user)
                                        ?>
                                        <form action="" enctype="multipart/form-data" method="post">


                                            <div class="form-group">
                                                <div class="section-title mt-0">Jumlah Tunjangan Masa Kerja</div>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" value="<?= $data['jumlah_tmasakerja'] ?>" name="jumlah_tmasakerja" required>
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
        $jmlh_tmasakerja = $_POST['jumlah_tmasakerja'];

        $sql_tmasakerja = mysqli_query($con, "SELECT * FROM t_masakkerja as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_tmasakerja = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_tmasakerja);

        $nip = $data['nip'];

        $update1 = mysqli_query($con, "UPDATE t_masakkerja set jumlah_tmasakerja = '$jmlh_tmasakerja' WHERE id_tmasakerja = '$id'") or die(mysqli_error($con));

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
                              window.location.replace('detail.php?id=$nip');
                            } ,3000); 
                            </script>";
    }
} else  if (isset($_GET['idreward'])) {
    $id = @$_GET['idreward'];

    ?>


    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Updhate Data Reward</h4>
                            <div class="card-header-action text-right">
                                <?php
                                $sql_masakerja = mysqli_query($con, "SELECT * FROM reward as t inner join dt_karyawan as d on t.nip = d.nip where t.id_reward = '$id'") or die(mysqli_error($con));
                                $data = mysqli_fetch_array($sql_masakerja);

                                $nip = $data['nip'];
                                ?>
                                <a href="detail.php?id=<?= $nip ?>" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <?php

                                        $sql_user = mysqli_query($con, "SELECT * FROM reward where id_reward = '$id'") or die(mysqli_error($con));
                                        $data = mysqli_fetch_array($sql_user)
                                        ?>
                                        <form action="" enctype="multipart/form-data" method="post">


                                            <div class="form-group">
                                                <div class="section-title mt-0">Jumlah Reward</div>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" value="<?= $data['jumlah_reward'] ?>" name="jumlah_reward" required>
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
        $jmlh_reward = $_POST['jumlah_reward'];

        $sql_reward = mysqli_query($con, "SELECT * FROM reward as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_reward = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_reward);

        $nip = $data['nip'];

        $update1 = mysqli_query($con, "UPDATE reward set jumlah_reward = '$jmlh_reward' WHERE id_reward = '$id'") or die(mysqli_error($con));

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
                              window.location.replace('detail.php?id=$nip');
                            } ,3000); 
                            </script>";
    }
} else  if (isset($_GET['idlembur'])) {
    $id = @$_GET['idlembur'];

    ?>


    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Updhate Data Lembur</h4>
                            <div class="card-header-action text-right">
                                <?php
                                $sql_lembur = mysqli_query($con, "SELECT * FROM lembur as t inner join dt_karyawan as d on t.nip = d.nip where t.id_lembur = '$id'") or die(mysqli_error($con));
                                $data = mysqli_fetch_array($sql_lembur);

                                $nip = $data['nip'];
                                ?>
                                <a href="detail.php?id=<?= $nip ?>" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <?php

                                        $sql_user = mysqli_query($con, "SELECT * FROM lembur where id_lembur = '$id'") or die(mysqli_error($con));
                                        $data = mysqli_fetch_array($sql_user)
                                        ?>
                                        <form action="" enctype="multipart/form-data" method="post">


                                            <div class="form-group">
                                                <div class="section-title mt-0">Jumlah Reward</div>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" value="<?= $data['jumlah_lembur'] ?>" name="jumlah_lembur" required>
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
        $jmlh_lembur = $_POST['jumlah_lembur'];

        $sql_lembur = mysqli_query($con, "SELECT * FROM lembur as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_lembur = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_lembur);

        $nip = $data['nip'];

        $update1 = mysqli_query($con, "UPDATE lembur set jumlah_lembur = '$jmlh_lembur' WHERE id_lembur = '$id'") or die(mysqli_error($con));

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
                              window.location.replace('detail.php?id=$nip');
                            } ,3000); 
                            </script>";
    }
} else  if (isset($_GET['idcicilan'])) {
    $id = @$_GET['idcicilan'];

    ?>


    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Updhate Data Cicilan</h4>
                            <div class="card-header-action text-right">
                                <?php
                                $sql_lembur = mysqli_query($con, "SELECT * FROM cicilan as t inner join dt_karyawan as d on t.nip = d.nip where t.id_cicilan = '$id'") or die(mysqli_error($con));
                                $data = mysqli_fetch_array($sql_lembur);

                                $nip = $data['nip'];
                                ?>
                                <a href="detail.php?id=<?= $nip ?>" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <?php

                                        $sql_user = mysqli_query($con, "SELECT * FROM cicilan where id_cicilan = '$id'") or die(mysqli_error($con));
                                        $data = mysqli_fetch_array($sql_user)
                                        ?>
                                        <form action="" enctype="multipart/form-data" method="post">


                                            <div class="form-group">
                                                <div class="section-title mt-0">Jumlah Cicilan</div>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" value="<?= $data['jumlah_cicilan'] ?>" name="jumlah_cicilan" required>
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
        $jmlh_cicilan = $_POST['jumlah_cicilan'];

        $sql_reward = mysqli_query($con, "SELECT * FROM cicilan as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_cicilan = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_reward);

        $nip = $data['nip'];

        $update1 = mysqli_query($con, "UPDATE cicilan set jumlah_cicilan = '$jmlh_cicilan' WHERE id_cicilan = '$id'") or die(mysqli_error($con));

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
                              window.location.replace('detail.php?id=$nip');
                            } ,3000); 
                            </script>";
    }
} else  if (isset($_GET['idinfaq'])) {
    $id = @$_GET['idinfaq'];

    ?>


    <div class="card">
        <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
        <div class="card-body">
            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Updhate Data Cicilan</h4>
                            <div class="card-header-action text-right">
                                <?php
                                $sql_lembur = mysqli_query($con, "SELECT * FROM infaq as t inner join dt_karyawan as d on t.nip = d.nip where t.id_infaq = '$id'") or die(mysqli_error($con));
                                $data = mysqli_fetch_array($sql_lembur);

                                $nip = $data['nip'];
                                ?>
                                <a href="detail.php?id=<?= $nip ?>" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="card-body">
                                        <?php

                                        $sql_user = mysqli_query($con, "SELECT * FROM infaq where id_infaq = '$id'") or die(mysqli_error($con));
                                        $data = mysqli_fetch_array($sql_user)
                                        ?>
                                        <form action="" enctype="multipart/form-data" method="post">


                                            <div class="form-group">
                                                <div class="section-title mt-0">Jumlah Infaq</div>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" value="<?= $data['jumlah_infaq'] ?>" name="jumlah_infaq" required>
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
        $jmlh_infaq = $_POST['jumlah_infaq'];

        $sql_infaq = mysqli_query($con, "SELECT * FROM infaq as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_infaq = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_infaq);

        $nip = $data['nip'];

        $update1 = mysqli_query($con, "UPDATE infaq set jumlah_infaq = '$jmlh_infaq' WHERE id_infaq = '$id'") or die(mysqli_error($con));

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
                              window.location.replace('detail.php?id=$nip');
                            } ,3000); 
                            </script>";
    }


    ?>
<?php

} else {
}
include_once('footer.php');


// 
?>