<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$result = mysqli_query(
    $conn,
    "SELECT *
     FROM shipments
     ORDER BY id DESC"
);

include '../../includes/layout-top.php';

?>

<div class="d-flex justify-content-between mb-3">

    <h2>Logistics Panel</h2>

</div>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>ID</th>
            <th>Tracking Number</th>
            <th>Buyer</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

    </thead>

    <tbody>

    <?php while($shipment = mysqli_fetch_assoc($result)) : ?>

        <tr>

            <td><?= $shipment['id']; ?></td>

            <td><?= $shipment['tracking_number']; ?></td>

            <td><?= $shipment['buyer_name']; ?></td>

            <td><?= $shipment['status']; ?></td>

            <td>

                <a
                    href="update.php?id=<?= $shipment['id']; ?>"
                    class="btn btn-sm btn-success">

                    Update

                </a>

            </td>

        </tr>

    <?php endwhile; ?>

    </tbody>

</table>

<?php include '../../includes/layout-bottom.php'; ?>