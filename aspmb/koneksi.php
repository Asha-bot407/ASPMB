<?php
//menyimpan server
$host = "localhost";
$username = "root";
$password = "";
$db = "db_aspmb";

//koneksi
$koneksi = mysqli_connect($host, $username, $password, $db);

if(!$koneksi){
    die("Koneksi Gagal : " . mysqli_connect_error());
}

?>