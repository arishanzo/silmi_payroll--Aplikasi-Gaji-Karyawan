<?php
require_once "../../config/config.php";

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;


if (isset($_SESSION['username'])) {
    include_once('header.php');

    $lama = 30; // lama data yang tersimpan di database dan akan otomatis terhapus setelah 5 hari

    // proses untuk melakukan penghapusan data

    // 
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Tunjungan Tidak Tetap</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
                        <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal1" data-toggle="tooltip" title="Tambah Data"><span>Tambah Tunjangan</span></button>
                        <button class="btn btn-success btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal2" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-download fa-sm text-white-50"></i> Download Data</button>
                    </div>
                </div>



            </div>
            <div class="card-body">
                <div>
                    <span> Data Otomatis Akan Hilang 30 hari Setelah Proses Input Data, Setelah Input Data Silahkan Klik Tombol Download Data Untuk Backup / Laporan Data</span>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan</th>
                                <th>Tunjangan Keahlian</th>
                                <th>Tunjangan Keapala Keluarga</th>
                                <th>Tunjangan Masa Kerja</th>
                                <th>Reward</th>
                                <th>Lembur</th>
                                <th>Infaq</th>
                                <th>Cicilan</th>
                                <th>Jumlah Tunjangan Tetap</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="data">
                            <?php
                            $bln = date("m");
                            $SqlQuery = mysqli_query($con, "SELECT * FROM dt_karyawan");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                                    $nip = $row['nip'];
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $nip ?></td>
                                        <td><?= $row['nama_karyawan'] ?></td>
                                        <td><?= $row['devisi'] ?></td>
                                        <td>

                                            <?php
                                            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_keahlian as tk ON k.nip = tk.nip where k.nip = '$nip'");
                                            if (mysqli_num_rows($Sqlcek) > 1) {
                                                $Sqltotal = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as total FROM t_keahlian WHERE nip = '$nip'");
                                                $total = mysqli_fetch_array($Sqltotal);
                                                echo 'Rp.' . number_format($total['total'], 2, ",", ".");
                                            } else  if (mysqli_num_rows($Sqlcek) > 0) {
                                                $total = mysqli_fetch_array($Sqlcek);
                                                echo 'Rp.' . number_format($total['jumlah_tunjangan_keahlian'], 2, ",", ".");
                                            } else {
                                                echo 'Rp.' . number_format('0', 2, ",", ".");
                                            }



                                            ?>

                                        </td>

                                        <td>
                                            <?php
                                            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_kepalakeluarga as tk ON k.nip = tk.nip where k.nip = '$nip' ");
                                            if (mysqli_num_rows($Sqlcek) > 0) {
                                                $total = mysqli_fetch_array($Sqlcek);
                                                echo 'Rp.' . number_format($total['jumlah_tkepalakeluarga'], 2, ",", ".");
                                            } else {
                                                echo 'Rp.' . number_format('0', 2, ",", ".");
                                            }
                                            ?>

                                        </td>

                                        <td>
                                            <?php
                                            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_masakkerja as tk ON k.nip = tk.nip where k.nip = '$nip' ");
                                            if (mysqli_num_rows($Sqlcek) > 0) {
                                                $total = mysqli_fetch_array($Sqlcek);
                                                echo 'Rp.' . number_format($total['jumlah_tmasakerja'], 2, ",", ".");
                                            } else {
                                                echo 'Rp.' . number_format('0', 2, ",", ".");
                                            }



                                            ?>

                                        </td>


                                        <td>
                                            <?php
                                            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN reward as tk ON k.nip = tk.nip where k.nip = '$nip' ");
                                            if (mysqli_num_rows($Sqlcek) > 0) {
                                                $total = mysqli_fetch_array($Sqlcek);
                                                echo 'Rp.' . number_format($total['jumlah_reward'], 2, ",", ".");
                                            } else {
                                                echo 'Rp.' . number_format('0', 2, ",", ".");
                                            }



                                            ?>

                                        </td>

                                        <td>
                                            <?php
                                            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN lembur as tk ON k.nip = tk.nip where k.nip = '$nip' ");
                                            if (mysqli_num_rows($Sqlcek) > 0) {
                                                $total = mysqli_fetch_array($Sqlcek);
                                                echo 'Rp.' . number_format($total['jumlah_lembur'], 2, ",", ".");
                                            } else {
                                                echo 'Rp.' . number_format('0', 2, ",", ".");
                                            }
                                            ?>

                                        </td>

                                        <td>
                                            <?php
                                            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN infaq as tk ON k.nip = tk.nip where k.nip = '$nip' ");
                                            if (mysqli_num_rows($Sqlcek) > 0) {
                                                $total = mysqli_fetch_array($Sqlcek);
                                                echo 'Rp.' . number_format($total['jumlah_infaq'], 2, ",", ".");
                                            } else {
                                                echo 'Rp.' . number_format('0', 2, ",", ".");
                                            }



                                            ?>

                                        </td>

                                        <td>
                                            <?php
                                            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN cicilan as tk ON k.nip = tk.nip where k.nip = '$nip' ");
                                            if (mysqli_num_rows($Sqlcek) > 0) {
                                                $total = mysqli_fetch_array($Sqlcek);
                                                echo 'Rp.' . number_format($total['jumlah_cicilan'], 2, ",", ".");
                                            } else {
                                                echo 'Rp.' . number_format('0', 2, ",", ".");
                                            }



                                            ?>

                                        </td>

                                        <td>
                                            <!-- perhitungan -->
                                            <?php
                                            $Sqlkeahlian = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as jumlah FROM `t_keahlian` as t inner join dt_karyawan as d on t.nip = d.nip WHERE t.nip = '$nip'  ");
                                            if (mysqli_num_rows($Sqlkeahlian) > 0) {
                                                $jumlahkeahlian = mysqli_fetch_array($Sqlkeahlian);
                                                $totalkeahlian = $jumlahkeahlian['jumlah'];
                                            } else {
                                                $totalkeahlian = 0;
                                            }

                                            $Sqltunjangankepalakeluarga = mysqli_query($con, "SELECT * FROM `t_kepalakeluarga` as t inner join dt_karyawan as d on t.nip = d.nip WHERE t.nip = '$nip' ");


                                            if (mysqli_num_rows($Sqltunjangankepalakeluarga) > 0) {
                                                $jumlahtunjangankepalakeluarga = mysqli_fetch_array($Sqltunjangankepalakeluarga);
                                                $totaltunjangankepalakeluarga = $jumlahtunjangankepalakeluarga['jumlah_tkepalakeluarga'];
                                            } else {
                                                $totaltunjangankepalakeluarga = 0;
                                            }

                                            $Sqltunjanganmasakerja = mysqli_query($con, "SELECT * FROM `t_masakkerja` as t inner join dt_karyawan as d on t.nip = d.nip WHERE t.nip = '$nip' ");

                                            if (mysqli_num_rows($Sqltunjanganmasakerja) > 0) {
                                                $jumlahtunjanganmasakerja = mysqli_fetch_array($Sqltunjanganmasakerja);
                                                $totaltunjanganmasakerja = $jumlahtunjanganmasakerja['jumlah_tmasakerja'];
                                            } else {
                                                $totaltunjanganmasakerja = 0;
                                            }

                                            $Sqlreward = mysqli_query($con, "SELECT * FROM `reward` as t inner join dt_karyawan as d on t.nip = d.nip WHERE t.nip = '$nip' ");

                                            if (mysqli_num_rows($Sqlreward) > 0) {
                                                $jumlahreward = mysqli_fetch_array($Sqlreward);
                                                $totalreward = $jumlahreward['jumlah_reward'];
                                            } else {
                                                $totalreward = 0;
                                            }

                                            $Sqllembur = mysqli_query($con, "SELECT * FROM `lembur` as t inner join dt_karyawan as d on t.nip = d.nip WHERE t.nip = '$nip' ");

                                            if (mysqli_num_rows($Sqllembur) > 0) {
                                                $jumlahlembur = mysqli_fetch_array($Sqllembur);
                                                $totallembur = $jumlahlembur['jumlah_lembur'];
                                            } else {
                                                $totallembur = 0;
                                            }

                                            $Sqlcicilan = mysqli_query($con, "SELECT * FROM `cicilan` as t inner join dt_karyawan as d on t.nip = d.nip WHERE t.nip = '$nip' ");

                                            if (mysqli_num_rows($Sqlcicilan) > 0) {
                                                $jumlahcicilan = mysqli_fetch_array($Sqlcicilan);
                                                $totalcicilan = $jumlahcicilan['jumlah_cicilan'];
                                            } else {
                                                $totalcicilan = 0;
                                            }

                                            $Sqlinfaq = mysqli_query($con, "SELECT * FROM `infaq` as t inner join dt_karyawan as d on t.nip = d.nip WHERE t.nip = '$nip' ");

                                            if (mysqli_num_rows($Sqlinfaq) > 0) {
                                                $jumlahinfaq = mysqli_fetch_array($Sqlinfaq);
                                                $totalinfaq = $jumlahinfaq['jumlah_infaq'];
                                            } else {
                                                $totalinfaq = 0;
                                            }

                                            $totaltunjangan = $totalkeahlian + $totaltunjangankepalakeluarga + $totaltunjanganmasakerja + $totallembur + $totalreward;

                                            $totallain =  $totalinfaq + $totalcicilan;

                                            $totalkeseluruhan = $totaltunjangan - $totallain;

                                            echo 'Rp.' . number_format($totalkeseluruhan, 2, ",", ".");

                                            ?>

                                            <!-- <?php

                                                    $waktuawal = '08:06:37';
                                                    $waktuakhir = '12:00:00';
                                                    $awal  = strtotime('2019-02-25' . $waktuawal); //waktu awal

                                                    $akhir = strtotime('2019-02-25' . $waktuakhir); //waktu akhir

                                                    $diff  = $akhir - $awal;

                                                    $jam   = floor($diff / (3600));

                                                    $menit = $diff - $jam * (60 * 60);

                                                    echo 'Waktu Tersisa tinggal: ' . $jam .  ' jam, ' . floor($menit / 60) . ' menit';


                                                    ?> -->
                                        </td>
                                        <td>
                                            <center>
                                                <a href="detail.php?id=<?= $row['nip'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Lihat Detail"><i class="fas fa-eye"></i> Detail</a>
                                        </td>
                                        </center>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan=\"7\" align=\"center\">data tidak ada</td></tr>";
                            }
                            ?>
                        </tbody>

                        <!-- MODAL -->

                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Tambah Tunjangan Tidak Tetap</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                        <div class="input-group mb-2">
                                            <select class="form-control " data-live-search="true" id="tunjangan" name="tunjangan" required>
                                                <option disabled selected> Pilih Tunjangan</option>

                                                <option value="t_keahlian">Tunjangan Keahlian</option>
                                                <option value="t_kepalakeluarga">Tunjangan Kepala Keluarga</option>
                                                <option value="t_masakerja">Tunjangan Masa Kerja</option>
                                                <option value="reward">Reward</option>
                                                <option value="lembur">Lembur</option>
                                                <option value="infaq">Infaq</option>
                                                <option value="cicilan">Cicilan</option>
                                            </select>
                                        </div>
                                        <script>
                                            $("#tunjangan").change(function() {
                                                // variabel dari nilai combo box
                                                var tunjangan = $("#tunjangan").val();

                                                // Menggunakan ajax untuk mengirim dan dan menerima data dari server
                                                $.ajax({
                                                    type: "GET",
                                                    dataType: "html",
                                                    url: "datatunjangan.php",
                                                    data: "tunjangan=" + tunjangan,
                                                    success: function(data) {
                                                        $("#data_tunjangantetap").html(data);
                                                    }
                                                });
                                            });
                                        </script>

                                        <form id="data_tunjangantetap" action="" method="POST">

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                </div>


                <!-- SELECT * FROM dt_karyawan as k INNER JOIN t_keahlian as tk INNER JOIN t_kepalakeluarga as kk INNER JOIN t_masakkerja as tm INNER JOIN lembur as l INNER JOIN reward as r INNER JOIN infaq as i INNER JOIN cicilan as c on tk.nip = k.nip && kk.nip = k.nip && tm.nip = k.nip && r.nip = k.nip && i.nip = k.nip && c.nip = k.nip WHERE k.nip -->

                <?php
                if (isset($_POST['submit1'])) {
                    $karyawan = $_POST['karyawan'];
                    $number = count($_POST["tunjungankeahlian"]);
                    $tgl = date('Y-m-d');

                    if ($number > 0) {
                        for ($i = 0; $i < $number; $i++) {
                            if (trim($_POST["tunjungankeahlian"][$i] != '')) {

                                $save = mysqli_query($con, "INSERT INTO t_keahlian VALUES ('', '$karyawan', '" . $_POST['tunjungankeahlian'][$i] . "' , '" . $_POST['jmlh_tunjangan'][$i] . "', '$tgl' )") or die(mysqli_error($con));
                            }
                        }
                        //jika berhasil input

                        echo "<script type='text/javascript'>
                    setTimeout(function () { 
                        swal({ 
                            title: 'Suksess', 
                            text: 'Data Berhasil Disimpan', 
                            type: 'success',
                            icon: 'success',
                            timer: 3000,
                            buttons: false });
                    },10);  
                    window.setTimeout(function(){ 
                    window.location.replace('index.php');
                    } ,3000); 
                    </script>";
                    } else {
                        //jika tidak berhasil
                        echo "Data Tidak Berhasil Di Inputkan";
                    }
                } else    if (isset($_POST['submit2'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_tunjangan = $_POST['jmlh_tunjangan'];

                    $tgl = date('Y-m-d');
                    $save = mysqli_query($con, "INSERT INTO t_kepalakeluarga VALUES ('', '$karyawan', '$jmlh_tunjangan', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
       setTimeout(function () { 
           swal({ 
               title: 'Suksess', 
               text: 'Data Berhasil Disimpan', 
               type: 'success',
               icon: 'success',
               timer: 3000,
               buttons: false });
       },10);  
       window.setTimeout(function(){ 
       window.location.replace('index.php');
       } ,3000); 
       </script>";
                } else    if (isset($_POST['submit3'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_tunjangan = $_POST['jmlh_tunjangan'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO t_masakkerja VALUES ('', '$karyawan', '$jmlh_tunjangan', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
       setTimeout(function () { 
           swal({ 
               title: 'Suksess', 
               text: 'Data Berhasil Disimpan', 
               type: 'success',
               icon: 'success',
               timer: 3000,
               buttons: false });
       },10);  
       window.setTimeout(function(){ 
       window.location.replace('index.php');
       } ,3000); 
       </script>";
                } else    if (isset($_POST['submit4'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_tunjangan = $_POST['jmlh_tunjangan'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO reward VALUES ('', '$karyawan', '$jmlh_tunjangan', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
       setTimeout(function () { 
           swal({ 
               title: 'Suksess', 
               text: 'Data Berhasil Disimpan', 
               type: 'success',
               icon: 'success',
               timer: 3000,
               buttons: false });
       },10);  
       window.setTimeout(function(){ 
       window.location.replace('index.php');
       } ,3000); 
       </script>";
                } else    if (isset($_POST['submit5'])) {
                    $karyawan = $_POST['karyawan'];

                    $jumlah = $_POST['jmlh'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO lembur VALUES ('', '$karyawan', '$jumlah', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
       setTimeout(function () { 
           swal({ 
               title: 'Suksess', 
               text: 'Data Berhasil Disimpan', 
               type: 'success',
               icon: 'success',
               timer: 3000,
               buttons: false });
       },10);  
       window.setTimeout(function(){ 
       window.location.replace('index.php');
       } ,3000); 
       </script>";
                } else    if (isset($_POST['submit6'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_infaq = $_POST['jmlh_infaq'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO infaq VALUES ('', '$karyawan', '$jmlh_infaq', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
       setTimeout(function () { 
           swal({ 
               title: 'Suksess', 
               text: 'Data Berhasil Disimpan', 
               type: 'success',
               icon: 'success',
               timer: 3000,
               buttons: false });
       },10);  
       window.setTimeout(function(){ 
       window.location.replace('index.php');
       } ,3000); 
       </script>";
                } else    if (isset($_POST['submit7'])) {
                    $karyawan = $_POST['karyawan1'];
                    $jmlh_cicilan = $_POST['jmlh_cicilan'];
                    $tgl = date('Y-m-d');

                    $save = mysqli_query($con, "INSERT INTO cicilan VALUES ('', '$karyawan', '$jmlh_cicilan', '$tgl')") or die(mysqli_error($con));

                    echo "<script type='text/javascript'>
setTimeout(function () { 
   swal({ 
       title: 'Suksess', 
       text: 'Data Berhasil Disimpan', 
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




                </section>
            </div>



        </div>
    </div>

    </table>


    </div>
    </div>
    </div>





    </div>

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Tunjungan Tetap</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="card-header-action">

                    <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal4" data-toggle="tooltip" title="Tambah Data"><span>Tambah Data</span></button>
                    <button class="btn btn-warning btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal3" data-toggle="tooltip" title="Tambah Data"><span>Tambah Data Perjam</span></button>
                    <button class="btn btn-success btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal5" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-download fa-sm text-white-50"></i> Download Data</button>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <span> Data Otomatis Akan Hilang 30 hari Setelah Proses Input Data, Setelah Input Data Silahkan Klik Tombol Download Data Untuk Backup / Laporan Data</span>

                    <table class="table table-bordered" id="admin" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan</th>
                                <th>Gaji Pokok</th>
                                <th>Tunjangan Jabatan</th>
                                <th>Perjam</th>
                                <th>Total Tunjangan Tidak Tetap</th>
                                <th>Action</th>
                                <th>Detail</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $SqlQuery = mysqli_query($con, "SELECT * FROM `tunjangan_tidak_tetap` as t INNER JOIN dt_karyawan as d on t.nip = d.nip");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                                    $nip = $row['nip'];
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nip'] ?></td>
                                        <td><?= $row['nama_karyawan'] ?></td>
                                        <td><?= $row['devisi'] ?></td>
                                        <td>
                                            Rp.<?= number_format($row['gaji_pokok'], 2, ",", ".") ?>.,-</td>
                                        <td>
                                            Rp.<?= number_format($row['t_jabatan'], 2, ",", ".") ?>.,-
                                        </td>

                                        <td>Rp.<?= number_format(round($row['total_perjam'], 0), 2, ",", ".") ?>.,-</td>
                                        <td>
                                            <?php
                                            $qdatagrid = "SELECT SUM(total_jam) FROM dt_karyawan as d inner join jam_kerja as j on d.nip = j.nip WHERE d.nip = '$nip'";
                                            $rdatagrid = mysqli_query($con, $qdatagrid);
                                            $rowjumlah = mysqli_fetch_array($rdatagrid);

                                            if ($cek = mysqli_num_rows($rdatagrid) > 0) {

                                                $jumlahjam =  round($rowjumlah['SUM(total_jam)'], 0);
                                                $ttp =  round($row['total_perjam'], 0) * $jumlahjam;

                                                echo 'Rp' . number_format($ttp, 0, ",", ".") . '.,-';
                                            } else {
                                                $ttp = round($rowjumlah['SUM(total_jam)'], 0);

                                                echo 'Rp' . number_format($ttp, 0, ",", ".") . '.,-';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="edit.php?nip=<?= $row['nip'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Edit"><i class="fas fa-edit"></i></a>

                                                <a href="delete.php?id=<?= $row['id_tunjangantidaktetap'] ?>" class="btn btn-danger btn-xs delete-data mr-1 mt-3" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                        <td>
                                            <a href="detail.php?detail=<?= $row['nip'] ?>" class="btn btn-success btn-xs  btn-action mr-1 mt-3" title="Detail">Detail Perjam</a>

                                        </td>
                                        </center>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan=\"8\" align=\"center\">data tidak ada</td></tr>";
                            }
                            ?>
                        </tbody>

                </div>
                <!-- MODAL -->

                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Data Tunjangan Sebelumnya</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="datasebelumnya.php" method="POST">
                                <div class="modal-body">

                                    <div class="section-title mt-0">Nama Devisi</div>
                                    <div class="input-group mb-2">
                                        <select class="form-control " name="devisi" required>
                                            <option disabled selected> Pilih Devisi</option>
                                            <?php

                                            $sqlsiswa = mysqli_query($con, "select DISTINCT(devisi) from dt_karyawan ");
                                            while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                                            ?>
                                                <option value="<?= $row2['devisi'] ?>"><?= $row2['devisi'] ?></option>

                                            <?php


                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="widget-body mt-3">
                                        <div class="form-group">
                                            <div class="section-title mt-0">Bulan</div>
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
                                            <div class="section-title mt-0">Tahun</div>
                                            <select class="custom-select" name="tahun">
                                                <option disabled selected> Tahun </option>
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
                                        <button class="btn btn-primary mr-1" type="submit" name="cekdata">Cek</button>

                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!-- MODAL -->

            <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Download Data Tunjangan Tetap</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="datasebelumnya2.php" method="POST">
                            <div class="modal-body">

                                <div class="section-title mt-0">Nama Devisi</div>
                                <div class="input-group mb-2">
                                    <select class="form-control " name="devisi" required>
                                        <option disabled selected> Pilih Devisi</option>
                                        <?php

                                        $sqlsiswa = mysqli_query($con, "select DISTINCT(devisi) from dt_karyawan ");
                                        while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                                        ?>
                                            <option value="<?= $row2['devisi'] ?>"><?= $row2['devisi'] ?></option>

                                        <?php


                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="widget-body mt-3">
                                    <div class="form-group">
                                        <div class="section-title mt-0">Bulan</div>
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
                                        <div class="section-title mt-0">Tahun</div>
                                        <select class="custom-select" name="tahun">
                                            <option disabled selected> Tahun </option>
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
                                    <button class="btn btn-primary mr-1" type="submit" name="cekdata">Cek</button>

                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


        <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Tambah Tunjangan Tidak Tetap</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="perjam" action="" method="POST">
                        <div class="modal-body">

                            <div class="section-title mt-0">Nama Karyawan</div>
                            <div class="input-group mb-2">
                                <select class="form-control " id="karyawan1" name="karyawan1" required>
                                    <option disabled selected> Pilih Karyawan</option>
                                    <?php

                                    $sqlsiswa = mysqli_query($con, "select * from dt_karyawan ");
                                    while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                                    ?>
                                        <option value="<?= $row2['nip'] ?>"><?= $row2['nama_karyawan'] ?></option>

                                    <?php


                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="section-title mt-0">Gaji Pokok</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="gaji_pokok" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="section-title mt-0">Tunjangan Jabatan</div>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="t_jabatan" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary mr-1" type="submit" name="submittp">Simpan</button>

                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                            </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php
    if (isset($_POST['submittp'])) {
        $nip = $_POST['karyawan1'];
        $gaji = $_POST['gaji_pokok'];
        $tunjangan = $_POST['t_jabatan'];


        $hitung = $gaji + $tunjangan;

        $perjam =  round($hitung / 182, 0);

        $tanggal = date('Y-m-d');


        $save = mysqli_query($con, "INSERT INTO tunjangan_tidak_tetap VALUES ('','$nip', '$gaji', '$tunjangan', '$perjam', '$tanggal')") or die(mysqli_error($con));
        echo "<script type='text/javascript'>
                        setTimeout(function () { 
                           swal({ 
                               title: 'Suksess', 
                               text: 'Data Berhasil Disimpan', 
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

    <!-- MODAL -->

    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Upload Data Perjam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="section-title">Upload File Excel</div>
                            <div class="custom-file">
                                <input type="file" name="namafile">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary mr-1" type="submit" name="uploadexcel">Simpan</button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <?php
    if (isset($_POST['uploadexcel'])) {


        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if (isset($_FILES['namafile']['name']) && in_array($_FILES['namafile']['type'], $file_mimes)) {

            $arr_file = explode('.', $_FILES['namafile']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }

            $spreadsheet = $reader->load($_FILES['namafile']['tmp_name']);

            function hari_ini($tanggal)
            {

                $hari = date("D", strtotime($tanggal));

                switch ($hari) {
                    case 'Sun':
                        $hari_ini = "Minggu";
                        break;

                    case 'Mon':
                        $hari_ini = "Senin";
                        break;

                    case 'Tue':
                        $hari_ini = "Selasa";
                        break;

                    case 'Wed':
                        $hari_ini = "Rabu";
                        break;

                    case 'Thu':
                        $hari_ini = "Kamis";
                        break;

                    case 'Fri':
                        $hari_ini = "Jumat";
                        break;

                    case 'Sat':
                        $hari_ini = "Sabtu";
                        break;

                    default:
                        $hari_ini = "Tidak di ketahui";
                        break;
                }

                return $hari_ini;
            }

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for ($i = 2; $i < count($sheetData); $i++) {

                $nip    = $sheetData[$i]['0'];
                $date  = $sheetData[$i]['6'];
                $tanggal =  date('Y-m-d', strtotime($date));
                // $scan1  = $sheetData[$i]['7'];
                // $scan2 = $sheetData[$i]['8'];
                // $scan3 = $sheetData[$i]['9'];
                // $scan4 = $sheetData[$i]['10'];

                //  data scan ubah scan1
                $datascan1 = explode('.', $sheetData[$i]['7']);
                $datajamscan1 = $datascan1[0];
                $datamenitscan1 = $datascan1[1];
                $datadetiktscan1 = $datascan1[2];

                $scan1 = $datajamscan1 . ":" . $datamenitscan1 . ":" . $datadetiktscan1;
                // data scan ubah scan 2

                $datascan2 = explode('.', $sheetData[$i]['8']);
                $datajamscan2 = $datascan2[0];
                $datamenitscan2 = $datascan2[1];
                $datadetiktscan2 = $datascan2[2];

                $scan2 = $datajamscan2 . ":" . $datamenitscan2 . ":" . $datadetiktscan2;
                // data scan ubah scan 3

                $datascan3 = explode('.', $sheetData[$i]['9']);
                $datajamscan3 = $datascan3[0];
                $datamenitscan3 = $datascan3[1];
                $datadetiktscan3 = $datascan3[2];

                $scan3 = $datajamscan3 . ":" . $datamenitscan3 . ":" . $datadetiktscan3;

                // data scan ubah scan 4

                $datascan4 = explode('.', $sheetData[$i]['10']);
                $datajamscan4 = $datascan4[0];
                $datamenitscan4 = $datascan4[1];
                $datadetiktscan4 = $datascan4[2];

                $scan4 = $datajamscan4 . ":" . $datamenitscan4 . ":" . $datadetiktscan4;
                // 
                $day = hari_ini($tanggal);

                if ($day == 'Minggu') {
                    $waktuawal = $scan2;
                    $waktuakhir = $scan1;
                    $awal  = date_create($waktuawal);
                    $akhir = date_create($waktuakhir); // waktu sekarang, pukul 06:13
                    $diff  = date_diff($akhir, $awal);
                    $jam1 = $diff->h; // Hasil: 5

                    $menit1 = $diff->i; // Hasil: 5

                    $detk1 = $diff->s; // Hasil: 5

                    $waktuawal2 = $scan4;
                    $waktuakhir2 = $scan3;
                    $awal2  = date_create($waktuawal2);
                    $akhir2 = date_create($waktuakhir2); // waktu sekarang, pukul 06:13
                    $diff2  = date_diff($akhir2, $awal2);
                    $jam2 = $diff2->h; // Hasil: 5
                    $menit2 = $diff2->i; // Hasil: 5
                    $detik2 = $diff2->s; // Hasil: 5



                    $waktukerja = $jam1 . ":" . $menit1 . ":" . $detk1;

                    $waktukerja2 = $jam2 . ":" . $menit2 . ":" . $detik2;


                    $jam_mulai = $waktukerja;

                    $jam_selesai = $waktukerja2;




                    $data = explode(':', $jam_mulai);




                    $datajam1 = $data[0];
                    $datamenit1 = $data[1];
                    $datadetik1 = $data[2];


                    $data2 = explode(':', $jam_selesai);
                    $datajam2 = $data2[0];
                    $datamenit2 = $data2[1];
                    $datadetik2 = $data2[2];

                    $totalmenit = $datamenit1 + $datamenit2;
                    $totaldetik = $datadetik1 + $datadetik2;

                    $jammulai = $datajam1 . ':' . $datamenit1 . ':' . $datadetik1;

                    $date = date_create($jammulai);

                    date_add($date, date_interval_create_from_date_string($datajam2 . 'hours' . $datamenit2 . 'minute' . $datadetik2 . 'seconds'));
                    $waktu = date_format($date, 'H:i:s');

                    $jam3 = explode(':', $waktu);
                    $jam3[0];
                    $jam3[1];
                    $jam3[2];



                    $jammulai1 = $jam3[0] . ':' . $jam3[1] . ':' . $jam3[2];

                    $date = date_create($jammulai1);

                    date_add($date, date_interval_create_from_date_string($jam3[0] . 'hours' . $jam3[1] . 'minute' . $jam3[2] . 'seconds'));
                    $waktu = date_format($date, 'H:i:s');

                    $jam1 = explode(':', $waktu);
                    $totaljam = $jam1[0];

                    $ttl = $jam1[1];
                    // $jam1[2];

                    $totall = $ttl / 60;
                    $total = round($totaljam + $totall, 2);

                    $date = date('Y-m-d');
                    $save = mysqli_query($con, "INSERT INTO jam_kerja VALUES ('',  '$nip', '$tanggal', '$scan1', '$scan2', '$scan3', '$scan4', '$totaljam','$ttl','$total', '$date')") or die(mysqli_error($con));
                } else {
                    $waktuawal = $scan2;
                    $waktuakhir = $scan1;
                    $awal  = date_create($waktuawal);
                    $akhir = date_create($waktuakhir); // waktu sekarang, pukul 06:13
                    $diff  = date_diff($akhir, $awal);
                    $jam1 = $diff->h; // Hasil: 5

                    $menit1 = $diff->i; // Hasil: 5

                    $detk1 = $diff->s; // Hasil: 5

                    $waktuawal2 = $scan4;
                    $waktuakhir2 = $scan3;
                    $awal2  = date_create($waktuawal2);
                    $akhir2 = date_create($waktuakhir2); // waktu sekarang, pukul 06:13
                    $diff2  = date_diff($akhir2, $awal2);
                    $jam2 = $diff2->h; // Hasil: 5
                    $menit2 = $diff2->i; // Hasil: 5
                    $detik2 = $diff2->s; // Hasil: 5



                    $waktukerja = $jam1 . ":" . $menit1 . ":" . $detk1;

                    $waktukerja2 = $jam2 . ":" . $menit2 . ":" . $detik2;


                    $jam_mulai = $waktukerja;

                    $jam_selesai = $waktukerja2;




                    $data = explode(':', $jam_mulai);




                    $datajam1 = $data[0];
                    $datamenit1 = $data[1];
                    $datadetik1 = $data[2];


                    $data2 = explode(':', $jam_selesai);
                    $datajam2 = $data2[0];
                    $datamenit2 = $data2[1];
                    $datadetik2 = $data2[2];

                    $totalmenit = $datamenit1 + $datamenit2;
                    $totaldetik = $datadetik1 + $datadetik2;

                    $jammulai = $datajam1 . ':' . $datamenit1 . ':' . $datadetik1;

                    $date = date_create($jammulai);

                    date_add($date, date_interval_create_from_date_string($datajam2 . 'hours' . $datamenit2 . 'minute' . $datadetik2 . 'seconds'));
                    $waktu = date_format($date, 'H:i:s');

                    $jam3 = explode(':', $waktu);

                    $totaljam = $jam3[0];
                    $ttl = $jam3[1];
                    $jam3[2];

                    $totall = $ttl / 60;
                    $total = round($totaljam + $totall, 2);

                    $date = date('Y-m-d');
                    $save = mysqli_query($con, "INSERT INTO jam_kerja VALUES ('',  '$nip', '$tanggal', '$scan1', '$scan2', '$scan3', '$scan4', '$totaljam','$ttl','$total', '$date')") or die(mysqli_error($con));
                }
            }
        }
        echo "<script type='text/javascript'>
                            setTimeout(function () { 
                               swal({ 
                                   title: 'Suksess', 
                                   text: 'Data Berhasil Disimpan', 
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

    </section>
    </div>

    </div>
    </div>

    </table>
    </div>



    </div>
    </div>




    <!-- /.container-fluid -->

    </div>


    <script>
        // datatables
        $(document).ready(function() {
            $('.admin').DataTable({
                "paging": true,

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

    include_once('footer.php');
} else {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
}

// 
?>

</div>

</div>
</div>

</div>
</div>
</div>
</section>