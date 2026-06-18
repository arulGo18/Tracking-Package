<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Incoming Shipment ID Not Found");
}

$id = (int) $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT
        incoming_shipments.*,
        suppliers.supplier_name,
        suppliers.country
     FROM incoming_shipments
     JOIN suppliers
        ON suppliers.id = incoming_shipments.supplier_id
     WHERE incoming_shipments.id='$id'"
);

$shipment = mysqli_fetch_assoc($query);

if (!$shipment) {
    die("Incoming Shipment Not Found");
}

$histories = mysqli_query(
    $conn,
    "SELECT *
     FROM incoming_tracking_histories
     WHERE incoming_shipment_id='$id'
     ORDER BY created_at ASC"
);

include '../../includes/layout-top.php';

?>

    <div class="d-flex justify-content-between align-items-center">

        <h2>Incoming Shipment Detail</h2>

        <a
            href="index.php"
            class="btn btn-secondary">

            Back

        </a>

    </div>

    <hr>

    <table class="table table-bordered">

        <tr>
            <th width="250">Supplier</th>
            <td><?= $shipment['supplier_name']; ?></td>
        </tr>

        <tr>
            <th>Country</th>
            <td><?= $shipment['country']; ?></td>
        </tr>

        <tr>
            <th>Tracking Number</th>
            <td><?= $shipment['tracking_number']; ?></td>
        </tr>

        <tr>
            <th>Current Status</th>
            <td><?= $shipment['status']; ?></td>
        </tr>

    </table>

    <h4 class="mt-4">
        Incoming Tracking Timeline
    </h4>

    <table class="table table-striped">

        <thead>

            <tr>

                <th>Date</th>
                <th>Location</th>
                <th>Status</th>

            </tr>

        </thead>

        <tbody>

        <?php while($history = mysqli_fetch_assoc($histories)) : ?>

            <tr>

                <td><?= $history['created_at']; ?></td>

                <td><?= $history['location']; ?></td>

                <td><?= $history['status']; ?></td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

<?php include '../../includes/layout-bottom.php'; ?>