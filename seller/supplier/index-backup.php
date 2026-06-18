<?php

include '../../config/database.php';
include '../../config/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query(
    $conn,
    "SELECT *
     FROM suppliers
     WHERE seller_id='$user_id'
     ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Supplier List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">

        <h2>My Suppliers</h2>

        <a
            href="create.php"
            class="btn btn-primary">

            Add Supplier

        </a>

    </div>

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>ID</th>
                <th>Supplier Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Country</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

        <?php while($supplier = mysqli_fetch_assoc($result)) : ?>

            <tr>

                <td><?= $supplier['id']; ?></td>

                <td><?= $supplier['supplier_name']; ?></td>

                <td><?= $supplier['email']; ?></td>

                <td><?= $supplier['phone']; ?></td>

                <td><?= $supplier['country']; ?></td>

                <td>

                    <a
                        href="edit.php?id=<?= $supplier['id']; ?>"
                        class="btn btn-sm btn-warning">
                        
                        Edit
                        
                    </a>
                        
                    <a
                        href="delete.php?id=<?= $supplier['id']; ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete this supplier?')">
                        
                        Delete
                        
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</div>

</body>
</html>