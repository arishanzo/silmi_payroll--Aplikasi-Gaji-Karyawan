<?php
require_once "../../config/config.php";



include_once('header.php');
// 

$nip = $_GET['nip'];
?>


<div class="card">
    <!-- <img src="images/img-1.jpg" class="img-fluid"> -->
    <div class="card-body">
        <div class="row ">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Updhate Data Tunjangan Keahlian</h4>
                        <div class="card-header-action text-right">
                            <a href="index.php" class="btn btn-primary btn-action btn-xs mr-1" title="kembali"><span>Kembali</span></a>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card-body">
                                    <?php

                                    $sql_ttp = mysqli_query($con, "SELECT * FROM tunjangan_tidak_tetap where nip = '$nip'") or die(mysqli_error($con));
                                    $data = mysqli_fetch_array($sql_ttp)
                                    ?>
                                    <form action="" enctype="multipart/form-data" method="post">
                                        <div class="form-group">
                                            <div class="section-title mt-0">Gaji Pokok</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" value="<?= $data['gaji_pokok'] ?>" name="gaji_pokok" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="section-title mt-0">Tunjangan Jabatan</div>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" value="<?= $data['t_jabatan'] ?>" name="t_jabatan" required>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit" name="submit">Edit</button>
                        </div>
                        </from>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

</section>
<?php
if (isset($_POST['submit'])) {
    $tjabatan = $_POST['t_jabatan'];
    $gaji = $_POST['gaji_pokok'];


    $hitung = $gaji + $tjabatan;

    $perjam =  round($hitung / 182, 2);

    $update1 = mysqli_query($con, "UPDATE tunjangan_tidak_tetap set gaji_pokok = '$gaji', t_jabatan = '$tjabatan' , total_perjam='$perjam' WHERE nip = '$nip'") or die(mysqli_error($con));

    echo "<script type='text/javascript'>
                        setTimeout(function () { 
                            swal({ 
                                title: 'success', 
                                text: 'Berhasil Di Update', 
                                type: 'success',
                                icon: 'success',
                                 timer: 3000,
                                  buttons: false });
                        },10);  
                        window.setTimeout(function(){ 
                          window.location.replace('index.php');
                        } ,3000); 
                        </script>";
}

?>

<?php

include_once('footer.php');


// 
?>