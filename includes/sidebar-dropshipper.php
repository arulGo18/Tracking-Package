<?php

$current_page = $_SERVER['PHP_SELF'];

?>

<div class="bg-dark text-white p-3 vh-100">

    <h4 class="mb-4">

        Dropshipping

    </h4>

    <div class="d-grid gap-2">

        <a
            href="/dropshipper/dashboard.php"
            class="btn <?= strpos($current_page, 'dashboard.php') !== false
            ? 'btn-light'
            : 'btn-outline-light'; ?>">

            Dashboard

        </a>

        <a
            href="/dropshipper/order/index.php"
            class="btn <?= strpos($current_page, '/order/') !== false
            ? 'btn-light'
            : 'btn-outline-light'; ?>">

            My Orders

        </a>

        <hr>

        <a
            href="/seller/dashboard.php"
            class="btn btn-warning">

            Seller Dashboard

        </a>

    </div>

</div>