<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Shipment ID Not Found");
}

$id = (int) $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM shipments WHERE id='$id'"
);

$shipment = mysqli_fetch_assoc($query);

if (!$shipment) {
    die("Shipment Not Found");
}

if (isset($_POST['update'])) {

    $buyer_name = mysqli_real_escape_string(
        $conn,
        $_POST['buyer_name']
    );

    $buyer_email = mysqli_real_escape_string(
        $conn,
        $_POST['buyer_email']
    );

    $shipment_type = mysqli_real_escape_string(
        $conn,
        $_POST['shipment_type']
    );

    mysqli_query(
        $conn,
        "UPDATE shipments
         SET
            buyer_name='$buyer_name',
            buyer_email='$buyer_email',
            shipment_type='$shipment_type'
         WHERE id='$id'"
    );

    header("Location: index.php");
    exit;
}

include '../../includes/layout-top.php';

?>
    <h2>Edit Shipment</h2>

    <hr>

    <form method="POST">

        <div class="mb-3">

            <label>Buyer Name</label>

            <input
                type="text"
                name="buyer_name"
                class="form-control"
                value="<?= $shipment['buyer_name']; ?>"
                required>

        </div>

        <div class="mb-3">

            <label>Buyer Email</label>

            <input
                type="email"
                name="buyer_email"
                class="form-control"
                value="<?= $shipment['buyer_email']; ?>">

        </div>

        <div class="mb-3">

            <label>Shipment Type</label>

            <select
                name="shipment_type"
                class="form-select"
                required>

                <option value="personal"
                    <?= $shipment['shipment_type'] == 'personal' ? 'selected' : ''; ?>>
                    Personal
                </option>

                <option value="consolidation"
                    <?= $shipment['shipment_type'] == 'consolidation' ? 'selected' : ''; ?>>
                    Consolidation
                </option>

                <option value="reseller"
                    <?= $shipment['shipment_type'] == 'reseller' ? 'selected' : ''; ?>>
                    Reseller
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="update"
            class="btn btn-primary">

            Update Shipment

        </button>

        <a
            href="index.php"
            class="btn btn-secondary">

            Cancel

        </a>

    </form>

<?php include '../../includes/layout-bottom.php'; ?>