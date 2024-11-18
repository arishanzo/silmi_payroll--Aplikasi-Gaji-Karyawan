<?php
require_once "../../config/config.php";


if (isset($_SESSION['username'])) {

    include_once('header.php');
    // 
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Karyawan</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="card-header-action">
                    <button class="btn btn-primary btn-action btn-xs mr-1" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" title="Tambah Data"><span>Tambah Data Karyawan</span></button>
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
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Jabatan</th>
                                <th>Tanggal Masuk</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $SqlQuery = mysqli_query($con, "select * from dt_karyawan");
                            $no = 1;
                            if (mysqli_num_rows($SqlQuery) > 0) {
                                while ($row = mysqli_fetch_array($SqlQuery)) {
                            ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nip'] ?></td>
                                        <td><?= $row['nama_karyawan'] ?></td>
                                        <td class="text-center"><?= $row['jenis_kelamin'] ?></td>
                                        <td><?= date("d-M-Y",  strtotime($row["ttl"])); ?></td>
                                        <td><?= $row['devisi'] ?></td>
                                        <td><?= date("d-M-Y",  strtotime($row["tgl_masuk"])); ?></td>
                                        <td><?= $row['alamat'] ?></td>
                                        <td>
                                            <center>
                                                <a href="edit.php?id=<?= $row['nip'] ?>" class="btn btn-primary btn-xs btn-action mr-1" title="Edit"><i class="fas fa-edit"></i></a>
                                                <br> <br>
                                                <a href="delete.php?id=<?= $row['nip'] ?>" class="btn btn-danger btn-xs delete-data mr-1" title="hapus"><i class="fas fa-trash-alt"></i></a>
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

                        <!-- MODAL -->

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">


                                            <div class="form-group">
                                                <div class="section-title mt-0">Nip</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="nip" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Nama Karyawan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="nama_karyawan" required>
                                                </div>
                                            </div>
                                            <div class="widget-body mt-3">
                                                <div class="form-group">
                                                    <select class="custom-select" name="jenis_kelamin">
                                                        <option disabled selected>Pilih Jenis Kelamin</option>

                                                        <option value="L">Laki - Laki</option>

                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="section-title mt-0">Tanggal Lahir</div>
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control" name="ttl" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Jabatan</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="jabatan" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Tangal Masuk</div>
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control" name="tgl_masuk" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="section-title mt-0">Alamat</div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="alamat" required>
                                                </div>
                                            </div>



                                            <div class="modal-footer">
                                                <button class="btn btn-primary mr-1" type="submit" name="submit">Simpan</button>

                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- MODAL -->

                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Devisi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">


                                    <div class="form-group">
                                        <div class="section-title mt-0">Nama Karyawan</div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="nama_karyawan" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-primary mr-1" type="submit" name="submit">Simpan</button>

                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <?php
            if (isset($_POST['submit'])) {
                $nip = $_POST['nip'];
                $jk = $_POST['jenis_kelamin'];
                $nama = $_POST['nama_karyawan'];
                $ttl = $_POST['ttl'];
                $jabatan = $_POST['jabatan'];
                $tglmasuk = $_POST['tgl_masuk'];
                $alamat = $_POST['alamat'];

                $save = mysqli_query($con, "INSERT INTO dt_karyawan VALUES ('$nip', '$nama', '$jk', '$ttl', '$jabatan', '$tglmasuk',  '$alamat' )") or die(mysqli_error($con));

                echo "<script type='text/javascript'>
                    setTimeout(function () { 
                        swal({ 
                            title: 'Suksess', 
                            text: 'Data Berhasil Disimpan $nama', 
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