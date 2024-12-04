<?php
include("auth_process.php");
session_start();

if (isset($_SESSION['login'])) {
    header('location: ../../index.php');
    exit;
}

if (isset($_POST['register'])) {
    register($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Biblio E-Library</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <img src="../../assets/image/biblio_icon_primary.svg" alt="icon" class="rounded mx-auto d-block mb-4"
                    width="15%">
                <h1 class="text-primary-custom text-center mb-4">Register to Biblio</h1>
                <?php
                global $alert;
                switch ($alert) {
                    case 1:
                        echo "<div class='p-3 mb-4 bg-danger bg-opacity-10 border border-danger rounded' id='warningContent'>
                                <span id='incEmail'>Please enter a valid email.</span></div>";
                        break;
                    case 2:
                        echo '<div class="p-3 mb-4 bg-danger bg-opacity-10 border border-danger rounded" id="warningContent">
                                <span id="usedEmail">This email is already in use.</span></div>';
                        break;
                    case 3:
                        echo '<div class="p-3 mb-4 bg-danger bg-opacity-10 border border-danger rounded" id="warningContent">
                                <span id="incPass">Incorrect password.</span></div>';
                        break;
                    default:
                        echo '';
                }
                ?>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="register.php" method="POST">
                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="name" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password"
                                    required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn bg-primary-custom text-white"
                                    name="register">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>

</html>