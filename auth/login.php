<?php

include '../config/database.php';
include '../config/session.php';

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = $_POST['password'];

    $query = "
        SELECT *
        FROM users
        WHERE email='$email'
    ";

    $result = mysqli_query(
        $conn,
        $query
    );

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        if (
            password_verify(
                $password,
                $user['password']
            )
        ) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            if ($user['role'] == 'seller') {

                header(
                    "Location: ../seller/dashboard.php"
                );

            } else {

                header(
                    "Location: ../dropshipper/dashboard.php"
                );

            }

            exit;
        }
    }

    $error = "Invalid email or password!";
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card">

                <div class="card-header">

                    <h3>
                        Login Seller / Dropshipper
                    </h3>

                </div>

                <div class="card-body">

                    <?php if(isset($_GET['registered'])) : ?>

                        <div class="alert alert-success">

                            Registration successful.
                            Please login.

                        </div>

                    <?php endif; ?>

                    <?php if(isset($error)) : ?>

                        <div class="alert alert-danger">

                            <?= $error ?>

                        </div>

                    <?php endif; ?>

                    <form method="POST">

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
                            name="login"
                            class="btn btn-primary w-100">

                            Login

                        </button>

                    </form>

                    <hr>

                    <div class="text-center">

                        Don't have an account?

                        <a href="register.php">

                            Register Here

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>