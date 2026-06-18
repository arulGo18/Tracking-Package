<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: ../../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {

    die("Order ID Not Found");
}

$id = (int) $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM dropship_orders
     WHERE id='$id'"
);

$order = mysqli_fetch_assoc($query);

if (!$order) {

    die("Order Not Found");
}

if (isset($_POST['save'])) {

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
        "UPDATE dropship_orders
         SET
            tracking_number='$tracking_number',
            status='$status'
         WHERE id='$id'"
    );

    header("Location: index.php");
    exit;
}

include '../../includes/layout-dropshipper-top.php';

?>

    <h2>Supplier Process Order</h2>

    <hr>

    <table class="table table-bordered">

        <tr>
            <th width="250">Supplier</th>
            <td><?= $order['supplier_name']; ?></td>
        </tr>

        <tr>
            <th>Product</th>
            <td><?= $order['product_name']; ?></td>
        </tr>

        <tr>
            <th>Customer</th>
            <td><?= $order['customer_name']; ?></td>
        </tr>

    </table>

    <form method="POST">

        <div class="mb-3">

            <label>Tracking Number</label>

            <input
                type="text"
                name="tracking_number"
                class="form-control"
                value="<?= $order['tracking_number']; ?>">

        </div>

        <div class="mb-3">

            <label>Status</label>

            <select
                name="status"
                class="form-select"
                required>

                <option value="Packed"
                    <?= $order['status'] == 'Packed' ? 'selected' : ''; ?>>

                    Packed

                </option>

                <option value="In Transit"
                    <?= $order['status'] == 'In Transit' ? 'selected' : ''; ?>>

                    In Transit

                </option>

                <option value="Delivered"
                    <?= $order['status'] == 'Delivered' ? 'selected' : ''; ?>>

                    Delivered

                </option>

            </select>

        </div>

        <button
            type="submit"
            name="save"
            class="btn btn-success">

            Save

        </button>

        <a
            href="../tracking/create.php?order_id=<?= $order['id']; ?>"
            class="btn btn-primary">

            Update Tracking

        </a>

        <a
            href="index.php"
            class="btn btn-secondary">

            Back

        </a>

    </form>

<?php include '../../includes/layout-dropshipper-bottom.php'; ?>