<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: ../../auth/login.php");
    exit;
}

$order_id = isset($_GET['order_id'])
    ? (int) $_GET['order_id']
    : 0;

$order = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT *
         FROM dropship_orders
         WHERE id='$order_id'"
    )
);

if (!$order) {

    die("Order Not Found");
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
        "INSERT INTO dropship_tracking_histories
        (
            order_id,
            location,
            status
        )
        VALUES
        (
            '$order_id',
            '$location',
            '$status'
        )"
    );

    mysqli_query(
        $conn,
        "UPDATE dropship_orders
         SET status='$status'
         WHERE id='$order_id'"
    );

    $success = "Tracking updated successfully!";
}

include '../../includes/layout-dropshipper-top.php';

?>

    <h2>Supplier Tracking Update</h2>

    <hr>

    <table class="table table-bordered">

        <tr>
            <th width="250">Product</th>
            <td><?= $order['product_name']; ?></td>
        </tr>

        <tr>
            <th>Customer</th>
            <td><?= $order['customer_name']; ?></td>
        </tr>

        <tr>
            <th>Tracking Number</th>
            <td><?= $order['tracking_number']; ?></td>
        </tr>

    </table>

    <?php if(isset($success)) : ?>

        <div class="alert alert-success">

            <?= $success ?>

        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">

            <label>Location</label>

            <input
                type="text"
                name="location"
                class="form-control"
                placeholder="Guangzhou"
                required>

        </div>

        <div class="mb-3">

            <label>Status</label>

            <input
                type="text"
                name="status"
                class="form-control"
                placeholder="Packed"
                required>

        </div>

        <button
            type="submit"
            name="save"
            class="btn btn-success">

            Save Tracking

        </button>

        <a
            href="../supplier/index.php"
            class="btn btn-secondary">

            Back

        </a>

    </form>

<?php include '../../includes/layout-dropshipper-bottom.php'; ?>