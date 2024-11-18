<?php
require_once "../../config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- General CSS Files -->
    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/sweetalert.css" type="text/css">
    <link href="../../sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <title></title>
</head>

<body>
    <?php



    if (isset($_GET['idkeahlian'])) {


        $id = @$_GET['idkeahlian'];
        $sql_keahlian = mysqli_query($con, "SELECT * FROM t_keahlian as t INNER JOIN dt_karyawan as d on t.nip = d.nip where id_keahlian = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_keahlian);

        $nip = $data['nip'];


        $del1 = mysqli_query($con, "DELETE FROM t_keahlian WHERE id_keahlian='$id'");
        echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'BERHASIL', 
            text:  'HAPUS DATA BERHASIL',
            type: 'success',
            timer: 1000,
            ConfirmButton: 'OK',
            showConfirmButton: true});
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('detail.php?id=$nip');
    } ,1000); 
    </script>";
    } else  if (isset($_GET['idkepalakeluarga'])) {

        $id = @$_GET['idkepalakeluarga'];
        $sql_kepalakeluarga = mysqli_query($con, "SELECT * FROM t_kepalakeluarga as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_tkepalakeluarga = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_kepalakeluarga);

        $nip = $data['nip'];



        $del1 = mysqli_query($con, "DELETE FROM t_kepalakeluarga WHERE id_tkepalakeluarga='$id'");
        echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'BERHASIL', 
            text:  'HAPUS DATA BERHASIL',
            type: 'success',
            timer: 1000,
            ConfirmButton: 'OK',
            showConfirmButton: true});
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('detail.php?id=$nip');
    } ,1000); 
    </script>";
    } else  if (isset($_GET['idmasakerja'])) {

        $id = @$_GET['idmasakerja'];

        $sql_tmasakerja = mysqli_query($con, "SELECT * FROM t_masakkerja as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_tmasakerja = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_tmasakerja);

        $nip = $data['nip'];



        $del1 = mysqli_query($con, "DELETE FROM t_masakerja WHERE id_tmasakerja='$id'");
        echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'BERHASIL', 
            text:  'HAPUS DATA BERHASIL',
            type: 'success',
            timer: 1000,
            ConfirmButton: 'OK',
            showConfirmButton: true});
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('index.php?id=$nip');
    } ,1000); 
    </script>";
    } else  if (isset($_GET['idreward'])) {

        $id = @$_GET['idreward'];

        $sql_reward = mysqli_query($con, "SELECT * FROM reward as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_reward = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_reward);

        $nip = $data['nip'];

        $del1 = mysqli_query($con, "DELETE FROM reward WHERE id_reward='$id'");
        echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'BERHASIL', 
            text:  'HAPUS DATA BERHASIL',
            type: 'success',
            timer: 1000,
            ConfirmButton: 'OK',
            showConfirmButton: true});
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('detail.php?id=$nip');
    } ,1000); 
    </script>";
    } else  if (isset($_GET['idlembur'])) {

        $id = @$_GET['idlembur'];
        $sql_lembur = mysqli_query($con, "SELECT * FROM lembur as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_lembur = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_lembur);

        $nip = $data['nip'];


        $del1 = mysqli_query($con, "DELETE FROM lembur WHERE id_lembur='$id'");
        echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'BERHASIL', 
            text:  'HAPUS DATA BERHASIL',
            type: 'success',
            timer: 1000,
            ConfirmButton: 'OK',
            showConfirmButton: true});
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('detail.php?id=$nip');
    } ,1000); 
    </script>";
    } else  if (isset($_GET['idcicilan'])) {


        $id = @$_GET['idcicilan'];
        $sql_reward = mysqli_query($con, "SELECT * FROM cicilan as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_cicilan = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_reward);

        $nip = $data['nip'];

        $del1 = mysqli_query($con, "DELETE FROM cicilan WHERE id_cicilan='$id'");
        echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'BERHASIL', 
            text:  'HAPUS DATA BERHASIL',
            type: 'success',
            timer: 1000,
            ConfirmButton: 'OK',
            showConfirmButton: true});
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('detail.php?id=$nip');
    } ,1000); 
    </script>";
    } else  if (isset($_GET['idinfaq'])) {
        $id = @$_GET['idinfaq'];
        $sql_infaq = mysqli_query($con, "SELECT * FROM infaq as t INNER JOIN dt_karyawan as d ON t.nip = d.nip WHERE t.id_infaq = '$id'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql_infaq);

        $nip = $data['nip'];


        $del1 = mysqli_query($con, "DELETE FROM infaq WHERE id_infaq='$id'");
        echo "<script type='text/javascript'>
    setTimeout(function () { 
        swal({ 
            title: 'BERHASIL', 
            text:  'HAPUS DATA BERHASIL',
            type: 'success',
            timer: 1000,
            ConfirmButton: 'OK',
            showConfirmButton: true});
    },10);  
    window.setTimeout(function(){ 
      window.location.replace('detail.php?id=$nip');
    } ,1000); 
    </script>";
    }
    ?>


    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>

    <script src="../../js/sweetalert.min.js"></script>
    <script src="../../sweetalert/sweetalert.min.js"></script>
</body>

</html>