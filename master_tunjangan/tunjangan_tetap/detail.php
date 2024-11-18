<?php
require_once "../../config/config.php";
include_once('header.php');
if (isset($_GET['id'])) {
    $id = @$_GET['id'];



    // 
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- <h1 class="h3 mb-2 text-gray-800">Data User</h1> -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary py-3">
                <h1 class="h3 mb-2 text-white"> Detail Tunjangan Tidak Tetap</h1>

            </div>
            <div class="card-body">

                <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
                    <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                        <span style='font-size:20pt'><b>Detail Karyawan</b></span></br>
                        <?php
                        $SqlQuery = mysqli_query($con, "SELECT * FROM dt_karyawan where nip='$id'");
                        $row = mysqli_fetch_array($SqlQuery);
                        ?>

                        <span style="font-size:15pt">Nama Karyawan : <?= $row['nama_karyawan']  ?></br> </span>
                        <span style="font-size:15pt"> Jabatan : <?= $row['devisi']  ?> </span>
                    </td>
                    <td style='vertical-align:top' width='100%' align='right'>
                        <b><span style='font-size:15pt'>Total Tunjangan </span></b></br>
                        <span style="font-size:15pt" class="text-success">
                            <?php
                            $bln = date("m");
                            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_keahlian as tk ON k.nip = tk.nip where k.nip = '$id'");
                            if (mysqli_num_rows($Sqlcek) > 1) {
                                $Sqltotal = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as total FROM t_keahlian WHERE nip = '$id' ");
                                $total = mysqli_fetch_array($Sqltotal);

                                $Sqltkepalakeluarga = mysqli_query($con, "select * from t_kepalakeluarga where nip = '$id'");
                                $Sqltmasakerja = mysqli_query($con, "select * from t_masakkerja where nip = '$id'");
                                // $Sqlreward = mysqli_query($con, "select * from reward where nip = '$id'");
                                // $Sqllembur = mysqli_query($con, "select * from lembur where nip = '$id'");
                                // $Sqlinfaq = mysqli_query($con, "select * from infaq where nip = '$id'");
                                // $Sqlcicilan = mysqli_query($con, "select * from cicilan where nip = '$id'");

                                $rowkepalakeluarga = mysqli_fetch_array($Sqltkepalakeluarga);
                                $rowtmasakerja = mysqli_fetch_array($Sqltmasakerja);
                                // $rowreward = mysqli_fetch_array($Sqlreward);
                                // $rowlembur = mysqli_fetch_array($Sqllembur);
                                // $rowinfaq = mysqli_fetch_array($Sqlinfaq);
                                // $rowcicilan = mysqli_fetch_array($Sqlcicilan);

                                if ($cek1 = mysqli_num_rows($Sqltkepalakeluarga) > 0 &&  $cek2 = mysqli_num_rows($Sqltmasakerja) > 0) {

                                    $totaltunjangantetap = $total['total'] + $rowkepalakeluarga['jumlah_tkepalakeluarga'] + $rowtmasakerja['jumlah_tmasakerja'];
                                    echo 'Rp.' . number_format($totaltunjangantetap, 2, ",", ".") . '.,-';
                                } else if ($cek1 = mysqli_num_rows($Sqltkepalakeluarga) > 0) {
                                    $totaltunjangantetap = $total['total'] + $rowkepalakeluarga['jumlah_tkepalakeluarga'];
                                    echo 'Rp.' . number_format($totaltunjangantetap, 2, ",", ".") . '.,-';
                                } else if ($cek2 = mysqli_num_rows($Sqltmasakerja) > 0) {

                                    $totaltunjangantetap = $total['total'] + $rowtmasakerja['jumlah_tmasakerja'];
                                    echo 'Rp.' . number_format($totaltunjangantetap, 2, ",", ".") . '.,-';
                                } else {
                                    echo 'Rp.' . number_format($totaltunjangantetap, 2, ",", ".") . '.,-';
                                }
                            } else  if (mysqli_num_rows($Sqlcek) > 0) {
                                $total = mysqli_fetch_array($Sqlcek);
                                $Sqltkepalakeluarga = mysqli_query($con, "select * from t_kepalakeluarga where nip = '$id'");
                                $Sqltmasakerja = mysqli_query($con, "select * from t_masakkerja where nip = '$id'");


                                $rowkepalakeluarga = mysqli_fetch_array($Sqltkepalakeluarga);
                                $rowtmasakerja = mysqli_fetch_array($Sqltmasakerja);


                                if ($cek1 = mysqli_num_rows($Sqltkepalakeluarga) > 0 &&  $cek2 = mysqli_num_rows($Sqltmasakerja) > 0) {

                                    $totaltunjangantetap = $total['total'] + $rowkepalakeluarga['jumlah_tkepalakeluarga'] + $rowtmasakerja['jumlah_tmasakerja'];
                                    echo 'Rp.' . number_format($totaltunjangantetap, 2, ",", ".") . '.,-';
                                } else if ($cek1 = mysqli_num_rows($Sqltkepalakeluarga) > 0) {
                                    $totaltunjangantetap = $total['total'] + $rowkepalakeluarga['jumlah_tkepalakeluarga'];
                                    echo 'Rp.' . number_format($totaltunjangantetap, 2, ",", ".") . '.,-';
                                } else if ($cek2 = mysqli_num_rows($Sqltmasakerja) > 0) {

                                    $totaltunjangantetap = $total['total'] + $rowtmasakerja['jumlah_tmasakerja'];
                                    echo 'Rp.' . number_format($totaltunjangantetap, 2, ",", ".") . '.,-';
                                } else {
                                    echo 'Rp.' . number_format($totaltunjangantetap, 2, ",", ".") . '.,-';
                                }
                            } else {
                                echo 'Rp.' . number_format('0', 2, ",", ".") . '.,-';
                            }
                            ?>
                        </span>
                        </br>
                        <hr>
                        <b><span style='font-size:15pt'>Reward & Lembur</span></b></br>
                        <span style="font-size:15pt" class="text-success">
                            <?php

                            $Sqltotal = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as total FROM t_keahlian WHERE nip = '$id'");
                            $total = mysqli_fetch_array($Sqltotal);

                            $Sqlreward = mysqli_query($con, "select * from reward where nip = '$id'");
                            $Sqllembur = mysqli_query($con, "select * from lembur where nip = '$id'");

                            $rowreward = mysqli_fetch_array($Sqlreward);
                            $rowlembur = mysqli_fetch_array($Sqllembur);

                            if ($cek1 = mysqli_num_rows($Sqlreward) > 0 && $cek1 = mysqli_num_rows($Sqllembur) > 0) {

                                $totalkeseluruhan = $rowreward['jumlah_reward'] + $rowlembur['jumlah_lembur'];
                                echo 'Rp.' . number_format($totalkeseluruhan, 2, ",", ".") . '.,-';
                            } else  if ($cek1 = mysqli_num_rows($Sqlreward) > 0) {
                                echo 'Rp.' . number_format($rowreward['jumlah_reward'], 2, ",", ".") . '.,-';
                            } else  if ($cek1 = mysqli_num_rows($Sqllembur) > 0) {

                                echo 'Rp.' . number_format($rowlembur['jumlah_lembur'], 2, ",", ".") . '.,-';
                            } else {

                                echo 'Rp.' . number_format(0, 2, ",", ".") . '.,-';
                            }

                            ?>
                        </span>

                        <hr>
                        <b><span style='font-size:15pt'>Cicilan & Infaq</span></b></br>
                        <span style="font-size:15pt" class="text-danger">
                            <?php

                            $Sqlinfaq = mysqli_query($con, "select * from infaq where nip = '$id'");
                            $Sqlcicilan = mysqli_query($con, "select * from cicilan where nip = '$id'");


                            $rowinfaq = mysqli_fetch_array($Sqlinfaq);
                            $rowcicilan = mysqli_fetch_array($Sqlcicilan);


                            if ($cek1 = mysqli_num_rows($Sqlinfaq) > 0 && $cek1 = mysqli_num_rows($Sqlcicilan) > 0) {

                                $totalkeseluruhan = $rowinfaq['jumlah_infaq'] + $rowcicilan['jumlah_cicilan'];
                                echo 'Rp.' . number_format($totalkeseluruhan, 2, ",", ".") . '.,-';
                            } else  if ($cek1 = mysqli_num_rows($Sqlinfaq) > 0) {
                                echo 'Rp.' . number_format($rowinfaq['jumlah_infaq'], 2, ",", ".") . '.,-';
                            } else  if ($cek1 = mysqli_num_rows($Sqlcicilan) > 0) {

                                echo 'Rp.' . number_format($rowcicilan['jumlah_cicilan'], 2, ",", ".") . '.,-';
                            } else {

                                echo 'Rp.' . number_format(0, 2, ",", ".") . '.,-';
                            }

                            ?>
                        </span>
                    </td>
                </table>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <hr>
                            <br>
                            <h4>Tunjangan Kehalian</h4>
                            <br>
                            <tr>
                                <th>No</th>
                                <th>Nama Tunjangan Keahlian</th>
                                <th>Jumlah Tunjangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $id = @$_GET['id'];
                            $SqlQuery = mysqli_query($con, "select * from t_keahlian where nip = '$id'");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_keahlian'] ?></td>
                                        <td class="text-right"> Rp. <?= number_format($row['jumlah_tunjangan_keahlian'], 2, ",", "."); ?>.,- </td>
                                        <td>
                                            <center>
                                                <a href="editdetail.php?idkeahlian=<?= $row['id_keahlian'] ?>" class="btn btn-primary btn-xs btn-action mr-1" id="edit" title="Edit">EDIT</a>

                                                <a href="deletedetail.php?idkeahlian=<?= $row['id_keahlian'] ?>" class="btn btn-danger btn-xs delete-data mr-1" id="hapus" title="hapus">HAPUS</a>
                                        </td>
                                        </center>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan=\"4\" align=\"center\">data tidak ada</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total Keseluruhan
                                </td>
                                <td colspan="2" class="text-success" align="right">
                                    <?php
                                    $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_keahlian as tk ON k.nip = tk.nip where k.nip = '$id'");
                                    if (mysqli_num_rows($Sqlcek) > 1) {
                                        $Sqltotal = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as total FROM t_keahlian WHERE nip = '$id'");
                                        $total = mysqli_fetch_array($Sqltotal);
                                        echo 'Rp.' . number_format($total['total'], 2, ",", ".") . '.,-';
                                    } else  if (mysqli_num_rows($Sqlcek) > 0) {
                                        $total = mysqli_fetch_array($Sqlcek);
                                        echo 'Rp.' . number_format($total['jumlah_tunjangan_keahlian'], 2, ",", ".") . '.,-';
                                    } else {
                                        echo 'Rp.' . number_format('0', 2, ",", ".") . '.,-';
                                    }


                                    ?>
                                </td>
                            </tr>
                        </tfoot>



                    </table>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <h4>Tunjangan Kepala Keluarga</h4>
                            <br>
                            <tr>
                                <th>No</th>
                                <th>Nama Tunjangan</th>
                                <th>Jumlah Tunjangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $id = @$_GET['id'];
                            $SqlQuery = mysqli_query($con, "select * from t_kepalakeluarga where nip = '$id'");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Tunjangan Kepala Keluarga</td>
                                        <td class="text-right"> Rp. <?= number_format($row['jumlah_tkepalakeluarga'], 2, ",", "."); ?>.,- </td>
                                        <td>
                                            <center>
                                                <a href="editdetail.php?idkepalakeluarga=<?= $row['id_tkepalakeluarga'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Edit">EDIT</a>

                                                <a href="deletedetail.php?idkepalakeluarga=<?= $row['id_tkepalakeluarga'] ?>" class="btn btn-danger btn-xs delete-data mr-1" title="hapus">HAPUS</a>
                                        </td>
                                        </center>
                                    </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total Keseluruhan
                                </td>
                                <td colspan="2" class="text-success text-right"> Rp. <?= number_format($row['jumlah_tkepalakeluarga'], 2, ",", "."); ?>.,- </td>

                            </tr>
                        </tfoot>
                        <tr>



                    <?php
                                }
                            } else {
                                echo "<tr><td colspan=\"4\" align=\"center\">data tidak ada</td></tr>";
                            }
                    ?>


                        </tr>
                    </table>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <h4>Tunjangan Masa Kerja</h4>
                            <br>
                            <tr>
                                <th>No</th>
                                <th>Nama Tunjangan</th>
                                <th>Jumlah Tunjangan</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $id = @$_GET['id'];
                            $SqlQuery = mysqli_query($con, "select * from t_masakkerja where nip = '$id' ");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Tunjangan Masa Kerja</td>
                                        <td class="text-right"> Rp. <?= number_format($row['jumlah_tmasakerja'], 2, ",", "."); ?>.,- </td>
                                        <td>
                                            <center>
                                                <a href="editdetail.php?idmasakerja=<?= $row['id_tmasakerja'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Edit">EDIT</a>

                                                <a href="deletedetail.php?idmasakerja=<?= $row['id_tmasakerja'] ?>" class="btn btn-danger btn-xs delete-data mr-1" title="hapus">HAPUS</a>
                                        </td>
                                        </center>
                                    </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total Keseluruhan
                                </td>
                                <td colspan="2" class="text-success text-right"> Rp. <?= number_format($row['jumlah_tmasakerja'], 2, ",", "."); ?>.,- </td>

                            </tr>
                        </tfoot>
                        <tr>
                    <?php
                                }
                            } else {
                                echo "<tr><td colspan=\"4\" align=\"center\">data tidak ada</td></tr>";
                            }
                    ?>


                        </tr>
                    </table>


                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <h4>Reward</h4>
                            <br>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Reward</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $id = @$_GET['id'];
                            $SqlQuery = mysqli_query($con, "select * from reward where nip = '$id'");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Reward</td>
                                        <td class="text-right"> Rp. <?= number_format($row['jumlah_reward'], 2, ",", "."); ?>.,- </td>
                                        <td>
                                            <center>
                                                <a href="editdetail.php?idreward=<?= $row['id_reward'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Edit">EDIT</a>

                                                <a href="deletedetail.php?idreward=<?= $row['id_reward'] ?>" class="btn btn-danger btn-xs delete-data mr-1" title="hapus">HAPUS</a>
                                        </td>
                                        </center>
                                    </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total Keseluruhan
                                </td>
                                <td colspan="2" class="text-right text-success"> Rp. <?= number_format($row['jumlah_reward'], 2, ",", "."); ?>.,- </td>

                            </tr>
                        </tfoot>
                        <tr>
                    <?php
                                }
                            } else {
                                echo "<tr><td colspan=\"4\" align=\"center\">data tidak ada</td></tr>";
                            }
                    ?>


                        </tr>
                    </table>


                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <h4>Lembur</h4>
                            <br>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Lembur</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $id = @$_GET['id'];
                            $SqlQuery = mysqli_query($con, "select * from lembur where nip = '$id'");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Lembur</td>
                                        <td class="text-right"> Rp. <?= number_format($row['jumlah_lembur'], 2, ",", "."); ?>.,- </td>
                                        <td>
                                            <center>
                                                <a href="editdetail.php?idlembur=<?= $row['id_lembur'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Edit">EDIT</a>

                                                <a href="deletedetail.php?idlembur=<?= $row['id_lembur'] ?>" class="btn btn-danger btn-xs delete-data mr-1" title="hapus">HAPUS</a>
                                        </td>
                                        </center>
                                    </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total Keseluruhan
                                </td>
                                <td colspan="2" class="text-right text-success"> <b> Rp. <?= number_format($row['jumlah_lembur'], 2, ",", "."); ?>.,- </b> </td>

                            </tr>
                        </tfoot>
                        <tr>
                    <?php
                                }
                            } else {
                                echo "<tr><td colspan=\"4\" align=\"center\">data tidak ada</td></tr>";
                            }
                    ?>


                        </tr>
                    </table>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <h4>Infaq</h4>
                            <br>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Lembur</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $id = @$_GET['id'];
                            $SqlQuery = mysqli_query($con, "select * from infaq where nip = '$id'");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Infaq</td>
                                        <td class="text-right"> Rp. <?= number_format($row['jumlah_infaq'], 2, ",", "."); ?>.,- </td>
                                        <td>
                                            <center>
                                                <a href="editdetail.php?idinfaq=<?= $row['id_infaq'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Edit">EDIT</a>

                                                <a href="deletedetail.php?idinfaq=<?= $row['id_infaq'] ?>" class="btn btn-danger btn-xs delete-data mr-1" title="hapus">HAPUS</a>
                                        </td>
                                        </center>
                                    </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total Keseluruhan
                                </td>
                                <td colspan="2" class="text-right text-danger"><b> Rp. <?= number_format($row['jumlah_infaq'], 2, ",", "."); ?>.,- </b> </td>

                            </tr>
                        </tfoot>
                        <tr>
                    <?php
                                }
                            } else {
                                echo "<tr><td colspan=\"4\" align=\"center\">data tidak ada</td></tr>";
                            }
                    ?>


                        </tr>
                    </table>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <h4>Cicilan</h4>
                            <br>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Cicilan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $id = @$_GET['id'];
                            $SqlQuery = mysqli_query($con, "select * from cicilan where nip = '$id'");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Cicilan</td>
                                        <td class="text-right"> Rp. <?= number_format($row['jumlah_cicilan'], 2, ",", "."); ?>.,- </td>
                                        <td>
                                            <center>
                                                <a href="editdetail.php?idcicilan=<?= $row['id_cicilan'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Edit">EDIT</a>

                                                <a href="deletedetail.php?idcicilan=<?= $row['id_cicilan'] ?>" class="btn btn-danger btn-xs delete-data mr-1" title="hapus">HAPUS</a>
                                        </td>
                                        </center>
                                    </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total Keseluruhan
                                </td>
                                <td colspan="2" class="text-right text-danger"> Rp. <?= number_format($row['jumlah_cicilan'], 2, ",", "."); ?>.,- </td>

                            </tr>
                        </tfoot>
                        <tr>
                    <?php
                                }
                            } else {
                                echo "<tr><td colspan=\"4\" align=\"center\">data tidak ada</td></tr>";
                            }
                    ?>


                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <!-- /.container-fluid -->

    </div>

    <script>
        $("#edit").change(function() {
            // variabel dari nilai combo box


            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: "GET",
                dataType: "html",
                url: "editdetail.php",
                data: "id=" + $id,
                success: function(data) {
                    $("#data").html(data);
                }
            });
        });
    </script>

    <script>
        // swall
        $('.delete-data').on('click', function(e) {
            e.preventDefault();
            var getLink = $(this).attr('href');

            Swal.fire({
                title: 'Apa Anda Yakin?',
                text: "Data akan dihapus permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.value) {
                    window.location.href = getLink;
                }
            })
        });
    </script>

