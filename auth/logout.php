<?php
require_once "../config/config.php";
if ($_SESSION['jabatan'] == 'Siswa') {
    unset($_SESSION['username']);
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
} else {
    unset($_SESSION['username']);
    echo "<script>window.location='" . base_url('auth/login.php') . "';</script>";
}
