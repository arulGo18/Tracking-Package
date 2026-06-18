<?php

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

$shipment = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT *
         FROM shipments
         WHERE id='$id'"
    )
);

if (!$shipment) {
    die("Shipment Not Found");
}

if (isset($_POST['save'])) {

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
        "INSERT INTO tracking_histories
        (
            shipment_id,
            location,
            status
        )
        VALUES
        (
            '$id',
            '$location',
            '$status'
        )"
    );

    mysqli_query(
        $conn,
        "UPDATE shipments
         SET status='$status'
         WHERE id='$id'"
    );

    header(
        "Location: ../shipment/detail.php?id=$id"
    );
    exit;
}

include '../../includes/layout-top.php';

?>

<h2>Update Logistics</h2>

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

            Buyer

        </th>

        <td>

            <?= $shipment['buyer_name']; ?>

        </td>

    </tr>

    <tr>

        <th>

            Current Status

        </th>

        <td>

            <?= $shipment['status']; ?>

        </td>

    </tr>

</table>

<form method="POST">

    <div class="mb-3">

        <label>Location</label>

        <input
            type="text"
            name="location"
            class="form-control"
            placeholder="Jakarta Hub"
            required>

    </div>

    <div class="mb-3">

        <label>Status</label>

        <select
            name="status"
            class="form-select"
            required>

            <option value="Packed">

                Packed

            </option>

            <option value="In Transit">

                In Transit

            </option>

            <option value="Delivered">

                Delivered

            </option>

        </select>

    </div>

    <button
        type="submit"
        name="save"
        class="btn btn-success">

        Save Update

    </button>

    <a
        href="index.php"
        class="btn btn-secondary">

        Back

    </a>

</form>

<?php include '../../includes/layout-bottom.php'; ?>