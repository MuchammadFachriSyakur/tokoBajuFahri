<?php
$host = "localhost";
$user = "root";
$pasword = "";
$nama_database = "fahriSyakurToko";

$db = mysqli_connect($host, $user, $pasword, $nama_database);
if (!$db) {
    die("Gagal Terhubung Database");
}
?>