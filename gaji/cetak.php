<?php
require_once "../config/config.php";
$tahun = @$_POST['tahun'];
require('../vendor/fpdf184/fpdf.php');
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $Sqlkeahlian = mysqli_query($con, "SELECT * FROM t_keahlian where nip='$id'");
    $Sqltkepalakeluarga = mysqli_query($con, "SELECT * FROM t_kepalakeluarga where nip='$id'");
    $Sqltmasakerja = mysqli_query($con, "SELECT * FROM t_masakkerja where nip='$id'");
    $Sqltreward = mysqli_query($con, "SELECT * FROM reward where nip='$id'");
    $Sqlinfaq = mysqli_query($con, "SELECT * FROM infaq where nip='$id'");
    $Sqllembur = mysqli_query($con, "SELECT * FROM lembur where nip='$id'");
    $Sqlcicilan = mysqli_query($con, "SELECT * FROM cicilan where nip='$id'");


    $result = mysqli_query($con, "select * from dt_karyawan where nip = '$id'");
    $row = mysqli_fetch_array($result);
    $pdf = new FPDF('P', 'mm', 'A4');

    $pdf->AddPage();

    $date = date('d-m-Y');

    //set font jadi arial, bold, 14pt
    $pdf->SetFont('Arial', 'B', 14);



    $pdf->Cell(200, 5, 'STRUK GAJI KARYAWAN', 0, 0, 'C');

    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(189, 10, '', 0, 1); //end of line
    //Cell(width , height , text , border , end line , [align] )

    $pdf->Cell(130, 5, 'DETAIL KARYAWAN', 0, 0);
    $pdf->Cell(59, 5, 'PEMBAYARAN', 0, 1); //end of line

    //set font jadi arial, regular, 12pt

    $pdf->SetFont('Arial', '', 12);


    $pdf->Cell(130, 5, 'Nama Karyawan   : ' . $row['nama_karyawan'], 0, 0);
    $pdf->Cell(25, 5, 'Tgl Cetak     : ', 0, 0);
    $pdf->Cell(50, 5, $date, 0, 1); //end of line

    $pdf->Cell(130, 5, 'Devisi                    : ' . $row['devisi'], 0, 0);
    $pdf->Cell(25, 5, 'Status          :', 0, 0);

    $Sqlgaji = mysqli_query($con, "Select * From gaji where nip = '$id'");
    $rowgaji = mysqli_fetch_array($Sqlgaji);

    if (mysqli_num_rows($Sqlgaji) > 0) {
        $pdf->Cell(34, 5, ' Sudah Di Bayar', 0, 1); //end of line
    } else {
        $pdf->Cell(34, 5, ' Belum Di Bayar', 0, 1); //end of line
    }


    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(25, 5, 'Take Home  :', 0, 0);
    $pdf->Cell(34, 5, '', 0, 1); //end of line

    $pdf->Cell(130, 5, '', 0, 0);


    // tunjangan
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

        $ttp = round($rowjumlah['SUM(total_jam)'], 2) * $rowtunjangantidaktetap['total_perjam'];

        $tunjangan = $ttp + $totaltunjangantetap + $totalkeseluruhan;
        $ttl = $tunjangan - $totalkeseluruhan2;
        $pdf->Cell(25, 5, 'Rp.' . number_format($ttl, 2, ",", "."), 0, 0);
    } else {
        $tunjangan = 0 + $totaltunjangantetap + $totalkeseluruhan;
        $ttl = $tunjangan - $totalkeseluruhan2;
        $pdf->Cell(25, 5, 'Rp.' . number_format($ttl, 2, ",", "."), 0, 0);
    }



    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(25, 5, '', 0, 0);
    $pdf->Cell(34, 5, '', 0, 0); //end of line

    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(189, 10, '', 0, 1); //end of line

    //alamat billing 
    $pdf->Cell(100, 0, 'Total Tunjangan Tidak Tetap', 0, 1); //end of line



    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(10, 3, '', 0, 1); //end of line

    //invoice 
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(130, 5, 'Tunjangan Tidak Tetap', 1, 0, 'C');
    $pdf->Cell(55, 5, 'Total', 1, 1, 'R');


    $pdf->SetFont('Arial', '', 12);

    //Angka diratakan kanan, jadi kita beri property 'R'
    $Sqttp = mysqli_query($con, "select * from tunjangan_tidak_tetap where nip = '$id'");
    $no = 1;
    if (mysqli_num_rows($Sqttp) > 0) {
        while ($rowttp = mysqli_fetch_array($Sqttp)) {

            $pdf->Cell(130, 5, 'Gaji Pokok', 1, 0);

            $pdf->Cell(55, 5,  number_format($rowttp['gaji_pokok'], 2, ",", "."), 1, 1, 'R'); //end of line
            $pdf->Cell(130, 5, 'Tunjangan Jabatan', 1, 0);

            $pdf->Cell(55, 5, number_format($rowttp['t_jabatan'], 2, ",", "."), 1, 1, 'R'); //end of line

            $pdf->Cell(130, 5, 'Perjam', 1, 0);

            $pdf->Cell(55, 5, $rowttp['total_perjam'], 1, 1, 'R'); //end of line

        }
    } else {
        $pdf->Cell(130, 5, '', 1, 0);

        $pdf->Cell(55, 5, '', 1, 1, 'R'); //end of line

    }

    //Angka diratakan kanan, jadi kita beri property 'R'
    $sqljam = "SELECT SUM(total_jam) FROM dt_karyawan as d inner join jam_kerja as j on d.nip = j.nip WHERE d.nip = '$id'";
    $rjam = mysqli_query($con, $sqljam);
    $totaljam = mysqli_fetch_array($rjam);

    if (mysqli_num_rows($rjam) > 0) {
        $pdf->Cell(130, 5, 'Jumlah Jam', 1, 0);

        $pdf->Cell(55, 5, round($totaljam['SUM(total_jam)'], 0), 1, 1, 'R'); //end of line

    } else {
        $pdf->Cell(130, 5, '', 1, 0);

        $pdf->Cell(55, 5, '', 1, 1, 'R'); //end of line

    }

    $pdf->SetFont('Arial', 'B', 12);
    //total
    $pdf->Cell(105, 5, '', 0, 0);
    $pdf->Cell(25, 5, 'Total', 0, 0, 'R');
    $pdf->Cell(8, 5, 'Rp', 1, 0);

    $Sqltunjangantidaktetap = mysqli_query($con, "SELECT * FROM `tunjangan_tidak_tetap` as t INNER JOIN dt_karyawan as d on t.nip = d.nip where d.nip = '$id'");
    $rowtunjangantidaktetap = mysqli_fetch_array($Sqltunjangantidaktetap);

    if (mysqli_num_rows($Sqltunjangantidaktetap) > 0) {

        $qdatagrid = "SELECT SUM(total_jam) FROM dt_karyawan as d inner join jam_kerja as j on d.nip = j.nip WHERE d.nip = '$id'";
        $rdatagrid = mysqli_query($con, $qdatagrid);
        $rowjumlah = mysqli_fetch_array($rdatagrid);

        $ttp = round($rowjumlah['SUM(total_jam)'], 0) * $rowtunjangantidaktetap['total_perjam'];

        $pdf->Cell(47, 5, number_format($ttp, 2, ",", "."), 1, 1, 'R'); //end of line
    }
    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(189, 10, '', 0, 1); //end of line

    $pdf->SetFont('Arial', '', 12);
    //alamat billing 
    $pdf->Cell(100, 0, 'Total Tunjangan Tetap', 0, 1); //end of line



    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(10, 3, '', 0, 1); //end of line

    //invoice 
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(130, 5, 'Tunjangan Keahlian', 1, 0, 'C');
    $pdf->Cell(55, 5, 'Total', 1, 1, 'R');


    $pdf->SetFont('Arial', '', 12);

    //Angka diratakan kanan, jadi kita beri property 'R'
    $Sqltkeahlian = mysqli_query($con, "select * from t_keahlian where nip = '$id'");
    $no = 1;
    if (mysqli_num_rows($Sqltkeahlian) > 0) {
        while ($rowkeahlian = mysqli_fetch_array($Sqltkeahlian)) {


            $pdf->Cell(130, 5, $rowkeahlian['nama_keahlian'], 1, 0);

            $pdf->Cell(55, 5, number_format($rowkeahlian['jumlah_tunjangan_keahlian'], 2, ",", "."), 1, 1, 'R'); //end of line

        }
    } else {
        $pdf->Cell(130, 5, '', 1, 0);

        $pdf->Cell(55, 5, '', 1, 1, 'R'); //end of line

    }

    $pdf->SetFont('Arial', 'B', 12);
    //total
    $pdf->Cell(130, 10, 'Total', 1, 0, 'R');

    $pdf->Cell(8, 10, 'Rp', 1, 0);

    // query

    $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_keahlian as tk ON k.nip = tk.nip where k.nip = '$id'");
    if (mysqli_num_rows($Sqlcek) > 1) {
        $Sqltotal = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as total FROM t_keahlian WHERE nip = '$id'");
        $total = mysqli_fetch_array($Sqltotal);

        $jmlhtunjangankeahlian = $total['total'];

        $pdf->Cell(47, 10, number_format($total['total'], 2, ",", "."), 1, 1, 'R'); //end of line

    } else  if (mysqli_num_rows($Sqlcek) > 0) {
        $total = mysqli_fetch_array($Sqlcek);
        $pdf->Cell(47, 10, number_format($total['total'], 2, ",", "."), 1, 1, 'R'); //end of line

    } else {
        $pdf->Cell(47, 10, number_format('0', 2, ",", "."), 1, 1, 'R'); //end of line
    }



    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(130, 5, 'Tunjangan Kepala Keluarga', 1, 0, 'C');
    $pdf->Cell(55, 5, 'Total', 1, 1, 'R');


    $pdf->SetFont('Arial', '', 12);

    //Angka diratakan kanan, jadi kita beri property 'R'

    $Sqlkepalakeluarga = mysqli_query($con, "select * from t_kepalakeluarga where nip = '$id'");
    $no = 1;
    if (mysqli_num_rows($Sqlkepalakeluarga) > 0) {
        while ($rowkepalakeluarga = mysqli_fetch_array($Sqlkepalakeluarga)) {
            $pdf->Cell(130, 5, 'Tunjangan Kepala Keluarga', 1, 0);

            $jmlhkepalakeluarga = $rowkepalakeluarga['jumlah_tkepalakeluarga'];

            $pdf->Cell(55, 5, number_format($rowkepalakeluarga['jumlah_tkepalakeluarga'], 2, ",", "."), 1, 1, 'R'); //end of line

            $pdf->SetFont('Arial', 'B', 12);

            //total
            $pdf->Cell(130, 10, 'Total', 1, 0, 'R');

            $pdf->Cell(8, 10, 'Rp', 1, 0);
            $pdf->Cell(47, 10, number_format($rowkepalakeluarga['jumlah_tkepalakeluarga'], 2, ",", "."), 1, 1, 'R'); //end of line

        }
    } else {
        $pdf->Cell(130, 5, ' ', 1, 0);

        $pdf->Cell(55, 5, '', 1, 1, 'R'); //end of line

        $pdf->Cell(130, 10, 'Total', 1, 0, 'R');

        $pdf->Cell(8, 10, 'Rp', 1, 0);
        $pdf->Cell(47, 10, '', 1, 1, 'R'); //end of line


    }




    // tunjangan kepala keluarga

    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(130, 5, 'Tunjangan Masa Kerja', 1, 0, 'C');
    $pdf->Cell(55, 5, 'Total', 1, 1, 'R');


    $pdf->SetFont('Arial', '', 12);

    //Angka diratakan kanan, jadi kita beri property 'R'
    $SqlQuery = mysqli_query($con, "select * from t_masakkerja where nip = '$id'");
    $no = 1;
    if (mysqli_num_rows($SqlQuery) > 0) {
        while ($row = mysqli_fetch_array($SqlQuery)) {
            $pdf->Cell(130, 5, 'Tunjangan Masa Kerja', 1, 0);

            $pdf->Cell(55, 5, number_format($row['jumlah_tmasakerja'], 2, ",", "."), 1, 1, 'R'); //end of line


            $pdf->SetFont('Arial', 'B', 12);

            //total
            $pdf->Cell(130, 10, 'Total', 1, 0, 'R');

            $pdf->Cell(8, 10, 'Rp', 1, 0);
            $jmlhtmasakerja = $row['jumlah_tmasakerja'];
            $pdf->Cell(47, 10, number_format($row['jumlah_tmasakerja'], 2, ",", "."), 1, 1, 'R'); //end of line
        }
    } else {

        $pdf->Cell(130, 5, ' ', 1, 0);

        $pdf->Cell(55, 5, '', 1, 1, 'R'); //end of line

        $pdf->Cell(130, 10, 'Total', 1, 0, 'R');

        $pdf->Cell(8, 10, 'Rp', 1, 0);

        $pdf->Cell(47, 10, '', 1, 1, 'R'); //end of line
    }

    //total
    $pdf->Cell(130, 10, 'Jumlah Tunjangan', 0, 0, 'R');

    $pdf->Cell(8, 10, 'Rp', 1, 0);


    // total tunjangan
    if (mysqli_num_rows($Sqlkepalakeluarga) > 0) {
        $jmlh = $jmlhkepalakeluarga + $jmlhtmasakerja + $jmlhtunjangankeahlian;
        $pdf->Cell(47, 10, number_format($jmlh, 2, ",", "."), 1, 1, 'R'); //end of line

    } else if (mysqli_num_rows($Sqltmasakerja) > 0) {
        $jmlh = $jmlhtmasakerja + $jmlhtunjangankeahlian;
        $pdf->Cell(47, 10, number_format($jmlh, 2, ",", "."), 1, 1, 'R'); //end of line

    } else if (mysqli_num_rows($Sqltkeahlian) > 0) {
        $jmlh = $jmlhtunjangankeahlian;
        $pdf->Cell(47, 10, number_format($jmlh, 2, ",", "."), 1, 1, 'R'); //end of line

    } else {
        $pdf->Cell(47, 10, '0', 1, 1, 'R'); //end of line

    }
    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(189, 10, '', 0, 1); //end of line

    $pdf->SetFont('Arial', '', 12);
    //alamat billing 


    $pdf->Cell(100, 0, 'Total Reward & Lembur', 0, 1); //end of line



    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(10, 3, '', 0, 1); //end of line

    //invoice 
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(130, 5, 'Reward & Lembur', 1, 0, 'C');
    $pdf->Cell(55, 5, 'Total', 1, 1, 'R');


    $pdf->SetFont('Arial', '', 12);

    //Angka diratakan kanan, jadi kita beri property 'R'
    $Sqlreward = mysqli_query($con, "select * from reward where nip = '$id'");
    $no = 1;
    if ($rreward = mysqli_num_rows($Sqlreward) > 0) {
        while ($rowreward = mysqli_fetch_array($Sqlreward)) {
            $pdf->Cell(130, 5, 'Reward', 1, 0);
            $reward = $rowreward['jumlah_reward'];
            $pdf->Cell(55, 5, number_format($rowreward['jumlah_reward'], 2, ",", "."), 1, 1, 'R'); //end of line
        }
    }

    $Sqllembur = mysqli_query($con, "select * from lembur where nip = '$id'");
    $no = 1;
    if ($rlembur = mysqli_num_rows($Sqllembur) > 0) {
        while ($rowlembur = mysqli_fetch_array($Sqllembur)) {
            $pdf->Cell(130, 5, 'Lembur', 1, 0);
            $lembur = $rowlembur['jumlah_lembur'];
            $pdf->Cell(55, 5, number_format($rowlembur['jumlah_lembur'], 2, ",", "."), 1, 1, 'R'); //end of line
        }
    }

    $pdf->SetFont('Arial', 'B', 12);
    //total
    $pdf->Cell(105, 5, '', 0, 0);
    $pdf->Cell(25, 5, 'Total', 0, 0, 'R');
    $pdf->Cell(8, 5, 'Rp', 1, 0);
    if ($rlembur = mysqli_num_rows($Sqllembur) > 0 && $rreward = mysqli_num_rows($Sqlreward) > 0) {

        $totalrl = $lembur + $reward;
        $pdf->Cell(47, 5, number_format($totalrl, 2, ",", "."), 1, 1, 'R'); //end of line
    } else  if ($rlembur = mysqli_num_rows($Sqllembur) > 0) {
        $pdf->Cell(47, 5, number_format($lembur, 2, ",", "."), 1, 1, 'R'); //end of line

    } else  if ($rlembur = mysqli_num_rows($Sqlreward) > 0) {
        $pdf->Cell(47, 5, number_format($reward, 2, ",", "."), 1, 1, 'R'); //end of line

    } else {
        $pdf->Cell(47, 5, number_format(0, 2, ",", "."), 1, 1, 'R'); //end of line

    }


    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(189, 10, '', 0, 1); //end of line

    $pdf->SetFont('Arial', '', 12);
    //alamat billing 


    $pdf->Cell(100, 0, 'Total Infaq & Cicilan', 0, 1); //end of line



    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(10, 3, '', 0, 1); //end of line

    //invoice 
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(130, 5, 'Infaq & Cicilan', 1, 0, 'C');
    $pdf->Cell(55, 5, 'Total', 1, 1, 'R');


    $pdf->SetFont('Arial', '', 12);

    //Angka diratakan kanan, jadi kita beri property 'R'
    $Sqlcicilan = mysqli_query($con, "select * from cicilan where nip = '$id'");

    if ($rlcicilan = mysqli_num_rows($Sqlcicilan) > 0) {
        while ($rowcicilan = mysqli_fetch_array($Sqlcicilan)) {
            $pdf->Cell(130, 5, 'Cicilan', 1, 0);
            $cicilan = $rowcicilan['jumlah_cicilan'];
            $pdf->Cell(55, 5, number_format($rowcicilan['jumlah_cicilan'], 2, ",", "."), 1, 1, 'R'); //end of line
        }
    }

    $Sqlinfaq = mysqli_query($con, "select * from infaq where nip = '$id'");

    if ($rlinfaq = mysqli_num_rows($Sqlinfaq) > 0) {
        while ($rowinfaq = mysqli_fetch_array($Sqlinfaq)) {
            $pdf->Cell(130, 5, 'Infaq', 1, 0);
            $infaq = $rowinfaq['jumlah_infaq'];
            $pdf->Cell(55, 5, number_format($rowinfaq['jumlah_infaq'], 2, ",", "."), 1, 1, 'R'); //end of line
        }
    }

    $pdf->SetFont('Arial', 'B', 12);

    //total


    $pdf->Cell(105, 5, '', 0, 0);
    $pdf->Cell(25, 5, 'Total', 0, 0, 'R');

    $pdf->Cell(8, 5, 'Rp', 1, 0);
    if ($rlcicilan = mysqli_num_rows($Sqlcicilan) > 0 && $rlinfaq = mysqli_num_rows($Sqlinfaq) > 0) {

        $totalci = $infaq + $cicilan;
        $pdf->Cell(47, 5, number_format($totalci, 2, ",", "."), 1, 1, 'R'); //end of line
    } else  if ($rlcicilan = mysqli_num_rows($Sqlcicilan) > 0) {
        $pdf->Cell(47, 5, number_format($cicilan, 2, ",", "."), 1, 1, 'R'); //end of line

    } else  if ($rlinfaq = mysqli_num_rows($Sqlinfaq) > 0) {
        $pdf->Cell(47, 5, number_format($infaq, 2, ",", "."), 1, 1, 'R'); //end of line

    } else {
        $pdf->Cell(47, 5, number_format('', 2, ",", "."), 1, 1, 'R'); //end of line
    }


    $pdf->Cell(500, 10, '', 0, 1); //end of line
    $pdf->SetFont('Arial', 'B', 14);

    $pdf->Cell(200, 25, '.................................. MATUR SUON :) .......................................', 0, 0, 'C');

    //buat dummy cell untuk memberi jarak vertikal

    $pdf->Output();

?>




<?php
}

?>