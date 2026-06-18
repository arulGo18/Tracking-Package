<?php

$current_page = $_SERVER['PHP_SELF'];

?>

<div
    class="text-white p-3 vh-100"
    style="background:#146c43;">

    <h4 class="mb-4 fw-bold">

        <i class="bi bi-truck"></i>
        Tracking Packet

    </h4>

    <!-- SELLER -->

    <p class="text-white-50 small mb-2">

        SELLER

    </p>

    <div class="d-grid gap-2">

        <a
            href="/seller/dashboard.php"
            class="btn <?= strpos($current_page, 'dashboard.php') !== false
            ? 'btn-light'
            : 'btn-outline-light'; ?>">

            <i class="bi bi-speedometer2"></i>
            Dashboard

        </a>

        <a
            href="/seller/order/index.php"
            class="btn <?= strpos($current_page, '/order/') !== false
            ? 'btn-light'
            : 'btn-outline-light'; ?>">

            <i class="bi bi-bag-check"></i>
            Orders

        </a>

        <a
            href="/seller/shipment/index.php"
            class="btn <?= strpos($current_page, '/shipment/') !== false
            ? 'btn-light'
            : 'btn-outline-light'; ?>">

            <i class="bi bi-truck"></i>
            Outgoing Shipments

        </a>

    </div>

    <!-- WAREHOUSE -->

    <hr class="my-3">

    <p class="text-white-50 small mb-2">

        WAREHOUSE (ADVANCED)

    </p>

    <div class="d-grid gap-2">

        <a
            href="/seller/consolidation/index.php"
            class="btn <?= strpos($current_page, '/consolidation/') !== false
            ? 'btn-light'
            : 'btn-outline-light'; ?>">

            <i class="bi bi-boxes"></i>
            Consolidations

        </a>

    </div>

    <!-- DROPSHIPPING -->

    <hr class="my-3">

    <p class="text-white-50 small mb-2">

        DROPSHIPPING

    </p>

    <div class="d-grid gap-2">

        <a
            href="/dropshipper/order/index.php"
            class="btn <?= strpos($current_page, '/dropshipper/order/') !== false
            ? 'btn-light'
            : 'btn-outline-light'; ?>">

            <i class="bi bi-cart-check"></i>
            My Orders

        </a>

    </div>

    <!-- LOGOUT -->

    <hr class="my-3">

    <div class="d-grid">

        <a
            href="/auth/logout.php"
            class="btn btn-outline-warning">

            <i class="bi bi-box-arrow-right"></i>
            Logout

        </a>

    </div>

</div>