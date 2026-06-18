<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$orders = mysqli_query(
    $conn,
    "SELECT *
     FROM orders
     WHERE seller_id='$user_id'
     AND consolidated=0
     ORDER BY customer_email, id"
);

if (isset($_POST['save'])) {

    $consolidation_number = mysqli_real_escape_string(
        $conn,
        $_POST['consolidation_number']
    );

    mysqli_query(
        $conn,
        "INSERT INTO consolidations
        (
            seller_id,
            consolidation_number
        )
        VALUES
        (
            '$user_id',
            '$consolidation_number'
        )"
    );

    $consolidation_id = mysqli_insert_id($conn);

    if (isset($_POST['orders'])) {

        foreach ($_POST['orders'] as $order_id) {

            mysqli_query(
                $conn,
                "INSERT INTO consolidation_orders
                (
                    consolidation_id,
                    order_id
                )
                VALUES
                (
                    '$consolidation_id',
                    '$order_id'
                )"
            );

            mysqli_query(
                $conn,
                "UPDATE orders
                 SET consolidated=1
                 WHERE id='$order_id'"
            );
        }
    }

    $success = "Consolidation created successfully!";
}

include '../../includes/layout-top.php';

?>

<h2>Create Consolidation</h2>

<hr>

<?php if(isset($success)) : ?>

    <div class="alert alert-success">

        <?= $success ?>

    </div>

<?php endif; ?>

<form method="POST">

    <div class="mb-3">

        <label>Consolidation Number</label>

        <input
            type="text"
            name="consolidation_number"
            class="form-control"
            placeholder="CONS001"
            required>

    </div>

    <div class="mb-3">

        <label>Select Orders</label>

        <?php while($order = mysqli_fetch_assoc($orders)) : ?>

            <div class="form-check">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="orders[]"
                    value="<?= $order['id']; ?>">

                <label class="form-check-label">

                    <strong>
                        <?= $order['customer_email']; ?>
                    </strong>

                    -

                    <?= $order['product_name']; ?>

                    (Qty:
                    <?= $order['quantity']; ?>)

                </label>

            </div>

        <?php endwhile; ?>

    </div>

    <button
        type="submit"
        name="save"
        class="btn btn-primary">

        Create Consolidation

    </button>

</form>

<?php include '../../includes/layout-bottom.php'; ?>