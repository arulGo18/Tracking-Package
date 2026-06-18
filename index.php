<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="hero py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="display-4 fw-bold">
                    Logistics Tracking Platform
                </h1>

                <p class="lead mt-3">
                    Track shipments easily for buyers and sellers.
                </p>

                <a href="auth/login.php" class="btn btn-primary me-2">
                    Login Seller
                </a>

                <a href="auth/register.php" class="btn btn-outline-primary">
                    Register Seller
                </a>

            </div>

            <div class="col-lg-6">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <h3 class="mb-3">
                            Track Your Package
                        </h3>

                        <form method="GET" action="tracking/result.php">

                            <div class="mb-3">

                                <input
                                    type="text"
                                    name="tracking_number"
                                    class="form-control"
                                    placeholder="Enter Tracking Number"
                                    required>

                            </div>

                            <button
                                type="submit"
                                class="btn btn-success w-100">

                                Track Package

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Sponsored Logistics Partners -->

<section class="py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2>Sponsored Logistics Partners</h2>

            <p>
                Trusted logistics companies supporting our platform
            </p>

        </div>

        <div class="row">

            <div class="col-md-3 mb-3">

                <div class="card shadow-sm h-100">

                    <div class="card-body text-center">

                        <h5>J&T Express</h5>

                        <p class="text-muted">
                            Fast Nationwide Delivery
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="card shadow-sm h-100">

                    <div class="card-body text-center">

                        <h5>SiCepat</h5>

                        <p class="text-muted">
                            Reliable Shipping Service
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="card shadow-sm h-100">

                    <div class="card-body text-center">

                        <h5>AnterAja</h5>

                        <p class="text-muted">
                            Same Day Delivery
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="card shadow-sm h-100">

                    <div class="card-body text-center">

                        <h5>Ninja Xpress</h5>

                        <p class="text-muted">
                            Cross Region Logistics
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Business Statistics -->

<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2>Business Statistics</h2>

            <p>
                Platform growth and logistics performance
            </p>

        </div>

        <div class="row text-center">

            <div class="col-md-3 mb-3">

                <h1 class="fw-bold text-success">
                    1,250+
                </h1>

                <p>
                    Shipments Processed
                </p>

            </div>

            <div class="col-md-3 mb-3">

                <h1 class="fw-bold text-primary">
                    150+
                </h1>

                <p>
                    Active Sellers
                </p>

            </div>

            <div class="col-md-3 mb-3">

                <h1 class="fw-bold text-warning">
                    45+
                </h1>

                <p>
                    Dropshippers
                </p>

            </div>

            <div class="col-md-3 mb-3">

                <h1 class="fw-bold text-danger">
                    12+
                </h1>

                <p>
                    Logistics Partners
                </p>

            </div>

        </div>

    </div>

</section>

<!-- Premium Consolidation Service -->

<section class="py-5 bg-success text-white">

    <div class="container">

        <div class="text-center">

            <h2 class="fw-bold">

                Premium Consolidation Service

            </h2>

            <p class="lead mt-3">

                Reduce shipping costs by combining multiple
                customer orders into a single shipment.

            </p>

        </div>

        <div class="row text-center mt-5">

            <div class="col-md-4 mb-3">

                <h5>

                    ✓ Lower Shipping Costs

                </h5>

                <p>

                    Save logistics expenses through package consolidation.

                </p>

            </div>

            <div class="col-md-4 mb-3">

                <h5>

                    ✓ Easier Package Management

                </h5>

                <p>

                    Manage multiple customer orders in one shipment.

                </p>

            </div>

            <div class="col-md-4 mb-3">

                <h5>

                    ✓ Faster Fulfillment

                </h5>

                <p>

                    Process and dispatch orders more efficiently.

                </p>

            </div>

        </div>

        <div class="text-center mt-4">

            <h1 class="fw-bold">

                Start From Rp 37.000 / Month

            </h1>

            <p>

                Suitable for online sellers, resellers,
                and growing e-commerce businesses.

            </p>

            <a
                href="auth/register.php"
                class="btn btn-light btn-lg">

                Start Using Consolidation

            </a>

        </div>

    </div>

</section>

<!-- Become Partner -->

<section class="py-5">

    <div class="container">

        <div class="card shadow">

            <div class="card-body text-center p-5">

                <h2>
                    Become A Partner
                </h2>

                <p class="lead">

                    Join our logistics ecosystem and
                    expand your business through
                    Tracking Packet Platform.

                </p>

                <a
                    href="auth/register.php"
                    class="btn btn-success btn-lg">

                    Become Partner

                </a>

            </div>

        </div>

    </div>

</section>

<!-- Shipment Types -->

<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2>Shipment Types</h2>

            <p>
                Supported shipment tracking scenarios
            </p>

        </div>

        <div class="row">

            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body">

                        <h4>
                            Personal Shipment
                        </h4>

                        <p>
                            Standard shipment from seller to buyer.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body">

                        <h4>
                            Consolidation
                        </h4>

                        <p>
                            Multiple packages combined into one shipment.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body">

                        <h4>
                            Dropshipper / Reseller
                        </h4>

                        <p>
                            Track shipments from supplier to reseller and customer.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'includes/footer.php'; ?>