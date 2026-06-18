<?php

include '../config/database.php';
include '../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$total_shipment = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM shipments
         WHERE seller_id='$user_id'"
    )
);

$supplier_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM suppliers
         WHERE seller_id='$user_id'"
    )
);

$incoming_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM incoming_shipments
         WHERE seller_id='$user_id'"
    )
);

$consolidation_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM consolidations
         WHERE seller_id='$user_id'"
    )
);

$created_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM shipments
         WHERE seller_id='$user_id'
         AND status='Created'"
    )
);

$transit_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM shipments
         WHERE seller_id='$user_id'
         AND status='In Transit'"
    )
);

$delivered_count = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM shipments
         WHERE seller_id='$user_id'
         AND status='Delivered'"
    )
);

include '../includes/layout-top.php';

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2>Dashboard</h2>

        <p class="text-muted mb-0">
            Welcome,
            <strong><?= $_SESSION['user_name']; ?></strong>
        </p>

    </div>

</div>

<div class="row g-3">

    <div class="col-md-3">

        <div
            class="card shadow-sm border-0"
            style="
                border-left:5px solid #198754 !important;
            ">

            <div class="card-body text-center">

                <h6 class="text-muted">
                    <i class="bi bi-building text-success"></i>
                    Total Suppliers
                </h6>

                <h1 class="fw-bold text-success">
                    <?= $supplier_count['total']; ?>
                </h1>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div
            class="card shadow-sm border-0"
            style="
                border-left:5px solid #198754 !important;
        ">

            <div class="card-body text-center">

                <h6 class="text-muted">
                    <i class="bi bi-box-arrow-in-down text-success"></i>
                    Incoming Shipments
                </h6>

                <h1 class="fw-bold text-success">
                    <?= $incoming_count['total']; ?>
                </h1>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div
            class="card shadow-sm border-0"
            style="
            border-left:5px solid #198754 !important;
        ">

            <div class="card-body text-center">

                <h6 class="text-muted">
                    <i class="bi bi-boxes text-success"></i>
                    Consolidations
                </h6>

                <h1 class="fw-bold text-success">
                    <?= $consolidation_count['total']; ?>
                </h1>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div
            class="card shadow-sm border-0"
            style="
                border-left:5px solid #198754 !important;
        ">

            <div class="card-body text-center">

                <h6 class="text-muted">
                    <i class="bi bi-truck text-success"></i>

                    Total Shipments
                </h6>

                <h1 class="fw-bold text-success">
                    <?= $total_shipment['total']; ?>
                </h1>

            </div>

        </div>

    </div>

</div>

<hr class="my-4">

<h4 class="mb-3">
    Shipment Status
</h4>

<div class="row g-3">

    <div class="col-md-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <h6>Created</h6>

                <h2>
                    <?= $created_count['total']; ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <h6>In Transit</h6>

                <h2>
                    <?= $transit_count['total']; ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <h6>Delivered</h6>

                <h2>
                    <?= $delivered_count['total']; ?>
                </h2>

            </div>

        </div>

    </div>

</div>

<hr class="my-4">

<h4 class="mb-3">
    Quick Access
</h4>

<div class="d-flex flex-wrap gap-2">

    <a
        href="supplier/index.php"
        class="btn btn-success">

        Suppliers

    </a>

    <a
        href="incoming/index.php"
        class="btn btn-success">

        Incoming Shipments

    </a>

    <a
        href="consolidation/index.php"
        class="btn btn-success">

        Consolidations

    </a>

    <a
        href="shipment/index.php"
        class="btn btn-success">

        Outgoing Shipments

    </a>

    <a
        href="tracking/create.php"
        class="btn btn-dark">

        Add Tracking

    </a>

</div>

<?php include '../includes/layout-bottom.php'; ?>