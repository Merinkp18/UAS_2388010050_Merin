<?php

$host = "db-webdinamis";
$user = "uas_merin";
$pass = "merin123";
$db   = "db_uas";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}