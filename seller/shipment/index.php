<?php

include '../../config/database.php';
include '../../config/session.php';
include '../../includes/status-badge.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$seller_id = $_SESSION['user_id'];

$query = "
    SELECT *
    FROM shipments
    WHERE seller_id='$seller_id'
    ORDER BY id DESC
";

$result = mysqli_query($conn, $query);

include '../../includes/layout-top.php';

?>

<div class="d-flex justify-content-between mb-3">

    <h2>My Shipments</h2>

    <a
        href="create.php"
        class="btn btn-primary">

        Create Shipment

    </a>

</div>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>ID</th>
            <th>Tracking Number</th>
            <th>Buyer Name</th>
            <th>Type</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

    </thead>

    <tbody>

    <?php while($shipment = mysqli_fetch_assoc($result)) : ?>

        <tr>

            <td><?= $shipment['id']; ?></td>

            <td>

                <a href="detail.php?id=<?= $shipment['id']; ?>">

                    <?= $shipment['tracking_number']; ?>

                </a>

            </td>

            <td><?= $shipment['buyer_name']; ?></td>

            <td><?= ucfirst($shipment['shipment_type']); ?></td>

            <td><?= $shipment['status']; ?></td>

            <td>

                <a
                    href="detail.php?id=<?= $shipment['id']; ?>"
                    class="btn btn-sm btn-info">

                    Detail

                </a>

                <a
                    href="edit.php?id=<?= $shipment['id']; ?>"
                    class="btn btn-sm btn-warning">

                    Edit

                </a>

                <a
                    href="delete.php?id=<?= $shipment['id']; ?>"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Delete this shipment?')">

                    Delete

                </a>

            </td>

        </tr>

    <?php endwhile; ?>

    </tbody>

</table>

<?php include '../../includes/layout-bottom.php'; ?>