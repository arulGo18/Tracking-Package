<?php

include '../../config/database.php';

if (isset($_POST['save'])) {

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

    $seller_id = 1;

    mysqli_query(
        $conn,
        "INSERT INTO orders
        (
            seller_id,
            customer_name,
            customer_email,
            product_name,
            quantity,
            address,
            status
        )
        VALUES
        (
            '$seller_id',
            '$customer_name',
            '$customer_email',
            '$product_name',
            '$quantity',
            '$address',
            'Pending'
        )"
    );

    $success = "Order created successfully!";
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Customer Simulator</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <h2>

        Customer Simulator

    </h2>

    <p class="text-muted">

        Create Seller Order

    </p>

    <hr>

    <?php if(isset($success)) : ?>

        <div class="alert alert-success">

            <?= $success ?>

        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">

            <label>

                Customer Name

            </label>

            <input
                type="text"
                name="customer_name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>

                Customer Email

            </label>

            <input
                type="email"
                name="customer_email"
                class="form-control">

        </div>

        <div class="mb-3">

            <label>

                Product Name

            </label>

            <input
                type="text"
                name="product_name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>

                Quantity

            </label>

            <input
                type="number"
                name="quantity"
                value="1"
                min="1"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>

                Address

            </label>

            <textarea
                name="address"
                class="form-control"
                rows="3"></textarea>

        </div>

        <button
            type="submit"
            name="save"
            class="btn btn-primary">

            Create Order

        </button>

        <a
            href="../dashboard.php"
            class="btn btn-secondary">
            
            Back
            
        </a>

    </form>

</div>

</body>
</html>