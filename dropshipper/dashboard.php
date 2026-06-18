<?php

include '../config/session.php';
include '../config/database.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: ../auth/login.php");
    exit;
}

$dropshipper_id = $_SESSION['user_id'];

$total_orders = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM dropship_orders
         WHERE dropshipper_id='$dropshipper_id'"
    )
);

$pending_orders = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM dropship_orders
         WHERE dropshipper_id='$dropshipper_id'
         AND status='Pending'"
    )
);

$transit_orders = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM dropship_orders
         WHERE dropshipper_id='$dropshipper_id'
         AND status='In Transit'"
    )
);

$delivered_orders = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM dropship_orders
         WHERE dropshipper_id='$dropshipper_id'
         AND status='Delivered'"
    )
);

include '../includes/layout-dropshipper-top.php';

?>

<h2>Dropshipping Dashboard</h2>

<hr>

<div class="alert alert-success">

    Welcome,

    <strong>

        <?= $_SESSION['user_name']; ?>

    </strong>

</div>

<div class="row mb-4">

    <div class="col-md-3">

        <div class="card text-center">

            <div class="card-body">

                <h5>Total Orders</h5>

                <h2>

                    <?= $total_orders['total']; ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card text-center">

            <div class="card-body">

                <h5>Pending</h5>

                <h2>

                    <?= $pending_orders['total']; ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card text-center">

            <div class="card-body">

                <h5>In Transit</h5>

                <h2>

                    <?= $transit_orders['total']; ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card text-center">

            <div class="card-body">

                <h5>Delivered</h5>

                <h2>

                    <?= $delivered_orders['total']; ?>

                </h2>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <h5>

                    My Orders

                </h5>

                <p>

                    Lihat semua pesanan Anda

                </p>

                <a
                    href="order/index.php"
                    class="btn btn-primary">

                    View Orders

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card">

            <div class="card-body text-center">

                <h5>

                    Supplier Orders

                </h5>

                <p>

                    Simulasi supplier luar negeri

                </p>

                <a
                    href="supplier/index.php"
                    class="btn btn-success">

                    Open Supplier Panel

                </a>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/layout-dropshipper-bottom.php'; ?>