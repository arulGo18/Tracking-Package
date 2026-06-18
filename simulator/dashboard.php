<?php

include '../includes/layout-simulator-top.php';

?>

<h2>Simulator Dashboard</h2>

<hr>

<div class="row">

    <div class="col-md-6 mb-3">

        <div class="card">

            <div class="card-body text-center">

                <h5>

                    Customer Seller Order

                </h5>

                <p>

                    Simulate customer purchasing from seller

                </p>

                <a
                    href="customer/create-order.php"
                    class="btn btn-primary">

                    Open

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-6 mb-3">

        <div class="card">

            <div class="card-body text-center">

                <h5>

                    Customer Dropship Order

                </h5>

                <p>

                    Simulate customer purchasing from dropshipper

                </p>

                <a
                    href="customer/create-dropship-order.php"
                    class="btn btn-success">

                    Open

                </a>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-4 mb-3">

        <div class="card">

            <div class="card-body text-center">

                <h5>

                    Supplier Simulator

                </h5>

                <a
                    href="supplier/index.php"
                    class="btn btn-dark">

                    Open

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card">

            <div class="card-body text-center">

                <h5>

                    Logistics Simulator

                </h5>

                <a
                    href="logistics/index.php"
                    class="btn btn-warning">

                    Open

                </a>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card">

            <div class="card-body text-center">

                <h5>

                    Tracking Simulator

                </h5>

                <a
                    href="tracking/create.php"
                    class="btn btn-info">

                    Open

                </a>

            </div>

        </div>

    </div>

</div>

<?php

include '../includes/layout-simulator-bottom.php';

?>