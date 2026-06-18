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
     FROM consolidations
     WHERE seller_id='$user_id'
     ORDER BY id DESC"
);

include '../../includes/layout-top.php';

?>

<div class="d-flex justify-content-between mb-3">

    <h2>Consolidations</h2>

    <a
        href="create.php"
        class="btn btn-primary">

        Create Consolidation

    </a>

</div>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>ID</th>
            <th>Consolidation Number</th>
            <th>Status</th>
            <th>Shipment</th>
            <th>Action</th>

        </tr>

    </thead>

    <tbody>

    <?php while($row = mysqli_fetch_assoc($result)) : ?>

        <tr>

            <td>

                <?= $row['id']; ?>

            </td>

            <td>

                <?= $row['consolidation_number']; ?>

            </td>

            <td>

                <?= $row['status']; ?>

            </td>

            <td>

                <?php if($row['shipment_created']) : ?>

                    <span class="badge bg-success">

                        Created

                    </span>

                <?php else : ?>

                    <span class="badge bg-secondary">

                        Not Created

                    </span>

                <?php endif; ?>

            </td>

            <td>

                <a
                    href="detail.php?id=<?= $row['id']; ?>"
                    class="btn btn-sm btn-info">

                    Detail

                </a>

                <a
                    href="delete.php?id=<?= $row['id']; ?>"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Delete this consolidation?')">

                    Delete

                </a>

            </td>

        </tr>

    <?php endwhile; ?>

    </tbody>

</table>

<?php include '../../includes/layout-bottom.php'; ?>