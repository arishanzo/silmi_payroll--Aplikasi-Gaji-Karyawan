<?php

require_once "../../config/config.php";
$tahun = @$_POST['tahun'];
require('../../vendor/fpdf184/fpdf.php');


if (isset($_POST['cekdata'])) {

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

    $pdf->Cell(200, 5, 'Laporan Data TTP Devisi ' . $arraydevisi['devisi'], 0, 0, 'C');


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

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 5, 'No', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Nama', 1, 0, 'C');
    $pdf->Cell(30, 5, 'Gaji Pokok', 1, 0, 'C');
    $pdf->Cell(40, 5, 'Tunjangan Jabatan', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Perjam', 1, 0, 'C');
    $pdf->Cell(50, 5, 'Total Tunjangan Tidak Tetap', 1, 1, 'C');


    $SqlQuery = mysqli_query($con, "SELECT * FROM `tunjangan_tidak_tetap` as t INNER JOIN dt_karyawan as d on t.nip = d.nip");
    $no = 0;
    if (mysqli_num_rows($SqlQuery) > 0) {
        while ($row = mysqli_fetch_array($SqlQuery)) {

            $nip = $row['nip'];

            $no++;
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(20, 5, $no, 1, 0, 'C');
            $pdf->Cell(30, 5, $row['nama_karyawan'], 1, 0, 'L');
            $pdf->Cell(30, 5,  number_format($row['gaji_pokok'], 0, ",", "."), 1, 0, 'R');
            $pdf->Cell(40, 5,  number_format($row['t_jabatan'], 0, ",", "."), 1, 0, 'R');
            $pdf->Cell(25, 5,  number_format($row['total_perjam'], 0, ",", "."), 1, 0, 'R');

            $qdatagrid = "SELECT SUM(total_jam) FROM dt_karyawan as d inner join jam_kerja as j on d.nip = j.nip WHERE d.nip = '$row[nip]'";
            $rdatagrid = mysqli_query($con, $qdatagrid);
            $rowjumlah = mysqli_fetch_array($rdatagrid);

            if ($cek = mysqli_num_rows($rdatagrid) > 0) {

                $ttp = round($rowjumlah['SUM(total_jam)'], 2) * $row['total_perjam'];

                $pdf->Cell(50, 5,  number_format($ttp, 0, ",", "."), 1, 0, 'R');
            } else {
                $ttp = round($rowjumlah['SUM(total_jam)'], 2);
                $pdf->Cell(50, 5,  number_format($ttp, 0, ",", "."), 1, 0, 'R');
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
