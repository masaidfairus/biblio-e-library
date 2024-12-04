<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("../../database/database.php");

if (isset($_POST['loan'])) {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id'];

    // Simpan data ke tabel loans
    $query = "INSERT INTO loans (book_id, user_id, status) 
              VALUES ('$book_id', '$user_id', 'borrowed')";
    mysqli_query($conn, $query);

    // Update status buku
    $update_query = "UPDATE books SET status = 'unavailable' WHERE id = '$book_id'";
    mysqli_query($conn, $update_query);

    header("Location: home.php");
    exit;
}

if (isset($_POST['return'])) {
    $loan_id = $_POST['loan_id'];
    $book_id = $_POST['book_id'];

    // Update status peminjaman
    $query = "UPDATE loans SET status = 'returned' WHERE id = '$loan_id'";
    mysqli_query($conn, $query);

    // Update status buku menjadi tersedia
    $update_query = "UPDATE books SET status = 'available' WHERE id = '$book_id'";
    mysqli_query($conn, $update_query);

    echo "<script>
        alert('Successfully returned book');
        window.location.replace('booklist.php');
    </script>";
    exit;
}

function add_review($data)
{
    global $conn;

    // Extract form data
    $user_id = (int) $_SESSION['user_id']; // Or wherever you're getting the user_id from
    $book_id = (int) ($data['book_id']);
    $rating = mysqli_real_escape_string($conn, $data['rating']);
    $comment = mysqli_real_escape_string($conn, $data['comment']);

    // Validate rating
    if ($rating < 1 || $rating > 5) {
        return "<script>
        alert('Please insert a rating 1 - 5');
        </script>";    }

    // SQL query to insert data
    $query = "INSERT INTO reviews (user_id, book_id, rating, comment, created_at) 
              VALUES ('$user_id', '$book_id', '$rating', '$comment', NOW())";

    // Execute query
    if (mysqli_query($conn, $query)) {
        return "<script>
        alert('Reviews added successfully');
        window.location.replace('detail_book.php?id=$book_id');
        </script>";
    } else {
        return "Error: " . mysqli_error($conn);
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_review') {
    $message = add_review($_POST);
    echo $message; // Redirect or display message as needed
}



?>