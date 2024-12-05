<?php
include("../../database/database.php");
include("user_controller.php");

if (isset($_GET['id'])) {
    $book_id = intval($_GET['id']); // Pastikan ID adalah integer untuk menghindari SQL Injection

    // Query untuk mendapatkan data buku beserta nama kategori
    $query = "
        SELECT 
            books.title, 
            books.author, 
            books.cover_image, 
            books.publication_year, 
            books.status, 
            categories.name AS category_name
        FROM books
        LEFT JOIN categories ON books.category_id = categories.id
        WHERE books.id = $book_id
    ";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);

        $title = $book['title'];
        $author = $book['author'];
        $img = $book['cover_image'];
        $book_year = $book['publication_year'];
        $status = $book['status'];
        $category = $book['category_name'];
    } else {
        echo "Buku tidak ditemukan.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Biblio E-Library</title>

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
                    <input type="text" class="form-control form-input" placeholder="Search anybook...">
                    <span class="left-pan"><i class='bx bx-microphone'></i></span>
                </div>
            </div>

            <div class="main p-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <button class="button-back" onclick="window.location.replace('home.php')">
                        <i class='bx bxs-chevron-left fs-2'></i>
                    </button>
                    <h2 class="custom-back">Back to home page</h2>
                </div>
                <div class="row mb-4">
                    <div class="col-md-5 d-flex justify-content-center align-items-center mb-3">
                        <img src="../admin/<?= $img ?>" alt="Library Illustration" class="img-fluid img-thumbnail"
                            style="height: 60vh;">
                    </div>
                    <div class="col-md-7 d-flex justify-content-center flex-column mb-3 pe-5">
                        <p class="fs-4 fw-bold"><?= $author ?></p>
                        <h1 class="book-title"><?= $title ?></h1>
                        <p class="mb-5">Book Category : <?= $category ?> <br>Publication Year : <?= $book_year ?></p>

                        <?php if ($status == 'available'): ?>
                            <form action="" class="w-100">
                                <button type="button" name="loan" class="button w-100" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Borrow Book</button>
                            </form>
                        <?php else: ?>
                            <button class="button button-secondary w-100" disabled>Book Not Available</button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <h2 class="mb-3">Leave us a review</h2>
                    <form action="user_controller.php" method="POST" class="mb-5">
                        <input type="hidden" name="action" value="add_review">

                        <input type="hidden" name="user_id" value="<?= $_SESSION['name'] ?>">

                        <input type="hidden" name="book_id" value="<?= $book_id ?>">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingTitle" placeholder="Title"
                                value="<?= $title ?>" disabled>
                            <label for="floatingTitle">Book Title</label>
                        </div>


                        <div class="form-floating mb-3">
                            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required
                                id="floatingRating" placeholder="Title">
                            <label for="floatingRating">Rate this book (1 - 5)</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea name="comment" id="comment" class="form-control" rows="4" style="height: 200px"
                                placeholder="Write your review here..." required id="floatingComment"></textarea>
                            <label for="floatingComment">Comment</label>
                        </div>

                        <button type="submit" class="button">Submit Review</button>
                    </form>

                    <h2 class="mb-3">Review of the book</h2>
                    <?php
                    
                    // Get the book_id from the URL parameter (GET request)
                    $book_id = $_GET['id'];

                    // Prepare the query to fetch reviews along with user names
                    $query = "  SELECT reviews.comment, reviews.rating, users.name 
                                FROM reviews
                                INNER JOIN users ON reviews.user_id = users.id
                                WHERE reviews.book_id = ?
                            ";

                    // Prepare and execute the query
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('i', $book_id); // Bind the book_id as an integer
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if there are any reviews
                    if ($result->num_rows > 0) {
                        echo '<div class="review-section">';

                        // Loop through and display each review
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="review">';
                            echo '<h4>' . htmlspecialchars($row['name']) . '</h4>'; // User's name
                            echo '<p>' . htmlspecialchars($row['comment']) . '</p>';    // Review comment
                            echo '<small>Rating: ' . htmlspecialchars($row['rating']) . '/5</small>'; // Rating
                            echo '</div><hr>';
                        }

                        echo '</div>';
                    } else {
                        // No reviews available
                        echo '<p>No reviews yet. Be the first to leave a review!</p>';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title fs-5" id="exampleModalLabel">Thank you for borrowing</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Successfully borrowed a <?= $title ?> book</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="user_controller.php" class="w-100" id="delayedForm">
                        <input type="hidden" name="book_id" value="<?= $book_id ?>">
                        <button type="submit" class="button w-100" name="loan" data-bs-dismiss="modal">Okay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</body>

</html>