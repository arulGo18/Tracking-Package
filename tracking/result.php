<?php

include '../config/database.php';

if (!isset($_GET['tracking_number'])) {
    die("Tracking Number Not Found");
}

$tracking_number = mysqli_real_escape_string(
    $conn,
    $_GET['tracking_number']
);

$shipment_query = mysqli_query(
    $conn,
    "SELECT * FROM shipments
     WHERE tracking_number='$tracking_number'"
);

$shipment = mysqli_fetch_assoc($shipment_query);

if (!$shipment) {
    die("Shipment Not Found");
}

$histories = mysqli_query(
    $conn,
    "SELECT *
     FROM tracking_histories
     WHERE shipment_id='{$shipment['id']}'
     ORDER BY created_at ASC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tracking Result</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Tracking Result</h2>

    <hr>

    <table class="table table-bordered">

        <tr>
            <th>Tracking Number</th>
            <td><?= $shipment['tracking_number']; ?></td>
        </tr>

        <tr>
            <th>Buyer</th>
            <td><?= $shipment['buyer_name']; ?></td>
        </tr>

        <tr>
            <th>Shipment Type</th>
            <td><?= ucfirst($shipment['shipment_type']); ?></td>
        </tr>

        <tr>
            <th>Current Status</th>
            <td><?= $shipment['status']; ?></td>
        </tr>

    </table>

    <h4 class="mt-4">
        Tracking Timeline
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

        <?php while($row = mysqli_fetch_assoc($histories)) : ?>

            <tr>

                <td><?= $row['created_at']; ?></td>

                <td><?= $row['location']; ?></td>

                <td><?= $row['status']; ?></td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</div>

</body>
</html>