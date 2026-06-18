<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: ../../auth/login.php");
    exit;
}

$seller_id = $_SESSION['user_id'];

$query = "
    SELECT *
    FROM orders
    WHERE seller_id='$seller_id'
    ORDER BY id DESC
";

$result = mysqli_query($conn, $query);

include '../../includes/layout-top.php';

?>

<div class="d-flex justify-content-between mb-3">

    <h2>Customer Orders</h2>

    <a
        href="create.php"
        class="btn btn-success">


    </a>

</div>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

    </thead>

    <tbody>

    <?php while($order = mysqli_fetch_assoc($result)) : ?>

        <tr>

            <td>

                <?= $order['id']; ?>

            </td>

            <td>

                <?= $order['customer_name']; ?>

            </td>

            <td>

                <?= $order['customer_email']; ?>

            </td>

            <td>

                <?= $order['product_name']; ?>

            </td>

            <td>

                <?= $order['quantity']; ?>

            </td>

            <td>

                <?= $order['status']; ?>

            </td>

            <td>

                <a
                    href="detail.php?id=<?= $order['id']; ?>"
                    class="btn btn-sm btn-info">

                    Detail

                </a>

            </td>

        </tr>

    <?php endwhile; ?>

    </tbody>

</table>

<?php include '../../includes/layout-bottom.php'; ?>