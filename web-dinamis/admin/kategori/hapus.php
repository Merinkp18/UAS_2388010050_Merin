<?php

require_once "../../config/session.php";
require_once "../../config/database.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM kategori WHERE id='$id'"
);

header("Location:index.php");
exit;