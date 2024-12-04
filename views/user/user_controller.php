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

if (isset($_POST['review'])) {
    $loan_id = $_POST['loan_id'];
    $book_id = $_POST['book_id'];

    // Update status peminjaman
    $query = "UPDATE loans SET status = 'returned' WHERE id = '$loan_id'";
    mysqli_query($conn, $query);

    // Update status buku menjadi tersedia
    $update_query = "UPDATE books SET status = 'available' WHERE id = '$book_id'";
    mysqli_query($conn, $update_query);

    header("Location: booklist.php");
    exit;
}

?>