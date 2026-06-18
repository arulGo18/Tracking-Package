<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: ../../auth/login.php");
    exit;
}

$id = (int) $_GET['id'];

$consolidation = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT *
         FROM consolidations
         WHERE id='$id'"
    )
);

if (!$consolidation) {

    die("Consolidation Not Found");
}

$orders = mysqli_query(
    $conn,
    "SELECT
        orders.*
     FROM consolidation_orders
     JOIN orders
        ON orders.id =
           consolidation_orders.order_id
     WHERE consolidation_orders.consolidation_id='$id'"
);

include '../../includes/layout-top.php';

?>

<div class="d-flex justify-content-between">

    <h2>Consolidation Detail</h2>

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

            Consolidation Number

        </th>

        <td>

            <?= $consolidation['consolidation_number']; ?>

        </td>

    </tr>

    <tr>

        <th>

            Status

        </th>

        <td>

            <?= $consolidation['status']; ?>

        </td>

    </tr>

    <tr>

        <th>

            Created At

        </th>

        <td>

            <?= $consolidation['created_at']; ?>

        </td>

    </tr>

</table>

<h4 class="mt-4">

    Consolidated Orders

</h4>

<table class="table table-striped">

    <thead>

        <tr>

            <th>ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Status</th>

        </tr>

    </thead>

    <tbody>

    <?php while($order = mysqli_fetch_assoc($orders)) : ?>

        <tr>

            <td>

                <?= $order['id']; ?>

            </td>

            <td>

                <?= $order['customer_name']; ?>

            </td>

            <td>

                <?= $order['customer_email']; ?>

            </td>

            <td>

                <?= $order['product_name']; ?>

            </td>

            <td>

                <?= $order['quantity']; ?>

            </td>

            <td>

                <?= $order['status']; ?>

            </td>

        </tr>

    <?php endwhile; ?>

    </tbody>

</table>

<?php include '../../includes/layout-bottom.php'; ?>