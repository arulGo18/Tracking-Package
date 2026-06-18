<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Order ID Not Found");
}

$id = (int) $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     WHERE id='$id'"
);

$order = mysqli_fetch_assoc($query);

if (!$order) {
    die("Order Not Found");
}

if (isset($_POST['process'])) {

    $tracking_number =
        'TRK' .
        time() .
        rand(100,999);

    mysqli_query(
        $conn,
        "INSERT INTO shipments
        (
            tracking_number,
            seller_id,
            buyer_name,
            shipment_type,
            status
        )
        VALUES
        (
            '$tracking_number',
            '{$order['seller_id']}',
            '{$order['customer_name']}',
            'personal',
            'Packed'
        )"
    );

    mysqli_query(
        $conn,
        "UPDATE orders
         SET
            status='Packed',
            shipment_created=1
         WHERE id='$id'"
    );

    header("Location: ../shipment/index.php");
    exit;
}

include '../../includes/layout-top.php';

?>

<div class="d-flex justify-content-between">

    <h2>Order Detail</h2>

    <a
        href="index.php"
        class="btn btn-secondary">

        Back

    </a>

</div>

<hr>

<table class="table table-bordered">

    <tr>

        <th width="250">

            Customer Name

        </th>

        <td>

            <?= $order['customer_name']; ?>

        </td>

    </tr>

    <tr>

        <th>

            Product

        </th>

        <td>

            <?= $order['product_name']; ?>

        </td>

    </tr>

    <tr>

        <th>

            Quantity

        </th>

        <td>

            <?= $order['quantity']; ?>

        </td>

    </tr>

    <tr>

        <th>

            Address

        </th>

        <td>

            <?= nl2br($order['address']); ?>

        </td>

    </tr>

    <tr>

        <th>

            Status

        </th>

        <td>

            <?= $order['status']; ?>

        </td>

    </tr>

</table>

<?php if(!$order['shipment_created']) : ?>

<form method="POST">

    <button
        type="submit"
        name="process"
        class="btn btn-success">

        Process Order

    </button>

</form>

<?php else : ?>

<div class="alert alert-success">

    Shipment has been created.

</div>

<?php endif; ?>

<?php include '../../includes/layout-bottom.php'; ?>