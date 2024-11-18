<?php

require_once "../../config/config.php";
$tahun = @$_POST['tahun'];
require('../../vendor/fpdf184/fpdf.php');


if (isset($_POST['cekdata'])) {

    $devisi = $_POST['devisi'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    $pdf = new FPDF('L', 'mm', 'A4');

    $pdf->AddPage();

    $date = date('d-m-Y');

    //set font jadi arial, bold, 14pt
    $pdf->SetFont('Arial', 'B', 14);

    $rowdevisi = mysqli_query($con, "SELECT * FROM dt_karyawan Where devisi = '$devisi'");

    $arraydevisi = mysqli_fetch_array($rowdevisi);

    $pdf->Cell(280, 5, 'Laporan Data Tunjangan Devisi ' . $arraydevisi['devisi'], 0, 0, 'C');


    $pdf->Cell(180, 6, '', 0, 1, 'C');
    function  getBulan($bln)
    {
        switch ($bln) {
            case  1:
                return  "Januari";
                break;
            case  2:
                return  "Februari";
                break;
            case  3:
                return  "Maret";
                break;
            case  4:
                return  "April";
                break;
            case  5:
                return  "Mei";
                break;
            case  6:
                return  "Juni";
                break;
            case  7:
                return  "Juli";
                break;
            case  8:
                return  "Agustus";
                break;
            case  9:
                return  "September";
                break;
            case  10:
                return  "Oktober";
                break;
            case  11:
                return  "November";
                break;
            case  12:
                return  "Desember";
                break;
        }
    }


    $bln = getBulan($bulan);
    $pdf->Cell(280, 5, 'Bulan ' . $bln . ' & Tahun ' . $tahun, 0, 0, 'C');
    $pdf->Cell(180, 10, '', 0, 1, 'C');
    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(189, 5, '', 0, 1); //end of line
    //Cell(width , height , text , border , end line , [align] )

    $pdf->Cell(130, 5, 'DETAIL', 0, 0);
    $pdf->Cell(59, 5, '', 0, 1); //end of line

    //set font jadi arial, regular, 12pt

    $pdf->SetFont('Arial', '', 12);


    $Sqlkeahlian = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as jumlah FROM `t_keahlian` as t inner join dt_karyawan as d on t.nip = d.nip WHERE d.devisi = '$devisi' && MONTH(t.tgl_input) = '$bulan' && YEAR(t.tgl_input) = '$tahun' ");
    if (mysqli_num_rows($Sqlkeahlian) > 0) {
        $jumlahkeahlian = mysqli_fetch_array($Sqlkeahlian);
        $totalkeahlian = $jumlahkeahlian['jumlah'];
    } else {
        $totalkeahlian = 0;
    }

    $Sqltunjangankepalakeluarga = mysqli_query($con, "SELECT * FROM `t_kepalakeluarga` as t inner join dt_karyawan as d on t.nip = d.nip WHERE d.devisi = '$devisi' && MONTH(t.tgl_input) = '$bulan' && YEAR(t.tgl_input) = ' $tahun ' ");


    if (mysqli_num_rows($Sqltunjangankepalakeluarga) > 0) {
        $jumlahtunjangankepalakeluarga = mysqli_fetch_array($Sqltunjangankepalakeluarga);
        $totaltunjangankepalakeluarga = $jumlahtunjangankepalakeluarga['jumlah_tkepalakeluarga'];
    } else {
        $totaltunjangankepalakeluarga = 0;
    }

    $Sqltunjanganmasakerja = mysqli_query($con, "SELECT * FROM `t_masakkerja` as t inner join dt_karyawan as d on t.nip = d.nip WHERE d.devisi = '$devisi' && MONTH(t.tgl_input) = '$bulan' && YEAR(t.tgl_input) = '$tahun' ");

    if (mysqli_num_rows($Sqltunjanganmasakerja) > 0) {
        $jumlahtunjanganmasakerja = mysqli_fetch_array($Sqltunjanganmasakerja);
        $totaltunjanganmasakerja = $jumlahtunjanganmasakerja['jumlah_tmasakerja'];
    } else {
        $totaltunjanganmasakerja = 0;
    }

    $Sqlreward = mysqli_query($con, "SELECT * FROM `reward` as t inner join dt_karyawan as d on t.nip = d.nip WHERE d.devisi = '$devisi' && MONTH(t.tgl_input) = '$bulan' && YEAR(t.tgl_input) = ' $tahun' ");

    if (mysqli_num_rows($Sqlreward) > 0) {
        $jumlahreward = mysqli_fetch_array($Sqlreward);
        $totalreward = $jumlahreward['jumlah_reward'];
    } else {
        $totalreward = 0;
    }

    $Sqllembur = mysqli_query($con, "SELECT * FROM `lembur` as t inner join dt_karyawan as d on t.nip = d.nip WHERE d.devisi = '$devisi' && MONTH(t.tgl_input) = '$bulan' && YEAR(t.tgl_input) = ' $tahun ' ");

    if (mysqli_num_rows($Sqllembur) > 0) {
        $jumlahlembur = mysqli_fetch_array($Sqllembur);
        $totallembur = $jumlahlembur['jumlah_lembur'];
    } else {
        $totallembur = 0;
    }

    $Sqlcicilan = mysqli_query($con, "SELECT * FROM `cicilan` as t inner join dt_karyawan as d on t.nip = d.nip WHERE d.devisi = '$devisi' && MONTH(t.tgl_input) = '$bulan' && YEAR(t.tgl_input) = '$tahun' ");

    if (mysqli_num_rows($Sqlcicilan) > 0) {
        $jumlahcicilan = mysqli_fetch_array($Sqlcicilan);
        $totalcicilan = $jumlahcicilan['jumlah_cicilan'];
    } else {
        $totalcicilan = 0;
    }

    $Sqlinfaq = mysqli_query($con, "SELECT * FROM `infaq` as t inner join dt_karyawan as d on t.nip = d.nip WHERE d.devisi = '$devisi' && MONTH(t.tgl_input) = '$bulan' && YEAR(t.tgl_input) = '$tahun' ");

    if (mysqli_num_rows($Sqlinfaq) > 0) {
        $jumlahinfaq = mysqli_fetch_array($Sqlinfaq);
        $totalinfaq = $jumlahinfaq['jumlah_infaq'];
    } else {
        $totalinfaq = 0;
    }

    $totaltunjangan = $totalkeahlian + $totaltunjangankepalakeluarga + $totaltunjanganmasakerja + $totallembur + $totalreward;

    $totallain =  $totalinfaq + $totalcicilan;

    $totalkeseluruhan = $totaltunjangan - $totallain;


    $pdf->Cell(200, 5, 'Total Keseluruhan  : Rp. ' . number_format($totalkeseluruhan, 2, ",", "."), 0, 0);
    $pdf->Cell(25, 5, 'Tgl Cetak     : ', 0, 0);
    $pdf->Cell(50, 5, ' ' . $date, 0, 1); //end of line


    $pdf->Cell(130, 5, 'Priode Bulan & Tahun   : ' . $bln . ' ' . $tahun, 0, 1);
    //end of line


    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(25, 5, '', 0, 0);




    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(25, 5, '', 0, 0);
    $pdf->Cell(34, 5, '', 0, 0); //end of line



    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(250, 10, '', 0, 1); //end of line

    //alamat billing 
    $pdf->Cell(100, 0, 'Detail Karyawan', 0, 1); //end of line



    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(10, 3, '', 0, 1); //end of line

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, 5, 'No', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Nama', 1, 0, 'C');
    $pdf->Cell(30, 5, 'T Keahlian', 1, 0, 'C');
    $pdf->Cell(30, 5, 'T Masa Kerja', 1, 0, 'C');
    $pdf->Cell(45, 5, 'T Kepala Keluarga', 1, 0, 'C');
    $pdf->Cell(35, 5, 'Reward', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Lembur', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Infaq', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Cicilan', 1, 1, 'C');


    $sqltakehome = mysqli_query($con, "SELECT * FROM dt_karyawan where devisi = '$devisi'");

    $no = 0;
    if ($cek = mysqli_num_rows($sqltakehome) > 0) {
        while ($rowtakehome = mysqli_fetch_array($sqltakehome)) {

            $nip = $rowtakehome['nip'];

            $no++;
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(20, 5, $no, 1, 0, 'C');
            $pdf->Cell(30, 5, $rowtakehome['nama_karyawan'], 1, 0, 'L');

            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_keahlian as tk ON k.nip = tk.nip where k.nip = '$nip'");
            if (mysqli_num_rows($Sqlcek) > 1) {
                $Sqltotal = mysqli_query($con, "SELECT SUM(jumlah_tunjangan_keahlian) as total FROM t_keahlian WHERE nip = '$nip' && MONTH(tgl_input) = '" . $bulan . "' && year(tgl_input) = '" . $tahun . "'");
                $total = mysqli_fetch_array($Sqltotal);
                $pdf->Cell(30, 5,  number_format($total['total'], 0, ",", "."), 1, 0, 'R');
            } else  if (mysqli_num_rows($Sqlcek) > 0) {
                $total = mysqli_fetch_array($Sqlcek);
                $pdf->Cell(30, 5, number_format($total['jumlah_tunjangan_keahlian'], 0, ",", "."), 1, 0, 'R');
            } else {
                $pdf->Cell(30, 5, '0', 1, 0, 'R');
            }

            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_masakkerja as tk ON k.nip = tk.nip where k.nip = '$nip' && MONTH(tgl_input) = '" . $bulan . "' && year(tgl_input) = '" . $tahun . "'");
            if (mysqli_num_rows($Sqlcek) > 0) {
                $total = mysqli_fetch_array($Sqlcek);
                $pdf->Cell(30, 5,  number_format($total['jumlah_tmasakerja'], 0, ",", "."), 1, 0, 'R');
            } else {
                $pdf->Cell(30, 5,  '0', 1, 0, 'R');;
            }

            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_kepalakeluarga as tk ON k.nip = tk.nip where k.nip = '$nip' && MONTH(tgl_input) = '" . $bulan . "' && year(tgl_input) = '" . $tahun . "'");
            if (mysqli_num_rows($Sqlcek) > 0) {
                $total = mysqli_fetch_array($Sqlcek);
                $pdf->Cell(45, 5,  number_format($total['jumlah_tkepalakeluarga'], 0, ",", "."), 1, 0, 'R');
            } else {
                $pdf->Cell(45, 5,  '0', 1, 0, 'R');;
            }

            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN reward as tk ON k.nip = tk.nip where k.nip = '$nip' && MONTH(tgl_input) = '" . $bulan . "' && year(tgl_input) = '" . $tahun . "'");
            if (mysqli_num_rows($Sqlcek) > 0) {
                $total = mysqli_fetch_array($Sqlcek);

                $pdf->Cell(35, 5, number_format($total['jumlah_reward'], 0, ",", "."), 1, 0, 'R');
            } else {
                $pdf->Cell(35, 5, '0', 1, 0, 'R');
            }

            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN lembur as tk ON k.nip = tk.nip where k.nip = '$nip' && MONTH(tgl_input) = '" . $bulan . "' && year(tgl_input) = '" . $tahun . "'");
            if (mysqli_num_rows($Sqlcek) > 0) {
                $total = mysqli_fetch_array($Sqlcek);
                $pdf->Cell(30, 5, number_format($total['jumlah_lembur'], 0, ",", "."), 1, 0, 'R');
            } else {
                $pdf->Cell(30, 5, '0', 1, 0, 'R');
            }

            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN infaq as tk ON k.nip = tk.nip where k.nip = '$nip' && MONTH(tgl_input) = '" . $bulan . "' && year(tgl_input) = '" . $tahun . "'");
            if (mysqli_num_rows($Sqlcek) > 0) {
                $total = mysqli_fetch_array($Sqlcek);
                $pdf->Cell(30, 5,  number_format($total['jumlah_infaq'], 0, ",", "."), 1, 0, 'R');
            } else {
                $pdf->Cell(30, 5,  '0', 1, 0, 'R');
            }

            $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN cicilan as tk ON k.nip = tk.nip where k.nip = '$nip' && MONTH(tgl_input) = '" . $bulan . "' && year(tgl_input) = '" . $tahun . "'");
            if (mysqli_num_rows($Sqlcek) > 0) {
                $total = mysqli_fetch_array($Sqlcek);

                $pdf->Cell(30, 5, number_format($total['jumlah_cicilan'], 2, ",", "."), 1, 1, 'R');
            } else {
                $pdf->Cell(30, 5, '0', 1, 1, 'R');
            }
        }
    }

    //end of line




    $pdf->Cell(500, 10, '', 0, 1); //end of line
    $pdf->SetFont('Arial', 'B', 14);

    //buat dummy cell untuk memberi jarak vertikal

    $pdf->Output();
} else if (isset($_POST['excel'])) {
}
