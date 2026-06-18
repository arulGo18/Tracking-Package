<?php

$current_page = $_SERVER['PHP_SELF'];

?>

<div
    class="text-white p-3 vh-100"
    style="background:#146c43;">

    <h4 class="mb-4 fw-bold">

        <i class="bi bi-cpu"></i>
        Simulator

    </h4>

    <p class="text-white-50 small mb-2">

        CUSTOMER

    </p>

    <div class="d-grid gap-2">

        <a
            href="/simulator/dashboard.php"
            class="btn btn-outline-light">

            <i class="bi bi-speedometer2"></i>
            Dashboard

        </a>

        <a
            href="/simulator/customer/create-order.php"
            class="btn btn-outline-light">

            <i class="bi bi-bag"></i>
            Seller Order

        </a>

        <a
            href="/simulator/customer/create-dropship-order.php"
            class="btn btn-outline-light">

            <i class="bi bi-cart"></i>
            Dropship Order

        </a>

    </div>

    <hr class="my-3">

    <p class="text-white-50 small mb-2">

        OPERATION

    </p>

    <div class="d-grid gap-2">

        <a
            href="/simulator/supplier/index.php"
            class="btn btn-outline-light">

            <i class="bi bi-globe2"></i>
            Supplier Simulator

        </a>

        <a
            href="/simulator/logistics/index.php"
            class="btn btn-outline-light">

            <i class="bi bi-truck"></i>
            Logistics Simulator

        </a>

        <a
            href="/simulator/tracking/create.php"
            class="btn btn-outline-light">

            <i class="bi bi-geo-alt"></i>
            Tracking Simulator

        </a>

    </div>

</div>