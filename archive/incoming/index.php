<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query(
    $conn,
    "SELECT
        incoming_shipments.*,
        suppliers.supplier_name
     FROM incoming_shipments
     JOIN suppliers
        ON suppliers.id = incoming_shipments.supplier_id
     WHERE incoming_shipments.seller_id='$user_id'
     ORDER BY incoming_shipments.id DESC"
);

include '../../includes/layout-top.php';

?>

<div class="d-flex justify-content-between mb-3">

    <h2>Incoming Shipments</h2>

    <a
        href="create.php"
        class="btn btn-primary">

        Add Incoming Shipment

    </a>

</div>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>ID</th>
            <th>Supplier</th>
            <th>Tracking Number</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

    </thead>

    <tbody>

    <?php while($row = mysqli_fetch_assoc($result)) : ?>

        <tr>

            <td><?= $row['id']; ?></td>

            <td><?= $row['supplier_name']; ?></td>

            <td><?= $row['tracking_number']; ?></td>

            <td><?= $row['status']; ?></td>

            <td>

                <a
                    href="detail.php?id=<?= $row['id']; ?>"
                    class="btn btn-sm btn-info">

                    Detail

                </a>

                <a
                    href="edit.php?id=<?= $row['id']; ?>"
                    class="btn btn-sm btn-warning">

                    Edit

                </a>

                <a
                    href="delete.php?id=<?= $row['id']; ?>"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Delete this incoming shipment?')">

                    Delete

                </a>

            </td>

        </tr>

    <?php endwhile; ?>

    </tbody>

</table>

<?php include '../../includes/layout-bottom.php'; ?>