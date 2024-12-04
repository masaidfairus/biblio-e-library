<?php
session_start();
include("../../database/database.php");

$user_id = $_SESSION['user_id']; // ID user yang sedang login

// Query untuk buku yang sedang dipinjam
$query = "SELECT l.id AS loan_id, b.id AS book_id, b.title, b.author, b.cover_image, l.status 
          FROM loans l
          JOIN books b ON l.book_id = b.id
          WHERE l.user_id = '$user_id' AND l.status = 'borrowed'";
$result = mysqli_query($conn, $query);

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

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-accent-custom d-md-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="../../assets/image/biblio_icon_dark.svg" alt="biblio-icon" width="30">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-4" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booklist.php">Book List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/logout.php">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column bg-accent-custom align-items-center px-2">

            <!-- Logo -->
            <a href="home.php" class="my-3 fs-2">
                <img src="../../assets/image/biblio_icon_dark.svg" alt="biblio-icon" width="40">
            </a>
            <hr class="w-75">
            <!-- Navigation Icons -->
            <ul class="nav flex-column text-center w-100 my-auto">
                <li class="nav-item">
                    <a href="home.php" class="nav-link text-dark">
                        <i class='bx bx-home-alt-2 fs-2 icon'></i>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a href="booklist.php" class="nav-link text-dark">
                        <i class='bx bx-book-open fs-2 actives'></i>
                    </a>
                </li>
            </ul>
            <hr class="w-75">
            <!-- Logout Icon -->
            <a href="../auth/logout.php" class="nav-link text-dark">
                <i class='bx bx-log-out fs-2 logout'></i>
            </a>

            <a class="nav-link text-dark" type="button" id="burger-icon">
                <i class='bx bx-menu-alt-left fs-2 icon'></i>
            </a>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="search_bar bg-accent-custom w-100 p-3">
                <div class="form">
                    <i class='bx bx-search'></i>
                    <input type="text" class="form-control form-input" placeholder="Search anybook...">
                    <span class="left-pan"><i class='bx bx-microphone'></i></span>
                </div>
            </div>

            <div class="man p-4">
                <?php
                // Cek apakah ada buku yang sedang dipinjam
                if (mysqli_num_rows($result) > 0): ?>
                    <h1 class="mb-4">Buku yang Sedang Dipinjam</h1>
                    <div class="book-list">
                        <?php while ($loan = mysqli_fetch_assoc($result)): ?>
                            <div class="book-item d-flex flex-column">
                                <img src="../admin/<?= $loan['cover_image'] ?>" alt="Cover <?= $loan['title'] ?>" class="book-cover">
                                <h3><?= $loan['title'] ?></h3>
                                <p class="mb-auto">Penulis: <?= $loan['author'] ?></p>
                                <form method="POST" action="user_controller.php" class="mt-4">
                                    <input type="hidden" name="loan_id" value="<?= $loan['loan_id'] ?>">
                                    <input type="hidden" name="book_id" value="<?= $loan['book_id'] ?>">
                                    <button type="submit" name="return" class="button bg-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Kembalikan Buku</button>
                                </form>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <h1>Tidak Ada Buku yang Sedang Dipinjam</h1>
                    <p>Anda belum meminjam buku. Silakan pinjam buku dari <a href="home.php">daftar buku tersedia</a>.</p>
                <?php endif; ?>
                    
            </div>
        </div>
    </div>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</body>

</html>