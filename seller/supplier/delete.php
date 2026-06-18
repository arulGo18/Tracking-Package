<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$id = (int) $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM suppliers
     WHERE id='$id'"
);

header("Location: index.php");
exit;