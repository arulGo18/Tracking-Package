<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Shipment ID Not Found");
}

$id = (int) $_GET['id'];

$shipment_query = mysqli_query(
    $conn,
    "SELECT
        shipments.*,
        consolidations.consolidation_number
     FROM shipments
     LEFT JOIN consolidations
        ON consolidations.id = shipments.consolidation_id
     WHERE shipments.id='$id'"
);

$shipment = mysqli_fetch_assoc($shipment_query);

if (!$shipment) {
    die("Shipment Not Found");
}

$consolidation_items = null;

if (!empty($shipment['consolidation_id'])) {

    $consolidation_items = mysqli_query(
        $conn,
        "SELECT
            orders.customer_name,
            orders.customer_email,
            orders.product_name,
            orders.quantity
         FROM consolidation_orders
         JOIN orders
            ON orders.id =
               consolidation_orders.order_id
         WHERE consolidation_orders.consolidation_id =
               '{$shipment['consolidation_id']}'"
    );
}

$histories = mysqli_query(
    $conn,
    "SELECT *
     FROM tracking_histories
     WHERE shipment_id='$id'
     ORDER BY created_at DESC"
);

include '../../includes/layout-top.php';

?>

<div class="d-flex justify-content-between align-items-center">

    <h2>Shipment Detail</h2>

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

            Tracking Number

        </th>

        <td>

            <?= $shipment['tracking_number']; ?>

        </td>

    </tr>

    <tr>

        <th>

            Buyer Name

        </th>

        <td>

            <?= $shipment['buyer_name']; ?>

        </td>

    </tr>

    <tr>

        <th>

            Buyer Email

        </th>

        <td>

            <?= $shipment['buyer_email']; ?>

        </td>

    </tr>

    <tr>

        <th>

            Shipment Type

        </th>

        <td>

            <?= ucfirst($shipment['shipment_type']); ?>

        </td>

    </tr>

    <?php if(!empty($shipment['consolidation_number'])) : ?>

    <tr>

        <th>

            Consolidation

        </th>

        <td>

            <?= $shipment['consolidation_number']; ?>

        </td>

    </tr>

    <?php endif; ?>

    <tr>

        <th>

            Current Status

        </th>

        <td>

            <?= $shipment['status']; ?>

        </td>

    </tr>

</table>

<?php if($consolidation_items) : ?>

<h4 class="mt-4">

    Consolidated Orders

</h4>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Customer</th>
            <th>Email</th>
            <th>Product</th>
            <th>Quantity</th>

        </tr>

    </thead>

    <tbody>

    <?php while($item = mysqli_fetch_assoc($consolidation_items)) : ?>

        <tr>

            <td>

                <?= $item['customer_name']; ?>

            </td>

            <td>

                <?= $item['customer_email']; ?>

            </td>

            <td>

                <?= $item['product_name']; ?>

            </td>

            <td>

                <?= $item['quantity']; ?>

            </td>

        </tr>

    <?php endwhile; ?>

    </tbody>

</table>

<?php endif; ?>

<h4 class="mt-4">

    Tracking Timeline

</h4>

<div class="timeline">

<?php while($history = mysqli_fetch_assoc($histories)) : ?>

    <div class="timeline-item">

        <div class="timeline-dot"></div>

        <div class="timeline-content">

            <strong>

                <?= $history['status']; ?>

            </strong>

            <br>

            <span class="timeline-location">

                <?= $history['location']; ?>

            </span>

            <br>

            <span class="timeline-date">

                <?= $history['created_at']; ?>

            </span>

        </div>

    </div>

<?php endwhile; ?>

</div>

<?php include '../../includes/layout-bottom.php'; ?>