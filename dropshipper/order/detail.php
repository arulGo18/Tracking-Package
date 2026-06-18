<?php

include '../../config/database.php';

include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: ../../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {

    die("Order ID Not Found");
}

$id = (int) $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM dropship_orders
     WHERE id='$id'"
);

$order = mysqli_fetch_assoc($query);

if (!$order) {

    die("Order Not Found");
}

$histories = mysqli_query(
    $conn,
    "SELECT *
     FROM dropship_tracking_histories
     WHERE order_id='$id'
     ORDER BY created_at ASC"
);

include '../../includes/layout-dropshipper-top.php';

?>


    <div class="d-flex justify-content-between">

        <h2>Order Detail</h2>

        <a
            href="index.php"
            class="btn btn-secondary">

            Back

        </a>

    </div>

    <hr>

    <table class="table table-bordered">

        <tr>

            <th width="250">
                Supplier
            </th>

            <td>
                <?= $order['supplier_name']; ?>
            </td>

        </tr>

        <tr>

            <th>
                Product
            </th>

            <td>
                <?= $order['product_name']; ?>
            </td>

        </tr>

        <tr>

            <th>
                Customer
            </th>

            <td>
                <?= $order['customer_name']; ?>
            </td>

        </tr>

        <tr>

            <th>
                Country
            </th>

            <td>
                <?= $order['customer_country']; ?>
            </td>

        </tr>

        <tr>

            <th>
                Address
            </th>

            <td>
                <?= nl2br($order['customer_address']); ?>
            </td>

        </tr>

        <tr>

            <th>
                Tracking Number
            </th>

            <td>

                <?= $order['tracking_number']
                    ? $order['tracking_number']
                    : '-'; ?>

            </td>

        </tr>

        <tr>

            <th>
                Status
            </th>

            <td>
                <?= $order['status']; ?>
            </td>

        </tr>

        <tr>

            <th>
                Created At
            </th>

            <td>
                <?= $order['created_at']; ?>
            </td>

        </tr>

    </table>

    <h4 class="mt-4">

        Tracking Timeline

    </h4>

    <table class="table table-striped">
    
        <thead>
    
            <tr>
    
                <th>Date</th>
                <th>Location</th>
                <th>Status</th>
    
            </tr>
    
        </thead>
    
        <tbody>
    
        <?php while($history = mysqli_fetch_assoc($histories)) : ?>
        
            <tr>
        
                <td>
        
                    <?= $history['created_at']; ?>
        
                </td>
        
                <td>
        
                    <?= $history['location']; ?>
        
                </td>
        
                <td>
        
                    <?= $history['status']; ?>
        
                </td>
        
            </tr>
        
        <?php endwhile; ?>
        
        </tbody>
        
    </table>

<?php include '../../includes/layout-dropshipper-bottom.php'; ?>