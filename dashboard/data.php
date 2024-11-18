<?php
require_once "../config/config.php";
if (isset($_GET['devisi'])) {

    $devisi = $_GET['devisi'];

    function Chart_Tampil_JK()


    {
        global $devisi;
        global $con;
        $sql = "SELECT SUM(IF(jenis_kelamin='L',1,0)) AS jumlah_pria, SUM(IF(jenis_kelamin='P',1,0)) AS jumlah_perempuan FROM dt_karyawan where devisi='$devisi'";
        $perintah = mysqli_query($con, $sql);
        return $perintah;
    }

    $tampil = Chart_Tampil_JK();
    $tampilkan = mysqli_fetch_array($tampil);
}


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