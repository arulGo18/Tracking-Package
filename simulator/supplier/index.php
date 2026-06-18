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
     FROM dropship_orders
     ORDER BY id DESC"
);

include '../../includes/layout-simulator-top.php';

?>

    <div class="d-flex justify-content-between mb-3">

        <h2>
            Supplier Panel
        </h2>

    </div>

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>ID</th>
                <th>Supplier</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

        <?php while($order = mysqli_fetch_assoc($result)) : ?>

            <tr>

                <td><?= $order['id']; ?></td>

                <td><?= $order['supplier_name']; ?></td>

                <td><?= $order['product_name']; ?></td>

                <td><?= $order['customer_name']; ?></td>

                <td><?= $order['status']; ?></td>

                <td>

                    <a
                        href="update.php?id=<?= $order['id']; ?>"
                        class="btn btn-sm btn-success">

                        Process

                    </a>

                    <a
                        href="../tracking/create.php?order_id=<?= $order['id']; ?>"
                        class="btn btn-sm btn-primary">

                        Tracking

                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

<?php include '../../includes/layout-simulator-bottom.php'; ?>