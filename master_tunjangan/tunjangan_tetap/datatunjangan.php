<?php
require_once "../../config/config.php";
if (isset($_GET['tunjangan'])) {

    $tunjangan = $_GET["tunjangan"];

    if ($tunjangan == 't_keahlian') {
?>
        <hr>
        <div class="section-title mt-0">Nama Karyawan</div>
        <div class="input-group mb-2">

            <select class="form-control " data-live-search="true" name="karyawan" required>
                <option disabled selected> Pilih Karyawan</option>
                <?php

                $sqlsiswa = mysqli_query($con, "select * from dt_karyawan ");
                while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                ?>
                    <option value="<?= $row2['nip'] ?>"><?= $row2['nama_karyawan'] ?></option>

                <?php


                }

                ?>
            </select>
        </div>
        <hr>
        <div class="control-group after-add-more" id="dynamic_field">
            <label>Tunjangan Keahlian</label>
            <input type="text" name="tunjungankeahlian[]" class="form-control" required>
            <label>Jumlah Tunjangan</label>
            <input type="text" name="jmlh_tunjangan[]" class="form-control" required>
            <hr>
            <td><button type="button" name="add" id="add" class="btn btn-success">Tambah Tunjangan Lain</button></td>
            <br>
            <br>
            <script>
                $(document).ready(function() {
                    var i = 1;
                    $('#add').click(function() {
                        i++;
                        $('#dynamic_field').append('<tr id="row' + i + '"><td><label>Tunjangan Keahlian</label><br><input style="width:460px" type="text" name="tunjungankeahlian[]" class="form-control nilai_list"/><label>Jumlah Tunjangan</label><br><input style="width:460px" type="number" name="jmlh_tunjangan[]" class="form-control nilai_list"/> <br> <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Hapus</button></td></tr>');
                    });
                    $(document).on('click', '.btn_remove', function() {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
                    });
                    $('#submit').click(function() {
                        $.ajax({
                            url: "index.php",
                            method: "POST",
                            data: $('#add_name').serialize(),
                            success: function(data) {
                                alert(data);
                                $('#add_name')[0].reset();
                            }
                        });
                    });
                });
            </script>
        </div>


        <div class="modal-footer mt-3">
            <button class="btn btn-primary mr-1" type="submit" name="submit1">Simpan</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    <?php

    } else if ($tunjangan == 't_kepalakeluarga') {
    ?>

        <hr>
        <div class="section-title mt-0">Nama Karyawan</div>
        <div class="input-group mb-2">
            <select class="form-control " name="karyawan1" required>
                <option disabled selected> Pilih Karyawan</option>
                <?php

                $sqlsiswa = mysqli_query($con, "select * from dt_karyawan ");
                while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                ?>
                    <option value="<?= $row2['nip'] ?>"><?= $row2['nama_karyawan'] ?></option>

                <?php


                }

                ?>
            </select>
        </div>

        <div class="form-group">
            <div class="section-title mt-0">Jumlah</div>
            <div class="input-group mb-2">
                <input type="number" class="form-control" name="jmlh_tunjangan" required>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary mr-1" type="submit" name="submit2">Simpan</button>

            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
    <?php

    } else if ($tunjangan == 't_masakerja') {
    ?>
        <hr>
        <div class="section-title mt-0">Nama Karyawan</div>
        <div class="input-group mb-2">
            <select class="form-control " name="karyawan1" required>
                <option disabled selected> Pilih Karyawan</option>
                <?php

                $sqlsiswa = mysqli_query($con, "select * from dt_karyawan ");
                while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                ?>
                    <option value="<?= $row2['nip'] ?>"><?= $row2['nama_karyawan'] ?></option>

                <?php


                }

                ?>
            </select>
        </div>

        <div class="form-group">
            <div class="section-title mt-0">Jumlah Tunjangan Masa Kerja</div>
            <div class="input-group mb-2">
                <input type="number" class="form-control" name="jmlh_tunjangan" required>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary mr-1" type="submit" name="submit3">Simpan</button>

            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
    <?php
    } else if ($tunjangan == 'reward') {
    ?>
        <hr>
        <div class="section-title mt-0">Nama Karyawan</div>
        <div class="input-group mb-2">
            <select class="form-control " name="karyawan1" required>
                <option disabled selected> Pilih Karyawan</option>
                <?php

                $sqlsiswa = mysqli_query($con, "select * from dt_karyawan ");
                while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                ?>
                    <option value="<?= $row2['nip'] ?>"><?= $row2['nama_karyawan'] ?></option>

                <?php


                }

                ?>
            </select>
        </div>

        <div class="form-group">
            <div class="section-title mt-0">Jumlah Reward</div>
            <div class="input-group mb-2">
                <input type="number" class="form-control" name="jmlh_tunjangan" required>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary mr-1" type="submit" name="submit4">Simpan</button>

            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
    <?php
    } else if ($tunjangan == 'lembur') {
    ?>
        <hr>
        <div class="section-title mt-0">Nama Karyawan</div>
        <div class="input-group mb-2">
            <select class="form-control " data-live-search="true" name="karyawan" required>
                <option disabled selected> Pilih Karyawan</option>
                <?php

                $sqlsiswa = mysqli_query($con, "select * from dt_karyawan ");
                while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                ?>
                    <option value="<?= $row2['nip'] ?>"><?= $row2['nama_karyawan'] ?></option>

                <?php


                }

                ?>
            </select>
        </div>


        <div class="form-group">
            <div class="section-title mt-0">Jumlah</div>
            <div class="input-group mb-2">
                <input type="number" class="form-control" name="jmlh" required>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary mr-1" type="submit" name="submit5">Simpan</button>

            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
    <?php
    } else if ($tunjangan == 'infaq') {
    ?>
        <hr>
        <div class="section-title mt-0">Nama Karyawan</div>
        <div class="input-group mb-2">
            <select class="form-control " name="karyawan1" required>
                <option disabled selected> Pilih Karyawan</option>
                <?php

                $sqlsiswa = mysqli_query($con, "select * from dt_karyawan ");
                while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                ?>
                    <option value="<?= $row2['nip'] ?>"><?= $row2['nama_karyawan'] ?></option>

                <?php


                }

                ?>
            </select>
        </div>

        <div class="form-group">
            <div class="section-title mt-0">Jumlah Infaq</div>
            <div class="input-group mb-2">
                <input type="number" class="form-control" name="jmlh_infaq" required>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary mr-1" type="submit" name="submit6">Simpan</button>

            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
    <?php
    } else if ($tunjangan == 'cicilan') {
    ?>
        <hr>
        <div class="section-title mt-0">Nama Karyawan</div>
        <div class="input-group mb-2">
            <select class="form-control " name="karyawan1" required>
                <option disabled selected> Pilih Karyawan</option>
                <?php

                $sqlsiswa = mysqli_query($con, "select * from dt_karyawan ");
                while ($row2 = mysqli_fetch_array($sqlsiswa)) {
                ?>
                    <option value="<?= $row2['nip'] ?>"><?= $row2['nama_karyawan'] ?></option>

                <?php


                }

                ?>
            </select>
        </div>

        <div class="form-group">
            <div class="section-title mt-0">Jumlah Cicilan</div>
            <div class="input-group mb-2">
                <input type="number" class="form-control" name="jmlh_cicilan" required>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-primary mr-1" type="submit" name="submit7">Simpan</button>

            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
<?php
    }
}
