<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$id = (int) $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM suppliers WHERE id='$id'"
);

$supplier = mysqli_fetch_assoc($query);

if (!$supplier) {
    die("Supplier Not Found");
}

if (isset($_POST['update'])) {

    $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);

    mysqli_query(
        $conn,
        "UPDATE suppliers
         SET
            supplier_name='$supplier_name',
            email='$email',
            phone='$phone',
            country='$country'
         WHERE id='$id'"
    );

    header("Location: index.php");
    exit;
}

include '../../includes/layout-top.php';

?>
    <h2>Edit Supplier</h2>

    <hr>

    <form method="POST">

        <div class="mb-3">
            <label>Supplier Name</label>
            <input
                type="text"
                name="supplier_name"
                class="form-control"
                value="<?= $supplier['supplier_name']; ?>"
                required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="<?= $supplier['email']; ?>">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input
                type="text"
                name="phone"
                class="form-control"
                value="<?= $supplier['phone']; ?>">
        </div>

        <div class="mb-3">
            <label>Country</label>
            <input
                type="text"
                name="country"
                class="form-control"
                value="<?= $supplier['country']; ?>">
        </div>

        <button
            type="submit"
            name="update"
            class="btn btn-primary">

            Update Supplier

        </button>

        <a
            href="index.php"
            class="btn btn-secondary">

            Cancel

        </a>

    </form>

<?php include '../../includes/layout-bottom.php'; ?>