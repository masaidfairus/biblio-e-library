<?php
session_start();
include("admin_controller.php");

if (isset($_SESSION['user'])) {
    header('location: ../../index.php');
    exit;
}

if (isset($_POST['btn'])) {
    update_category($_POST);
}

$category_id = $_GET['id'];
$query = "SELECT * FROM categories WHERE id = $category_id";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update <?= $data['name'] ?> category - Biblio E-Library</title>

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
                    <a href="dashboard.php" class="nav-link link-dark">Dashboard</a>
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
                            <a href="dashboard.php" class="nav-link link-dark">Dashboard</a>
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
                <h1 class="mb-4">Update <?= $data['name'] ?> Category</h1>
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingCategoryName" placeholder="Category Name"
                            name="name" value="<?= $data['name'] ?>">
                        <label for="floatingCategoryName">Category Name</label>
                    </div>
                    <div class="form-floating mb-5">
                        <textarea class="form-control" placeholder="Category Description" id="floatingDescription"
                            style="height: 200px" name="description"><?= $data['description'] ?></textarea>
                        <label for="floatingDescription">Category Description</label>
                    </div>
                    <button type="submit" class="btn" name="btn">Save category changes</button>
                </form>
            </div>

            <!-- Bootstrap JS Bundle -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</body>

</html>