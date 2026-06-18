<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$incoming_shipments = mysqli_query(
    $conn,
    "SELECT *
     FROM incoming_shipments
     WHERE seller_id='$user_id'
     ORDER BY id DESC"
);

if (isset($_POST['save'])) {

    $incoming_shipment_id = $_POST['incoming_shipment_id'];

    $location = mysqli_real_escape_string(
        $conn,
        $_POST['location']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    mysqli_query(
        $conn,
        "INSERT INTO incoming_tracking_histories
        (
            incoming_shipment_id,
            location,
            status
        )
        VALUES
        (
            '$incoming_shipment_id',
            '$location',
            '$status'
        )"
    );

    mysqli_query(
        $conn,
        "UPDATE incoming_shipments
         SET status='$status'
         WHERE id='$incoming_shipment_id'"
    );

    $success = "Incoming tracking updated successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Add Incoming Tracking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <h2>Add Incoming Tracking</h2>

    <hr>

    <?php if(isset($success)) : ?>

        <div class="alert alert-success">
            <?= $success ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">

            <label>Incoming Shipment</label>

            <select
                name="incoming_shipment_id"
                class="form-select"
                required>

                <option value="">
                    Select Incoming Shipment
                </option>

                <?php while($shipment = mysqli_fetch_assoc($incoming_shipments)) : ?>

                    <option value="<?= $shipment['id']; ?>">

                        <?= $shipment['tracking_number']; ?>

                    </option>

                <?php endwhile; ?>

            </select>

        </div>

        <div class="mb-3">

            <label>Location</label>

            <input
                type="text"
                name="location"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Status</label>

            <select
                name="status"
                class="form-select"
                required>

                <option value="Created">
                    Created
                </option>

                <option value="Packed">
                    Packed
                </option>

                <option value="Export Clearance">
                    Export Clearance
                </option>

                <option value="In Transit">
                    In Transit
                </option>

                <option value="Arrived Indonesia">
                    Arrived Indonesia
                </option>

                <option value="Delivered to Reseller">
                    Delivered to Reseller
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="save"
            class="btn btn-primary">

            Save Tracking Update

        </button>

    </form>

</div>

</body>
</html>