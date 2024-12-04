<?php
session_start();
include("../../database/database.php");

if (isset($_SESSION['user'])) {
    header('location: ../../index.php');
    exit;
}

$t_books = mysqli_query($conn, "SELECT COUNT(*) AS total FROM books");
$t_categories = mysqli_query($conn, "SELECT COUNT(*) AS total FROM categories");
$t_users = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$t_loans = mysqli_query($conn, "SELECT COUNT(*) AS total FROM loans");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Biblio E-Library</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>
    <!-- Button for Small Screens -->
    <button class="btn d-md-none w-100 rounded-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
        aria-controls="sidebar">
        Toggle Sidebar
    </button>

    <hr class="d-md-none">

    <!-- Sidebar -->
    <div class="offcanvas offcanvas-start bg-light" id="sidebar" tabindex="-1" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h2 id="sidebarLabel">Admin Dashboard</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-3">
                    <a href="dashboard.php" class="nav-link bg-primary-custom text-white"
                        aria-current="page">Dashboard</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="create_category.php" class="nav-link link-dark">Create Category</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="create_book.php" class="nav-link link-dark">Create Book</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="category_list.php" class="nav-link link-dark">Category List</a>
                </li>
                <li class="nav-item">
                    <a href="book_list.php" class="nav-link link-dark">Book List</a>
                </li>
            </ul>
            <hr>
            <a href="../auth/logout.php" class="btn w-100">Sign Out</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar (Visible only on larger screens) -->
            <div class="col-md-3 d-none d-md-block bg-light p-3 sticky-top" style="height: 100vh;">
                <h2>Admin Dashboard</h2>
                <hr>
                <div class="my-auto">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item mb-3">
                            <a href="dashboard.php" class="nav-link bg-primary-custom text-white"
                                aria-current="page">Dashboard</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a href="create_category.php" class="nav-link link-dark">Create Category</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a href="create_book.php" class="nav-link link-dark">Create Book</a>
                        </li>
                        <li class="nav-item mb-3">
                            <a href="category_list.php" class="nav-link link-dark">Category List</a>
                        </li>
                        <li class="nav-item">
                            <a href="book_list.php" class="nav-link link-dark">Book List</a>
                        </li>
                    </ul>
                </div>
                <hr>
                <a href="../auth/logout.php" class="btn w-100">Sign Out</a>

            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-4">
                <h1 class="mb-3">Welcome back! <?php
                $name = $_SESSION['name'];
                echo $name; ?></h1>
                <p class="mb-4">As an administrator, you can manage users, books, categories, and view system analytics. Ensure to
                    keep the platform updated and organized. Use the menu on the left to navigate through the system.
                    Start by checking pending updates or reviewing recent activity logs.</p>



                <div class="row h-75">
                    <div class="col-md-6 card text-center p-3 d-flex justify-content-center">
                        <h2>Total Books</h2>
                        <?php
                        $t_books = mysqli_fetch_assoc($t_books)['total'];
                        echo "<p class='fs-custom'> $t_books </p>"
                            ?>
                    </div>

                    <div class="col-md-6 card text-center p-3 d-flex justify-content-center">
                        <h2>Total Categories</h2>
                        <?php
                        $t_categories = mysqli_fetch_assoc($t_categories)['total'];
                        echo "<p class='fs-custom'> $t_categories </p>"
                            ?>
                    </div>

                    <div class="col-md-6 card text-center p-3 d-flex justify-content-center">
                        <h2>Active Loans</h2>
                        <?php
                        $t_loans = mysqli_fetch_assoc($t_loans)['total'];
                        echo "<p class='fs-custom'> $t_loans </p>"
                            ?>
                    </div>

                    <div class="col-md-6 card text-center p-3 d-flex justify-content-center">
                        <h2>Total Users</h2>
                        <?php
                        $t_users = mysqli_fetch_assoc($t_users)['total'];
                        echo "<p class='fs-custom'> $t_users </p>"
                            ?>
                    </div>
                </div>


            </div>

            <!-- Bootstrap JS Bundle -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</body>

</html>