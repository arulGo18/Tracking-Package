<?php

include '../config/database.php';

session_start();

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT *
         FROM dropshippers
         WHERE email='$email'"
    );

    if (mysqli_num_rows($query) > 0) {

        $dropshipper = mysqli_fetch_assoc($query);

        if (
            password_verify(
                $password,
                $dropshipper['password']
            )
        ) {

            $_SESSION['dropshipper_id']
                = $dropshipper['id'];

            $_SESSION['dropshipper_name']
                = $dropshipper['full_name'];

            header(
                "Location: dashboard.php"
            );

            exit;
        }
    }

    $error = "Invalid email or password!";
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Login Dropshipper</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card">

                <div class="card-header">

                    <h3>
                        Login Dropshipper
                    </h3>

                </div>

                <div class="card-body">

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
                            class="btn btn-success w-100">

                            Login

                        </button>

                    </form>

                    <hr>

                    <a
                        href="register.php"
                        class="btn btn-outline-secondary w-100">

                        Create Account

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>