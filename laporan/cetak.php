<?php

require_once "../config/config.php";
$tahun = @$_POST['tahun'];
require('../vendor/fpdf184/fpdf.php');


if (isset($_POST['pdf'])) {

    $devisi = $_POST['devisi'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];

    $pdf = new FPDF('P', 'mm', 'A4');

    $pdf->AddPage();

    $date = date('d-m-Y');

    //set font jadi arial, bold, 14pt
    $pdf->SetFont('Arial', 'B', 14);

    $rowdevisi = mysqli_query($con, "SELECT * FROM dt_karyawan Where devisi = '$devisi'");

    $arraydevisi = mysqli_fetch_array($rowdevisi);

    $pdf->Cell(200, 5, 'Laporan Rekap Gaji Devisi ' . $arraydevisi['devisi'], 0, 0, 'C');


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
    $pdf->Cell(200, 5, 'Bulan ' . $bln . ' & Tahun ' . $tahun, 0, 0, 'C');
    $pdf->Cell(180, 10, '', 0, 1, 'C');
    //buat dummy cell untuk memberi jarak vertikal
    $pdf->Cell(189, 5, '', 0, 1); //end of line
    //Cell(width , height , text , border , end line , [align] )

    $pdf->Cell(130, 5, 'DETAIL', 0, 0);
    $pdf->Cell(59, 5, '', 0, 1); //end of line

    //set font jadi arial, regular, 12pt

    $pdf->SetFont('Arial', '', 12);

    $totalkeseluruhangaji = mysqli_query($con, "SELECT SUM(take_home) FROM dt_karyawan as d inner join gaji as g on d.nip = g.nip where d.devisi='$devisi' && month(tgl_pembayaran)='$bulan' && year(tgl_pembayaran)= '$tahun'");

    $arrayseluruhgaji = mysqli_fetch_array($totalkeseluruhangaji);

    $pdf->Cell(130, 5, 'Total Keseluruhan Gaji  : Rp. ' . number_format($arrayseluruhgaji['SUM(take_home)'], 2, ",", "."), 0, 0);
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


    $sqltakehome = mysqli_query($con, "SELECT * FROM dt_karyawan as d inner join gaji as g on d.nip = g.nip where d.devisi = '$devisi' &&  month(tgl_pembayaran)='$bulan' && year(tgl_pembayaran)='$tahun'");

    $no = 0;
    if ($cek = mysqli_num_rows($sqltakehome) > 0) {
        while ($rowtakehome = mysqli_fetch_array($sqltakehome)) {

            $no++;
            $pdf->Cell(10, 5, 'No', 1, 0,);
            $pdf->Cell(55, 5, 'Nama Karyawan', 1, 0, 'C');
            $pdf->Cell(50, 5, 'Devisi', 1, 0, 'C');
            $pdf->Cell(68, 5, 'Take Home / Gaji', 1, 1, 'C');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(10, 5, $no, 1, 0, 'C');
            $pdf->Cell(55, 5, $rowtakehome['nama_karyawan'], 1, 0);
            $pdf->Cell(50, 5, $rowtakehome['devisi'], 1, 0);
            $pdf->Cell(68, 5, 'Rp.' . number_format($rowtakehome['take_home'], 2, ",", "."), 1, 1, 'R');
        }
    }

    //end of line




    $pdf->Cell(500, 10, '', 0, 1); //end of line
    $pdf->SetFont('Arial', 'B', 14);

    $pdf->Cell(200, 25, '.................................. MATUR SUON :) .......................................', 0, 0, 'C');

    //buat dummy cell untuk memberi jarak vertikal

    $pdf->Output();
} else if (isset($_POST['excel'])) {
}
