<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$suppliers = mysqli_query(
    $conn,
    "SELECT *
     FROM suppliers
     WHERE seller_id='$user_id'
     ORDER BY supplier_name ASC"
);

if (isset($_POST['save'])) {

    $supplier_id = $_POST['supplier_id'];

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
        "INSERT INTO incoming_shipments
        (
            seller_id,
            supplier_id,
            tracking_number,
            status
        )
        VALUES
        (
            '$user_id',
            '$supplier_id',
            '$tracking_number',
            '$status'
        )"
    );

    $success = "Incoming shipment created successfully!";
}


include '../../includes/layout-top.php';

?>

    <h2>Create Incoming Shipment</h2>

    <hr>

    <?php if(isset($success)) : ?>

        <div class="alert alert-success">
            <?= $success ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">

            <label>Supplier</label>

            <select
                name="supplier_id"
                class="form-select"
                required>

                <option value="">
                    Select Supplier
                </option>

                <?php while($supplier = mysqli_fetch_assoc($suppliers)) : ?>

                    <option value="<?= $supplier['id']; ?>">

                        <?= $supplier['supplier_name']; ?>

                    </option>

                <?php endwhile; ?>

            </select>

        </div>

        <div class="mb-3">

            <label>Tracking Number</label>

            <input
                type="text"
                name="tracking_number"
                class="form-control"
                placeholder="CN001"
                required>

        </div>

        <div class="mb-3">

            <label>Status</label>

            <select
                name="status"
                class="form-select"
                required>

                <option value="Created">Created</option>

                <option value="Packed">Packed</option>

                <option value="In Transit">In Transit</option>

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

            Save Incoming Shipment

        </button>

        <a
            href="index.php"
            class="btn btn-secondary">
            Back

        </a>

    </form>

<?php include '../../includes/layout-bottom.php'; ?>