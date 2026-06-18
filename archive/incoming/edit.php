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
    "SELECT *
     FROM incoming_shipments
     WHERE id='$id'"
);

$shipment = mysqli_fetch_assoc($query);

if (!$shipment) {
    die("Incoming Shipment Not Found");
}

if (isset($_POST['update'])) {

    $tracking_number = mysqli_real_escape_string(
        $conn,
        $_POST['tracking_number']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    mysqli_query(
        $conn,
        "UPDATE incoming_shipments
         SET
            tracking_number='$tracking_number',
            status='$status'
         WHERE id='$id'"
    );

    header("Location: index.php");
    exit;
}

include '../../includes/layout-top.php';

?>

<h2>Edit Incoming Shipment</h2>

<hr>

<form method="POST">

    <div class="mb-3">

        <label>Tracking Number</label>

        <input
            type="text"
            name="tracking_number"
            class="form-control"
            value="<?= $shipment['tracking_number']; ?>"
            required>

    </div>

    <div class="mb-3">

        <label>Status</label>

        <select
            name="status"
            class="form-select"
            required>

            <option value="Created"
                <?= $shipment['status'] == 'Created' ? 'selected' : ''; ?>>
                Created
            </option>

            <option value="Packed"
                <?= $shipment['status'] == 'Packed' ? 'selected' : ''; ?>>
                Packed
            </option>

            <option value="In Transit"
                <?= $shipment['status'] == 'In Transit' ? 'selected' : ''; ?>>
                In Transit
            </option>

            <option value="Arrived Indonesia"
                <?= $shipment['status'] == 'Arrived Indonesia' ? 'selected' : ''; ?>>
                Arrived Indonesia
            </option>

            <option value="Delivered to Reseller"
                <?= $shipment['status'] == 'Delivered to Reseller' ? 'selected' : ''; ?>>
                Delivered to Reseller
            </option>

        </select>

    </div>

    <button
        type="submit"
        name="update"
        class="btn btn-primary">

        Update Incoming Shipment

    </button>

    <a
        href="index.php"
        class="btn btn-secondary">

        Cancel

    </a>

</form>

<?php include '../../includes/layout-bottom.php'; ?>