<?php
require_once "../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- General CSS Files -->
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/sweetalert.css" type="text/css">
    <link href="../sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <title></title>
</head>

<body>
    <?php



    $id = @$_GET['id'];


    $cek = mysqli_query($con, "SELECT * FROM gaji where nip = '$id'");

    if ($cekdata = mysqli_num_rows($cek) > 0) {
    } else {

        $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_keahlian as tk ON k.nip = tk.nip where k.nip = '$id'");
        if (mysqli_num_rows($Sqlcek) > 1) {
            $Sqltotal = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as total FROM t_keahlian WHERE nip = '$id'");
            $total = mysqli_fetch_array($Sqltotal);

            $Sqltkepalakeluarga = mysqli_query($con, "select * from t_kepalakeluarga where nip = '$id'");
            $Sqltmasakerja = mysqli_query($con, "select * from t_masakkerja where nip = '$id'");
            $Sqlreward = mysqli_query($con, "select * from reward where nip = '$id'");
            $Sqllembur = mysqli_query($con, "select * from lembur where nip = '$id'");
            $Sqlinfaq = mysqli_query($con, "select * from infaq where nip = '$id'");
            $Sqlcicilan = mysqli_query($con, "select * from cicilan where nip = '$id'");

            $rowkepalakeluarga = mysqli_fetch_array($Sqltkepalakeluarga);
            $rowtmasakerja = mysqli_fetch_array($Sqltmasakerja);
            $rowreward = mysqli_fetch_array($Sqlreward);
            $rowlembur = mysqli_fetch_array($Sqllembur);
            $rowinfaq = mysqli_fetch_array($Sqlinfaq);
            $rowcicilan = mysqli_fetch_array($Sqlcicilan);
            if ($cek1 = mysqli_num_rows($Sqltkepalakeluarga) > 0 &&  $cek2 = mysqli_num_rows($Sqltmasakerja) > 0) {

                $totaltunjangantetap = $total['total'] + $rowkepalakeluarga['jumlah_tkepalakeluarga'] + $rowtmasakerja['jumlah_tmasakerja'];
            } else if ($cek1 = mysqli_num_rows($Sqltkepalakeluarga) > 0) {
                $totaltunjangantetap = $total['total'] + $rowkepalakeluarga['jumlah_tkepalakeluarga'];
            } else if ($cek2 = mysqli_num_rows($Sqltmasakerja) > 0) {

                $totaltunjangantetap = $total['total'] + $rowtmasakerja['jumlah_tmasakerja'];
            } else {
                $totaltunjangantetap;
            }
        } else  if (mysqli_num_rows($Sqlcek) > 0) {
            $total = mysqli_fetch_array($Sqlcek);
            $Sqltkepalakeluarga = mysqli_query($con, "select * from t_kepalakeluarga where nip = '$id'");
            $Sqltmasakerja = mysqli_query($con, "select * from t_masakkerja where nip = '$id'");


            $rowkepalakeluarga = mysqli_fetch_array($Sqltkepalakeluarga);
            $rowtmasakerja = mysqli_fetch_array($Sqltmasakerja);


            if ($cek1 = mysqli_num_rows($Sqltkepalakeluarga) > 0 &&  $cek2 = mysqli_num_rows($Sqltmasakerja) > 0) {

                $totaltunjangantetap = $total['total'] + $rowkepalakeluarga['jumlah_tkepalakeluarga'] + $rowtmasakerja['jumlah_tmasakerja'];
            } else if ($cek1 = mysqli_num_rows($Sqltkepalakeluarga) > 0) {
                $totaltunjangantetap = $total['total'] + $rowkepalakeluarga['jumlah_tkepalakeluarga'];
            } else if ($cek2 = mysqli_num_rows($Sqltmasakerja) > 0) {

                $totaltunjangantetap = $total['total'] + $rowtmasakerja['jumlah_tmasakerja'];
            } else {
                $totaltunjangantetap;
            }
        } else {
            $totaltunjangantetap = 0;
        }

        // reward n lembur
        $Sqltotal = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as total FROM t_keahlian WHERE nip = '$id'");
        $total = mysqli_fetch_array($Sqltotal);

        $Sqlreward = mysqli_query($con, "select * from reward where nip = '$id'");
        $Sqllembur = mysqli_query($con, "select * from lembur where nip = '$id'");

        $rowreward = mysqli_fetch_array($Sqlreward);
        $rowlembur = mysqli_fetch_array($Sqllembur);

        if ($cek1 = mysqli_num_rows($Sqlreward) > 0 && $cek1 = mysqli_num_rows($Sqllembur) > 0) {

            $totalkeseluruhan = $rowreward['jumlah_reward'] + $rowlembur['jumlah_lembur'];
        } else  if ($cek1 = mysqli_num_rows($Sqlreward) > 0) {
            $totalkeseluruhan = $rowreward['jumlah_reward'];
        } else  if ($cek1 = mysqli_num_rows($Sqllembur) > 0) {

            $totalkeseluruhan = $rowlembur['jumlah_lembur'];
        } else {

            $totalkeseluruhan = 0;
        }
        // cicilan dan infaq
        $Sqlinfaq = mysqli_query($con, "select * from infaq where nip = '$id'");
        $Sqlcicilan = mysqli_query($con, "select * from cicilan where nip = '$id'");


        $rowinfaq = mysqli_fetch_array($Sqlinfaq);
        $rowcicilan = mysqli_fetch_array($Sqlcicilan);


        if ($cek1 = mysqli_num_rows($Sqlinfaq) > 0 && $cek1 = mysqli_num_rows($Sqlcicilan) > 0) {

            $totalkeseluruhan2 = $rowinfaq['jumlah_infaq'] + $rowcicilan['jumlah_cicilan'];
        } else  if ($cek1 = mysqli_num_rows($Sqlinfaq) > 0) {
            $totalkeseluruhan2 = $rowinfaq['jumlah_infaq'];
        } else  if ($cek1 = mysqli_num_rows($Sqlcicilan) > 0) {

            $totalkeseluruhan2 = $rowcicilan['jumlah_cicilan'];
        } else {
            $totalkeseluruhan2 = 0;
        }

        $Sqltunjangantidaktetap = mysqli_query($con, "SELECT * FROM `tunjangan_tidak_tetap` as t INNER JOIN dt_karyawan as d on t.nip = d.nip where d.nip = '$id'");
        $rowtunjangantidaktetap = mysqli_fetch_array($Sqltunjangantidaktetap);

        if (mysqli_num_rows($Sqltunjangantidaktetap) > 0) {

            $qdatagrid = "SELECT SUM(total_jam) FROM dt_karyawan as d inner join jam_kerja as j on d.nip = j.nip WHERE d.nip = '$id'";
            $rdatagrid = mysqli_query($con, $qdatagrid);
            $rowjumlah = mysqli_fetch_array($rdatagrid);

            $ttp = round($rowjumlah['SUM(total_jam)'], 0) * $rowtunjangantidaktetap['total_perjam'];

            $tunjangan = $ttp + $totaltunjangantetap + $totalkeseluruhan;
            $ttl = $tunjangan - $totalkeseluruhan2;
        } else {
            $tunjangan = 0 + $totaltunjangantetap + $totalkeseluruhan;
            $ttl = $tunjangan - $totalkeseluruhan2;
        }
        $tgl = date('Y-m-d');

        $karyawan = mysqli_query($con, "SELECT * FROM dt_karyawan where nip = '$id'");
        $datakaryawan = mysqli_fetch_array($karyawan);
        $devisi1 = $datakaryawan['devisi'];

        $gajiperdevisi = mysqli_query($con, "SELECT * FROM total_gaji_perdevisi where devisi = '$devisi1'");

        if ($rowgaji = mysqli_num_rows($gajiperdevisi) > 0) {
            $total = $ttl + $rowgaji;
            $update = mysqli_query($con, "UPDATE total_gaji_perdevisi set totalgaji = '$total' WHERE devisi = '$devisi1'") or die(mysqli_error($con));
        } else {
            $save = mysqli_query($con, "INSERT INTO total_gaji_perdevisi VALUES ('', '$devisi1', '$ttl', '$tgl' )") or die(mysqli_error($con));
        }
        $save = mysqli_query($con, "INSERT INTO gaji VALUES ('', '$id', '$ttl', 'Sudah Di Bayar', '$tgl' )") or die(mysqli_error($con));
    }



    echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'BERHASIL', 
            text:  'PEMBAYARAN BERHASIL DI KOMFIRMASI',
            type: 'success',
            timer: 1000,
            ConfirmButton: 'OK',
            showConfirmButton: true});
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('index.php');
    } ,1000); 
    </script>";
    ?>


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <script src="../js/sweetalert.min.js"></script>
    <script src="../sweetalert/sweetalert.min.js"></script>
</body>

</html>