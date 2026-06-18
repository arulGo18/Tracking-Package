<?php

include '../config/database.php';

if (isset($_POST['register'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password, role)
              VALUES ('$name', '$email', '$password', '$role')";

    if (mysqli_query($conn, $query)) {

        header("Location: login.php?registered=1");
        exit;

    } else {

        $error = "Registration failed!";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    <h3>Register Seller / Reseller</h3>
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
                            <label>Name</label>
                            <input
                                type="text"
                                name="name"
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

                        <div class="mb-3">
                            <label>Role</label>

                            <select
                                name="role"
                                class="form-select"
                                required>

                                <option value="">
                                    Select Role
                                </option>

                                <option value="seller">
                                    Seller
                                </option>

                                <option value="reseller">
                                    Reseller
                                </option>

                            </select>
                        </div>

                        <button
                            type="submit"
                            name="register"
                            class="btn btn-primary w-100">

                            Register

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>