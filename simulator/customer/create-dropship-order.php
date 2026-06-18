<?php

include '../../config/database.php';

if (isset($_POST['save'])) {

    $supplier_name = mysqli_real_escape_string(
        $conn,
        $_POST['supplier_name']
    );

    $product_name = mysqli_real_escape_string(
        $conn,
        $_POST['product_name']
    );

    $customer_name = mysqli_real_escape_string(
        $conn,
        $_POST['customer_name']
    );

    $customer_country = mysqli_real_escape_string(
        $conn,
        $_POST['customer_country']
    );

    $customer_address = mysqli_real_escape_string(
        $conn,
        $_POST['customer_address']
    );

    $dropshipper_id = 1;

    mysqli_query(
        $conn,
        "INSERT INTO dropship_orders
        (
            dropshipper_id,
            supplier_name,
            product_name,
            customer_name,
            customer_country,
            customer_address,
            status
        )
        VALUES
        (
            '$dropshipper_id',
            '$supplier_name',
            '$product_name',
            '$customer_name',
            '$customer_country',
            '$customer_address',
            'Pending'
        )"
    );

    $success = "Dropship order created successfully!";
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Dropship Customer Simulator</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <h2>Dropship Customer Simulator</h2>

    <p class="text-muted">

        Create Dropship Order

    </p>

    <hr>

    <?php if(isset($success)) : ?>

        <div class="alert alert-success">

            <?= $success ?>

        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">

            <label>Supplier Name</label>

            <input
                type="text"
                name="supplier_name"
                class="form-control"
                placeholder="Shenzhen Supplier"
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

            <label>Customer Name</label>

            <input
                type="text"
                name="customer_name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Customer Country</label>

            <input
                type="text"
                name="customer_country"
                class="form-control"
                value="Indonesia"
                required>

        </div>

        <div class="mb-3">

            <label>Customer Address</label>

            <textarea
                name="customer_address"
                class="form-control"
                rows="3"
                required></textarea>

        </div>

        <button
            type="submit"
            name="save"
            class="btn btn-primary">

            Create Dropship Order

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