<?php
} else if (isset($_GET['detail'])) {

    $nip = @$_GET['detail']
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="card-header-action text-right">
                    <a href="index.php" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                </div>
            </div>
            <div class="card-body">
                <table style='width:100%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
                    <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                        <span style='font-size:20pt'><b>Detail Karyawan</b></span></br>
                        <?php
                        $SqlQuery = mysqli_query($con, "SELECT * FROM dt_karyawan where nip='$nip'");
                        $row = mysqli_fetch_array($SqlQuery);
                        ?>

                        <span style="font-size:15pt">Nama Karyawan : <?= $row['nama_karyawan']  ?></br> </span>
                        <span style="font-size:15pt"> Jabatan : <?= $row['devisi']  ?> </span>
                    </td>

                </table>
                <form method="POST">
                    <table style='width:50%; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
                        <td>
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
                        </td>

                        <td>
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
                        </td>
                        <td>
                            <div class="">
                                <button class="btn btn-primary mr-1" type="submit" name="tgl">Lihat Data Sebelumnya</button>
                            </div>
                        </td>
                    </table>
                </form>



                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Scan 1</th>
                                <th>Scan 2</th>
                                <th>Scan 3</th>
                                <th>Scan 4</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_POST['tgl'])) {
                                $tahun = $_POST['tahun'];
                                $bulan = $_POST['bulan'];
                                $SqlQuery = mysqli_query($con, "select * from jam_kerja where nip = '$nip' && month(tanggal_input)='$bulan' && year(tanggal_input)='$tahun'");
                                $qdatagrid = "SELECT SUM(total_jam) FROM dt_karyawan as d inner join jam_kerja as j on d.nip = j.nip WHERE d.nip = '$nip' && month(tanggal_input)='$bulan' && year(tanggal_input)='$tahun'";

                                $rdatagrid = mysqli_query($con, $qdatagrid);
                                $rowjumlah = mysqli_fetch_array($rdatagrid);
                            } else {
                                $tgl    = date("m");
                                $SqlQuery = mysqli_query($con, "select * from jam_kerja where nip ='$nip' && tanggal_input='$tgl'");
                            }
                            $no = 1;


                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>

                                        <td><?= date("d-M-Y",  strtotime($row['tanggal_input'])); ?></td>
                                        <td><?= $row['scan_1'] ?></td>
                                        <td><?= $row['scan_2'] ?></td>
                                        <td><?= $row['scan_3'] ?></td>
                                        <td><?= $row['scan_4'] ?></td>
                                        <td class="text-right"><?= $row['total_jam'] ?></td>

                                        </center>
                                    </tr>
                                <?php
                                }

                                ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    Total Keseluruhan
                                </td>
                                <?php
                                $SqlQuery = mysqli_query($con, "select * from jam_kerja where nip = '$nip'");
                                $qdatagrid = "SELECT SUM(total_jam) FROM dt_karyawan as d inner join jam_kerja as j on d.nip = j.nip WHERE d.nip = '$nip'";

                                $rdatagrid = mysqli_query($con, $qdatagrid);
                                $rowjumlah = mysqli_fetch_array($rdatagrid);
                                ?>
                                <td colspan="6" class="text-success text-right"> Rp. <?= number_format($rowjumlah['SUM(total_jam)'], 0, ",", "."); ?>.,- </td>

                            </tr>
                        <?php
                            }
                        ?>
                        </tfoot>
                        </section>
                </div>

            </div>
        </div>

        </table>


    </div>
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>
<?php
}
?>
<?php

include_once('footer.php');



// 
?>

</div>

</div>
</div>

</div>
</div>
</div>
</section>