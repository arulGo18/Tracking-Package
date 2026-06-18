<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$seller_id = $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| Ambil Data Consolidation
|--------------------------------------------------------------------------
*/
$consolidations = mysqli_query(
    $conn,
    "SELECT *
     FROM consolidations
     WHERE seller_id='$seller_id'
     ORDER BY id DESC"
);

/*
|--------------------------------------------------------------------------
| Save Shipment
|--------------------------------------------------------------------------
*/
if (isset($_POST['save'])) {

    $tracking_number = "TRK" . time();

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

    $consolidation_id = !empty($_POST['consolidation_id'])
        ? (int) $_POST['consolidation_id']
        : "NULL";

    $status = "Created";

    $query = "
        INSERT INTO shipments
        (
            tracking_number,
            seller_id,
            consolidation_id,
            buyer_name,
            buyer_email,
            shipment_type,
            status
        )
        VALUES
        (
            '$tracking_number',
            '$seller_id',
            $consolidation_id,
            '$buyer_name',
            '$buyer_email',
            '$shipment_type',
            '$status'
        )
    ";

    if (mysqli_query($conn, $query)) {

        $success = "Shipment created successfully!";

    } else {

        $error = mysqli_error($conn);

    }
}

include '../../includes/layout-top.php';

?>

    <h2>Create Shipment</h2>

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

            <label>Consolidation (Optional)</label>

            <select
                name="consolidation_id"
                class="form-select">

                <option value="">
                    No Consolidation
                </option>

                <?php while($con = mysqli_fetch_assoc($consolidations)) : ?>

                    <option value="<?= $con['id']; ?>">

                        <?= $con['consolidation_number']; ?>

                    </option>

                <?php endwhile; ?>

            </select>

        </div>

        <div class="mb-3">

            <label>Buyer Name</label>

            <input
                type="text"
                name="buyer_name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>Buyer Email</label>

            <input
                type="email"
                name="buyer_email"
                class="form-control">

        </div>

        <div class="mb-3">

            <label>Shipment Type</label>

            <select
                name="shipment_type"
                class="form-select"
                required>

                <option value="">
                    Select Type
                </option>

                <option value="personal">
                    Personal
                </option>

                <option value="consolidation">
                    Consolidation
                </option>

                <option value="reseller">
                    Reseller
                </option>

            </select>

        </div>

        <button
            type="submit"
            name="save"
            class="btn btn-primary">

            Save Shipment

        </button>

        <a
            href="index.php"
            class="btn btn-secondary">

            Back

        </a>

    </form>

<?php include '../../includes/layout-bottom.php'; ?>