<!DOCTYPE html>
<html>
<head>
    <title>Track Package</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-body">

                    <h2 class="mb-4 text-center">
                        Track Your Package
                    </h2>

                    <form method="GET" action="result.php">

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

</body>
</html>