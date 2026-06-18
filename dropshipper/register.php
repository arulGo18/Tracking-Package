<?php

include '../config/database.php';

if (isset($_POST['register'])) {

    $full_name = mysqli_real_escape_string(
        $conn,
        $_POST['full_name']
    );

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $query = "
        INSERT INTO dropshippers
        (
            full_name,
            email,
            password
        )
        VALUES
        (
            '$full_name',
            '$email',
            '$password'
        )
    ";

    if (mysqli_query($conn, $query)) {

        $success = "Dropshipper registration successful!";

    } else {

        $error = mysqli_error($conn);

    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Register Dropshipper</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">

                    <h3>
                        Register Dropshipper
                    </h3>

                </div>

                <div class="card-body">

                    <?php if(isset($success)) : ?>

                        <div class="alert alert-success">

                            <?= $success ?>

                        </div>

                    <?php endif; ?>

                    <?php if(isset($error)) : ?>

                        <div class="alert alert-danger">

                            <?= $error ?>

                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label>Full Name</label>

                            <input
                                type="text"
                                name="full_name"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button
                            type="submit"
                            name="register"
                            class="btn btn-success w-100">

                            Register Dropshipper

                        </button>

                    </form>

                    <hr>

                    <a
                        href="login.php"
                        class="btn btn-outline-secondary w-100">

                        Already Have Account?

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>