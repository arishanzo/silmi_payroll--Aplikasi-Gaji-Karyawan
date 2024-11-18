<?php

echo (round(7.9666666666667, 2) . "<br>");

$tglinput = "07-01-2023";

function hari_ini($tglinput)
{

    $hari = date("D", strtotime($tglinput));

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

    return "<b>" . $hari_ini . "</b>";
}

echo hari_ini($tglinput);

$day = hari_ini($tglinput);

if ($day == 'Sun') {
    $waktuawal = '11:30:00';
    $waktuakhir = '08.06.16';
    $awal  = date_create($waktuawal);
    $akhir = date_create($waktuakhir); // waktu sekarang, pukul 06:13
    $diff  = date_diff($akhir, $awal);
    $jam1 = $diff->h; // Hasil: 5

    $menit1 = $diff->i; // Hasil: 5

    $detk1 = $diff->s; // Hasil: 5

    $waktuawal2 = '12:30:00';
    $waktuakhir2 = '15:41:34';
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
    echo $totaljam = $jam1[0];

    echo $ttl = $jam1[1];
    // $jam1[2];

    // $totall = $ttl / 60;
    // $total = $totaljam + $totall;

    // // $date = date('Y-m-d');
    // $save = mysqli_query($con, "INSERT INTO jam_kerja VALUES ('',  '005', '$tanggal', '$scan1', '$scan2', '$scan3', '$scan4', '$totaljam','$ttl','$total', '$date')") or die(mysqli_error($con));
} else {
    $waktuawal = '11:30:00';
    $waktuakhir = '08.06.16';
    $awal  = date_create($waktuawal);
    $akhir = date_create($waktuakhir); // waktu sekarang, pukul 06:13
    $diff  = date_diff($akhir, $awal);
    $jam1 = $diff->h; // Hasil: 5

    $menit1 = $diff->i; // Hasil: 5

    $detk1 = $diff->s; // Hasil: 5

    $waktuawal2 = '12:30:00';
    $waktuakhir2 = '15:41:34';
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

    // $totall = $ttl / 60;
    // $total = $totaljam + $totall;

    // $date = date('Y-m-d');
    // $save = mysqli_query($con, "INSERT INTO jam_kerja VALUES ('',  '005', '$tanggal', '$scan1', '$scan2', '$scan3', '$scan4', '$totaljam','$ttl','$total', '$date')") or die(mysqli_error($con));
}
// if ($totalmenit > 60 && $totaldetik > 60) {
//     $totaljam = $datajam1 + $datajam2 + 1 * 2;

//     $hitungmenit = $totalmenit - 60;
//     $ttldetik = $totaldetik - 60 * 2;

//     $ttl = $hitungmenit + 1 * 2;



//     echo $totaljam . ":" . $ttl . ":" . $ttldetik;
// } else if ($totalmenit > 60) {

//     $totaljam = $datajam1 + $datajam2 + 1 * 2;

//     $hitungmenit = $totalmenit - 60;
//     // $ttldetik = $totaldetik - 60;

//     // $ttl = $hitungmenit + 1;

//     echo $totaljam . ":" . $hitungmenit . ":" . $totaldetik;
// } else if ($totaldetik > 60) {
//     $totaljam = $datajam1 + $datajam2 * 2;
//     $ttldetik = $totaldetik - 60;

//     $ttl = $totalmenit + 1;

//     echo $totaljam . ":" . $ttl . ":" . $ttldetik;
// } else if ($totalmenit == 60) {

//     $totaljam = $datajam1 + $datajam2 + 1 * 2;

//     $hitungmenit = '0';

//     echo $totaljam . ":" . $hitungmenit . ":" . $totaldetik;
// } else if ($totaldetik == 60) {

//     $totaljam = $datajam1 + $datajam2 * 2;

//     $hitungmenit = $totalmenit + 1 * 2;
//     if ($hitungmenit == 60) {
//         $totaljam2 = $datajam1 + $datajam2 + 1 * 2;
//         $hasilmenit = '0';
//         $hasildetik = '0';

//         echo $totaljam2 . ":" . $hasilmenit . ":" . $hasildetik;
//     }
//     $hasildetik = '00';
//     echo $totaljam . ":" . $hitungmenit . ":" . $hasildetik;
// } else {
//     $totaljam = $datajam1 + $datajam2;
//     echo $totaljam . ":" . $totalmenit . ":" . $totaldetik;
// }
