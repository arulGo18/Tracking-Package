<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if (isset($_POST['save'])) {

    $seller_id = $_SESSION['user_id'];

    $supplier_name = mysqli_real_escape_string(
        $conn,
        $_POST['supplier_name']
    );

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $phone = mysqli_real_escape_string(
        $conn,
        $_POST['phone']
    );

    $country = mysqli_real_escape_string(
        $conn,
        $_POST['country']
    );

    mysqli_query(
        $conn,
        "INSERT INTO suppliers
        (
            seller_id,
            supplier_name,
            email,
            phone,
            country
        )
        VALUES
        (
            '$seller_id',
            '$supplier_name',
            '$email',
            '$phone',
            '$country'
        )"
    );

    $success = "Supplier created successfully!";
}

include '../../includes/layout-top.php';

?>

    <h2>Create Supplier</h2>

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
                required>

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control">

        </div>

        <div class="mb-3">

            <label>Phone</label>

            <input
                type="text"
                name="phone"
                class="form-control">

        </div>

        <div class="mb-3">

            <label>Country</label>

            <input
                type="text"
                name="country"
                class="form-control"
                placeholder="China">

        </div>

        <button
            type="submit"
            name="save"
            class="btn btn-primary">

            Save Supplier

        </button>

    </form>

<?php include '../../includes/layout-bottom.php'; ?>