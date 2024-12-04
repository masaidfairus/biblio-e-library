<?php
session_start();
include("../../database/database.php");

// RANDOM TAKE DATA + LIMIT UNTIL 5
$result = mysqli_query($conn, "SELECT * FROM books ORDER BY RAND() LIMIT 6");
$name = $_SESSION['name']

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Biblio E-Library</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-accent-custom d-md-none w-100">
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

    <div class="d-flex custom-responsive">
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
                        <i class='bx bx-home-alt-2 fs-2 actives'></i>
                    </a>
                </li>
                <br>
                <li class="nav-item">
                    <a href="booklist.php" class="nav-link text-dark">
                        <i class='bx bx-book-open fs-2 icon'></i>
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
                    <input type="text" class="form-control form-input" placeholder="Search any book...">
                    <span class="left-pan"><i class='bx bx-microphone'></i></span>
                </div>
            </div>

            <div class="main p-4">

                <div class="row mb-5">
                    <div class="col-md-6 d-flex justify-content-center flex-column">
                        <h1 class="book-title">Happy Reading,</h1>
                        <h1 class="mb-3 book-title"><?= $name ?></h1>
                        <p>Welcome to Biblio E-Library, a digital platform where you can find and read books. Enjoy
                            exploring our vast collection of books, and don't forget to share your favorite ones with
                            others.</p>
                    </div>
                    <div class="col-md-6">
                        <img src="../../assets/image/janko-ferlic-sfL_QOnmy00-unsplash.jpg" alt="Library Illustration"
                            class="img rounded">
                    </div>
                </div>

                <!-- Carousel Section -->
                <div id="customCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="../../assets/image/Group-1.png" class="d-block w-100" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="../../assets/image/Group-2.png" class="d-block w-100" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="../../assets/image/Group-3.png" class="d-block w-100" alt="Slide 3">
                        </div>
                        <div class="carousel-item">
                            <img src="../../assets/image/Group-4.png" class="d-block w-100" alt="Slide 4">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#customCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#customCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Most Favorite Books Section -->
                <h2>Most Favorite Books</h2>
                <div class="container mt-4">
                    <div class="row">
                        <?php
                        $count = 0;
                        while ($books = mysqli_fetch_assoc($result)) {
                            if ($count >= 6)
                                break;
                            ?>
                            <div class="col-6 col-md-3 col-lg-2 mb-3">
                                <div class="card h-100" style="cursor: pointer;" onclick="detailBook(<?= $books['id'] ?>)">
                                    <img src="<?php echo "../admin/" . $books['cover_image']; ?>"
                                        class="card-img-top custom-img" alt="<?= $books['title'] ?>">
                                    <div class="card-body">
                                        <h4 class="card-title text-truncate"><?= $books['title'] ?></h4>
                                    </div>
                                </div>
                            </div>
                            <?php $count++;
                        } ?>
                    </div>
                </div>

                <!-- All Books Section -->
                <h2 class="mt-5">All Books</h2>
                <div class="container mt-4">
                    <?php
                    $category_query = mysqli_query($conn, "SELECT * FROM categories");
                    while ($category = mysqli_fetch_assoc($category_query)) {
                        echo "<h3>" . $category['name'] . "</h3>";
                        $book_query = mysqli_query($conn, "SELECT * FROM books WHERE category_id = '" . $category['id'] . "'");
                        if (mysqli_num_rows($book_query) > 0) { ?>
                            <div class="row mb-4">
                                <?php while ($book = mysqli_fetch_assoc($book_query)) { ?>
                                    <div class="col-6 col-md-3 col-lg-2 mb-3">
                                        <div class="card h-100" style="cursor: pointer;" onclick="detailBook(<?= $book['id'] ?>)">
                                            <img src="<?php echo "../admin/" . $book['cover_image']; ?>"
                                                class="card-img-top custom-img" alt="<?= $book['title'] ?>">
                                            <div class="card-body">
                                                <h4 class="card-title text-truncate"><?= $book['title'] ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else {
                            echo "<p>No books available in this category.</p>";
                        }
                    } ?>
                </div>
            </div>
        </div>

        <script>
            function detailBook(bookId) {
                // Redirect ke halaman detail_book.php dengan ID buku
                window.location.href = 'detail_book.php?id=' + bookId;
            }
        </script>
        <script src="../../assets/js/script.js"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</body>

</html>