<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

/*
 * Pastikan shipment milik user yang login
 */
$check = mysqli_query(
    $conn,
    "SELECT *
     FROM shipments
     WHERE id='$id'
     AND seller_id='$user_id'"
);

if (mysqli_num_rows($check) == 0) {

    header("Location: index.php");
    exit;
}

/*
 * Hapus tracking histories terlebih dahulu
 */
mysqli_query(
    $conn,
    "DELETE FROM tracking_histories
     WHERE shipment_id='$id'"
);

/*
 * Hapus shipment
 */
mysqli_query(
    $conn,
    "DELETE FROM shipments
     WHERE id='$id'"
);

header("Location: index.php");
exit;