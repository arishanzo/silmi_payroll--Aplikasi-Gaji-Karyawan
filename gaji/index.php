<?php
require_once "../config/config.php";



if (isset($_SESSION['username'])) {
    include_once('header.php');
    // 
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary py-3">
                <h4 class="text-white">Data Take Home </h4>
                <div class="card-header-action">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nip</th>
                                <th>Nama Karyawan</th>
                                <th>Devisi</th>
                                <th>Take Home</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $SqlQuery = mysqli_query($con, "SELECT * FROM dt_karyawan");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                                    $id = $row['nip'];
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nip'] ?></td>
                                        <td><?= $row['nama_karyawan'] ?></td>
                                        <td><?= $row['devisi'] ?></td>
                                        <td>
                                            <?php
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

                                                $ttp = round($rowjumlah['SUM(total_jam)'], 0) * $rowtunjangantidaktetap['total_perjam'];

                                                $tunjangan = $ttp + $totaltunjangantetap + $totalkeseluruhan;
                                                $ttl = $tunjangan - $totalkeseluruhan2;
                                                echo 'Rp.' . number_format($ttl, 2, ",", ".");
                                            } else {
                                                $tunjangan = 0 + $totaltunjangantetap + $totalkeseluruhan;
                                                $ttl = $tunjangan - $totalkeseluruhan2;
                                                echo 'Rp.' . number_format($ttl, 2, ",", ".");
                                            }

                                            ?>


                                        </td>
                                        <?php
                                        $Sqlgaji = mysqli_query($con, "SELECT * From gaji where nip = '$id'");
                                        $rowgaji = mysqli_fetch_array($Sqlgaji);

                                        if (mysqli_num_rows($Sqlgaji) > 0) {
                                            $gaji = $rowgaji['status_pembayaran'];
                                            if ($gaji == "Sudah Di Bayar") {
                                        ?>
                                                <td class="text-center">
                                                    Sudah Di Bayar</td>
                                                <td>
                                                <?php
                                            } else {
                                                ?>
                                                <td class="text-danger text-center">
                                                    Belum Di Bayar</td>
                                                <td>

                                                <?php
                                            }
                                        } else {
                                                ?>
                                                <td class="text-danger text-center">
                                                    Belum Di Bayar</td>
                                                <td>

                                                <?php

                                            }

                                                ?>
                                                <center>
                                                    <a href="pembayaran.php?id=<?= $row['nip'] ?>" class="btn btn-success btn-xs btn-action mr-1" title="Bayar"><i class="fas fa-wallet"></i> &nbsp; Bayar</a>
                                                    <a href="cetak.php?id=<?= $row['nip'] ?>" class="btn btn-primary btn-xs mr-1" title="Cetak"><i class="fa fa-file-pdf-o"></i> &nbsp; PRINT</a>
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