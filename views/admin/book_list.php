<?php
session_start();
include("admin_controller.php");

if (isset($_SESSION['user'])) {
    header('location: ../../index.php');
    exit;
}

if (isset($_POST['btn'])) {
    $data = ['id' => $_POST['book_id']]; // Assuming book ID is sent via POST
    delete_book($data);
}

$result = mysqli_query($conn, 'SELECT categories.*, books.* FROM categories JOIN books ON categories.id = books.category_id');
$i = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List - Biblio E-Library</title>

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
                    <a href="create_book.php" class="nav-link link-dark">Create
                        Book</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="category_list.php" class="nav-link link-dark">Category List</a>
                </li>
                <li class="nav-item">
                    <a href="book_list.php" class="nav-link bg-primary-custom text-white" aria-current="page">Book
                        List</a>
                </li>
            </ul>
            <hr>
            <a href="../auth/logout.php" class="btn w-100">Sign Out</a>
        </div>
    </div>

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
                            <a href="book_list.php" class="nav-link bg-primary-custom text-white"
                                aria-current="page">Book List</a>
                        </li>
                    </ul>
                </div>
                <hr>
                <a href="../auth/logout.php" class="btn w-100">Sign Out</a>

            </div>

            <!-- Main Content -->
            <div class="col-md-9 p-4">
                <h1 class="mb-4">Book List</h1>
                <div class="row">
                    <div class="col-md-offset-1 col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col col-sm-5 col-xs-12">
                                        <h4 class="title">All Book Data</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body table-responsive mx-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Book Cover</th>
                                            <th>Book Name</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Publication Year</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($books = mysqli_fetch_assoc($result)) { ?>
                                            <td><?php echo $i ?></td>
                                            <td>
                                                <img src="<?php echo $books['cover_image'] ?>" class="rounded-0 img-cover"
                                                    alt="book_cover">
                                            </td>
                                            <td><?php echo $books['title'] ?></td>
                                            <td><?php echo $books['author'] ?></td>
                                            <td><?php echo $books['name'] ?></td>
                                            <td><?php echo $books['publication_year'] ?></td>
                                            <?php
                                            switch ($books['status']) {
                                                case 'unavailable':
                                                    echo '<td><span class="badge text-bg-danger">' . $books["status"] . '</span></td>';
                                                    break;
                                                case 'available':
                                                    echo '<td><span class="badge text-bg-success">' . $books["status"] . '</span></td>';
                                                    break;
                                                default:
                                                    echo '<td><span class="">Unknown</span></td>';
                                                    break;
                                            }

                                            ?>
                                            <td>
                                                <ul class="action-list">
                                                    <li>
                                                        <form id="myForm" action="" method="POST">
                                                        <input type="hidden" name="book_id" value="<?= $books['id'] ?>">
                                                            <button class="btnn" name="btn" type="submit">
                                                                <i class='bx bx-trash-alt fs-4'></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li><button class="btnn"
                                                            onclick="window.location.href='update_book.php?id=<?php echo $books['id'] ?>'">
                                                            <i class='bx bx-message-square-edit fs-4'></i></button>
                                                    </li>
                                                </ul>
                                            </td>
                                            </tr>
                                            <?php $i++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</body>

</html>