<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="/tracking-packet">
            Tracking Packet
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">

                    <a class="nav-link" href="/tracking-packet">
                        
                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link"
                       href="/tracking-packet/tracking/index.php">

                    

                    </a>

                </li>

                <?php if (!$isLoggedIn) : ?>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="/tracking-packet/auth/login.php">

                        

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="/tracking-packet/auth/register.php">

                            

                        </a>

                    </li>

                <?php else : ?>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="/tracking-packet/seller/dashboard.php">

                            

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="/tracking-packet/seller/shipment/index.php">

                            

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link"
                           href="/tracking-packet/seller/tracking/create.php">

                            

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-warning"
                           href="/tracking-packet/auth/logout.php">

                        

                        </a>

                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>