<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$seller_id = $_SESSION['user_id'];

$shipments = mysqli_query(
    $conn,
    "SELECT *
     FROM shipments
     WHERE seller_id='$seller_id'
     ORDER BY id DESC"
);

if (isset($_POST['save'])) {

    $shipment_id = $_POST['shipment_id'];

    $location = mysqli_real_escape_string(
        $conn,
        $_POST['location']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    $query = "INSERT INTO tracking_histories
    (
        shipment_id,
        location,
        status
    )
    VALUES
    (
        '$shipment_id',
        '$location',
        '$status'
    )";

    if (mysqli_query($conn, $query)) {

        mysqli_query(
            $conn,
            "UPDATE shipments
             SET status='$status'
             WHERE id='$shipment_id'"
        );

        $success = "Tracking updated successfully!";
    }
}

include '../../includes/layout-simulator-top.php';

?>

<h2>Add Tracking Update</h2>

<hr>

<?php if(isset($success)) : ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
<?php endif; ?>

<form method="POST">

    <div class="mb-3">

        <label>Shipment</label>

        <select
            name="shipment_id"
            class="form-select"
            required>

            <option value="">
                Select Shipment
            </option>

            <?php while($shipment = mysqli_fetch_assoc($shipments)) : ?>

                <option value="<?= $shipment['id']; ?>">

                    <?= $shipment['tracking_number']; ?>
                    -
                    <?= $shipment['buyer_name']; ?>

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

        <input
            type="text"
            name="status"
            class="form-control"
            placeholder="In Transit"
            required>

    </div>

    <button
        type="submit"
        name="save"
        class="btn btn-primary">

        Save Tracking

    </button>

    <a
            href="../dashboard.php"
            class="btn btn-secondary">
            
            Back
            
        </a>

</form>

<?php include '../../includes/layout-simulator-bottom.php'; ?>