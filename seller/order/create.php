<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if (isset($_POST['save'])) {

    $seller_id = $_SESSION['user_id'];

    $customer_name = mysqli_real_escape_string(
        $conn,
        $_POST['customer_name']
    );

    $customer_email = mysqli_real_escape_string(
        $conn,
        $_POST['customer_email']
    );

    $product_name = mysqli_real_escape_string(
        $conn,
        $_POST['product_name']
    );

    $quantity = (int) $_POST['quantity'];

    $address = mysqli_real_escape_string(
        $conn,
        $_POST['address']
    );

    $query = "
        INSERT INTO orders
    (
        seller_id,
        customer_name,
        customer_email,
        product_name,
        quantity,
        address
    )
        VALUES
        (
            '$seller_id',
            '$customer_name',
            '$customer_email',
            '$product_name',
            '$quantity',
            '$address'
        )
    ";

    if (mysqli_query($conn, $query)) {

        header("Location: index.php");
        exit;

    } else {

        $error = mysqli_error($conn);

    }
}

include '../../includes/layout-top.php';

?>

<div class="container">

    <h2>Create Customer Order</h2>

    <hr>

    <?php if(isset($error)) : ?>

        <div class="alert alert-danger">

            <?= $error ?>

        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">

            <label>Customer Name</label>

            <input
                type="text"
                name="customer_name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Customer Email</label>

            <input
                type="email"
                name="customer_email"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Product Name</label>

            <input
                type="text"
                name="product_name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Quantity</label>

            <input
                type="number"
                name="quantity"
                class="form-control"
                value="1"
                min="1"
                required>

        </div>

        <div class="mb-3">

            <label>Shipping Address</label>

            <textarea
                name="address"
                class="form-control"
                rows="4"
                required></textarea>

        </div>

        <button
            type="submit"
            name="save"
            class="btn btn-success">

            Save Order

        </button>

        <a
            href="index.php"
            class="btn btn-secondary">

            Back

        </a>

    </form>

</div>

<?php include '../../includes/layout-bottom.php'; ?>