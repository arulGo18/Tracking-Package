<?php

include '../../config/database.php';

include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: ../../auth/login.php");
    exit;
}

if (isset($_POST['save'])) {

    $dropshipper_id = $_SESSION['user_id'];

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

    $query = "
        INSERT INTO dropship_orders
        (
            dropshipper_id,
            supplier_name,
            product_name,
            customer_name,
            customer_country,
            customer_address
        )
        VALUES
        (
            '$dropshipper_id',
            '$supplier_name',
            '$product_name',
            '$customer_name',
            '$customer_country',
            '$customer_address'
        )
    ";

    if (mysqli_query($conn, $query)) {

        $success = "Order sent successfully!";

    } else {

        $error = mysqli_error($conn);

    }
}

include '../../includes/layout-dropshipper-top.php';

?>


    <h2>Pesan Barang</h2>

    <hr>

    <?php if(isset($success)) : ?>

        <div class="alert alert-success">

            <?= $success ?>

        </div>

    <?php endif; ?>

    <?php if(isset($error)) : ?>

        <div class="alert alert-danger">

            <?= $error ?>

        </div>

    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">

            <label>Nama Toko Luar Negeri</label>

            <input
                type="text"
                name="supplier_name"
                class="form-control"
                placeholder="Shenzhen Electronics"
                required>

        </div>

        <div class="mb-3">

            <label>Nama Barang</label>

            <input
                type="text"
                name="product_name"
                class="form-control"
                placeholder="Logitech Mouse"
                required>

        </div>

        <div class="mb-3">

            <label>Nama Pembeli</label>

            <input
                type="text"
                name="customer_name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Negara Tujuan</label>

            <input
                type="text"
                name="customer_country"
                class="form-control"
                value="Indonesia"
                required>

        </div>

        <div class="mb-3">

            <label>Alamat Lengkap</label>

            <textarea
                name="customer_address"
                class="form-control"
                rows="4"
                required></textarea>

        </div>

        <button
            type="submit"
            name="save"
            class="btn btn-success">

            Kirim Pesanan

        </button>

        <a
            href="index.php"
            class="btn btn-secondary">

            Back

        </a>

    </form>

<?php include '../../includes/layout-dropshipper-bottom.php'; ?>