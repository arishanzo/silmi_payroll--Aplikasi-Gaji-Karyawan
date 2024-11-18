<?php
require_once "../../config/config.php";
if (isset($_GET['devisi'])) {

    $devisi = $_GET["devisi"];
    $qdatagrid = "SELECT * FROM t_keahlian as t INNER JOIN dt_karyawan as d on t.nip = d.nip WHERE d.devisi = '$devisi'";
    $rdatagrid = mysqli_query($con, $qdatagrid);
    $i = 0;
    if (mysqli_num_rows($rdatagrid) > 0) {
        while ($row = mysqli_fetch_array($rdatagrid)) {
            $cek = mysqli_num_rows($rdatagrid);
            $nip = $row['nip'];
            $i++;
?>

            <tr>
                <td><?= $i++ ?></td>
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
                    $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_kepalakeluarga as tk ON k.nip = tk.nip where k.nip = '$nip'");
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
                    $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN t_masakkerja as tk ON k.nip = tk.nip where k.nip = '$nip'");
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
                    $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN reward as tk ON k.nip = tk.nip where k.nip = '$nip'");
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
                    $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN lembur as tk ON k.nip = tk.nip where k.nip = '$nip'");
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
                    $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN infaq as tk ON k.nip = tk.nip where k.nip = '$nip'");
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
                    $Sqlcek = mysqli_query($con, "SELECT * FROM dt_karyawan as k INNER JOIN cicilan as tk ON k.nip = tk.nip where k.nip = '$nip'");
                    if (mysqli_num_rows($Sqlcek) > 0) {
                        $total = mysqli_fetch_array($Sqlcek);
                        echo 'Rp.' . number_format($total['jumlah_cicilan'], 2, ",", ".");
                    } else {
                        echo 'Rp.' . number_format('0', 2, ",", ".");
                    }



                    ?>

                </td>
                <td>
                    <center>
                        <a href="edit.php?id=<?= $row['nip'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Lihat Detail">Detail</a>
                </td>
                </center>
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan=\"7\" align=\"center\">data tidak ada</td></tr>";
    }
} else if (isset($_GET['detail'])) {

    $nip = $_GET["detail"];

    ?>
    <table class="table table-bordered" id="dataTable" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan Jabatan</th>
                <th>Total Perjam</th>
                <th>Total Tunjangan Tidak Tetap</th>
                <th>Detail</th>
                <th>Action</th>

            </tr>
        </thead>

        <tbody>
            <?php
            $SqlQuery = mysqli_query($con, "SELECT * FROM `tunjangan_tidak_tetap` as t INNER JOIN dt_karyawan as d on t.nip = d.nip");
            $no = 1;
            if (mysqli_num_rows($SqlQuery) > 0) {
                while ($row = mysqli_fetch_array($SqlQuery)) {
            ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $nip ?></td>
                        <td><?= $row['nama_karyawan'] ?></td>
                        <td><?= $row['devisi'] ?></td>
                        <td>
                            Rp.<?= number_format($row['gaji_pokok'], 2, ",", ".") ?>.,-</td>
                        <td>
                            Rp.<?= number_format($row['t_jabatan'], 2, ",", ".") ?>.,-
                        </td>
                        <td><?= $row['total_perjam'] ?></td>
                        <td>Rp.<?= number_format($row['total_ttp'], 2, ",", ".") ?>.,-</td>
                        <td>
                            <center>
                                <a href="edit.php?nip=<?= $row['nip'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Lihat Detail">Edit</a>

                                <a href="delete.php?id=<?= $row['nip'] ?>" class="btn btn-danger btn-xs delete-data mr-1 mt-3" title="hapus">HAPUS</a>
                        </td>
                        <td>
                            <!-- <button class="btn btn-primary btn-action btn-xs mr-1" id="detail" data-toggle="modal" value="<?= $nip  ?>" data-target="#exampleModal10" data-toggle="tooltip" title="Detail"><span>Detail</span></button>
                        </td> -->
                            </center>
                    </tr>


            <?php
                }
            } else {
                echo "<tr><td colspan=\"8\" align=\"center\">data tidak ada</td></tr>";
            }
            ?>
        </tbody>
    </table>

<?php

}
?>