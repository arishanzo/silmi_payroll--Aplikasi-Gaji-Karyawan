<?php
header('Content-Type: application/json; charset=utf8');

require_once "../config/config.php";
//query tabel produk

$sql = "SELECT * From total_gaji_perdevisi";
$query = mysqli_query($con, $sql);

$array = array();
while ($data = mysqli_fetch_assoc($query)) $array[] = $data;


//mengubah data array menjadi format json
echo json_encode($array);
