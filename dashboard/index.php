<?php
require_once "../config/config.php";


if (isset($_SESSION['username'])) {
    include_once('header.php');
    // 
?>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <h1 class="h3 mb-0 text-gray-800">Selamat Datang Di Aplikasi Pay Roll Silmi Fashion</h1> -->
        </div>
        <br>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    jumlah Karyawan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $querykaryawan = mysqli_query($con, "SELECT * FROM dt_karyawan");

                                    $jmlhkaryawan = mysqli_num_rows($querykaryawan);

                                    echo $jmlhkaryawan;
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Jumlah Tunjangan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Jam Kerja Karyawan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">7 Jam</div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Online</div>
                                <div class="h5 mb-0 font-weight-bold text-success-800">1</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Trafik Penggajian Pegawai Bulan Ini</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                        <script>
                            $.getJSON("<?= base_url() ?>/dashboard/datajson.php", function(data) {

                                var isi_labels = [];
                                var isi_data = [];
                                var isi_tgl = [];
                                $(data).each(function(i) {
                                    isi_labels.push(data[i].devisi);
                                    isi_data.push(data[i].totalgaji);
                                    isi_tgl.push(data[i].tgl_pembayaran);
                                });


                                //deklarasi chartjs untuk membuat grafik 2d di id mychart   
                                var ctx = document.getElementById('myChart').getContext('2d');

                                var myChart = new Chart(ctx, {
                                    //chart akan ditampilkan sebagai bar chart
                                    type: 'bar',
                                    data: {
                                        //membuat label chart
                                        labels: isi_labels,
                                        datasets: [{
                                            label: 'Data Jumlah Gaji Per Devisi ',
                                            //isi chart
                                            data: isi_data,
                                            //membuat warna pada bar chart
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });

                            });
                        </script>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Data Karyawan <br>

                            <?php

                            if (isset($_GET['devisi'])) {
                                $devisi = $_GET['devisi'];
                                echo "Devisi " . $devisi;
                            } else {
                            }
                            ?>
                        </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button name="pilih2" id="pilih2" class="form-control btn btn-primary rounded px-3">Pilih Devisi</button>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" id="pilihdevisi" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Devisi</div>
                                <a class="dropdown-item" href="index.php">Tampilkan Semua</a>
                                <?php
                                $querydevisi = mysqli_query($con, "SELECT DISTINCT devisi FROM dt_karyawan");
                                while ($row = mysqli_fetch_array($querydevisi)) {
                                ?>
                                    <form action="#" method="get">

                                        <button class="dropdown-item" type="submit" id="pilihdevisi" name="devisi" value="<?= $row['devisi'] ?>" href="#"><?= $row['devisi'] ?></a>
                                    </form>
                                <?php

                                }

                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="hasil">
                        <?php
                        if (isset($_GET['devisi'])) {
                            $devisi = $_GET['devisi'];
                            global $devisi;
                            function Chart_Tampil_JK()
                            {
                                global $devisi;
                                global $con;
                                $sql = "SELECT SUM(IF(jenis_kelamin='L',1,0)) AS jumlah_pria, SUM(IF(jenis_kelamin='P',1,0)) AS jumlah_perempuan FROM dt_karyawan where devisi='$devisi'";
                                $perintah = mysqli_query($con, $sql);
                                return $perintah;
                            }
                        } else {
                            function Chart_Tampil_JK()


                            {
                                global $con;
                                $sql = "SELECT SUM(IF(jenis_kelamin='L',1,0)) AS jumlah_pria, SUM(IF(jenis_kelamin='P',1,0)) AS jumlah_perempuan FROM dt_karyawan";
                                $perintah = mysqli_query($con, $sql);
                                return $perintah;
                            }
                        }

                        $tampil = Chart_Tampil_JK();
                        $tampilkan = mysqli_fetch_array($tampil);
                        ?>

                        <canvas id="myPieChart"></canvas>



                        <script type="text/javascript">
                            // Set new default font family and font color to mimic Bootstrap's default styling
                            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                            Chart.defaults.global.defaultFontColor = '#292b2c';

                            // Pie Chart Example
                            var ctx = document.getElementById("myPieChart");
                            var myPieChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ["Laki laki", "Perempuan"],
                                    datasets: [{
                                        label: '',
                                        data: [<?php echo $tampilkan['jumlah_pria']; ?>, <?php echo $tampilkan['jumlah_perempuan']; ?>],
                                        backgroundColor: ['#007bff', '#dc3545'],
                                    }],
                                },
                            });
                        </script>

                        <span class="text-bold"> <i class="fas fa-male"></i>
                            <?php
                            if ($mysqli = mysqli_num_rows($tampil) > 0) {
                            ?>
                                Laki - Laki : <?= $tampilkan['jumlah_pria']; ?></span>

                    <?php
                            } else {
                    ?>
                        <i class="fas fa-female"></i> Laki - Laki : 0 </span>


                    <?php

                            }

                    ?>
                    <br>
                    <span> <?php
                            if ($mysqli = mysqli_num_rows($tampil) > 0) {
                            ?>
                            <i class="fas fa-female"></i> Perempuan : <?= $tampilkan['jumlah_perempuan']; ?></span>

                <?php
                            } else {
                ?>
                    <i class="fas fa-female"></i> Perempuan : 0 </span>


                <?php

                            }

                ?></span>
                <br><br>
                <span class="text-bold"> Total : <?= $total = $tampilkan['jumlah_perempuan'] + $tampilkan['jumlah_pria']; ?></span>


                    </div>

                </div>
            </div>

        </div>


    <?php

    include_once('footer.php');
} else {
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
}

// 
    ?>
    </section>