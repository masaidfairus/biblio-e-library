<?php
include("../../database/database.php");

function new_category($data)
{
    global $conn;

    $name = $data['name'];
    $description = $data['description'];

    $query = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
            alert('Successfully create new category');
            window.location.replace('dashboard.php');
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn); // Display or log the error
    }
}

function new_book($data)
{
    global $conn; // Make sure the database connection is accessible

    // Sanitize form inputs
    $title = htmlspecialchars($data['title']);
    $author = htmlspecialchars($data['author']);
    $year = (int) $data['year'];
    $category_id = (int) $data['category_id'];

    // Handle the file upload
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        // Define the upload directory
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Get file information
        $fileTmpPath = $_FILES['cover_image']['tmp_name'];
        $fileName = basename($_FILES['cover_image']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $newFileName;

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Invalid file type. Allowed types: " . implode(", ", $allowedExtensions));
        }

        // Move file to the upload directory
        if (!move_uploaded_file($fileTmpPath, $uploadPath)) {
            die("Failed to upload the file.");
        }
    } else {
        die("No file uploaded or there was an error.");
    }

    // Insert book data into the database
    $sql = "INSERT INTO books (title, author, publication_year, category_id, cover_image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $title, $author, $year, $category_id, $uploadPath);

    if ($stmt->execute()) {
        echo "<script>
            alert('Success adding book');
        </script>";
    } else {
        echo "Error adding book: " . $stmt->error;
    }

    $stmt->close();
}

function delete_book($data)
{
    global $conn;

    $book_id = (int) $data['id'];

    // Step 1: Fetch the file name of the book's cover image
    $query = "SELECT cover_image FROM books WHERE id = $book_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
        $old_image = $book['cover_image'];

        // Step 2: Delete the file if it exists
        $file_path = "uploads/" . $old_image;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Step 3: Delete the database record
        $delete_query = "DELETE FROM books WHERE id = $book_id";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            echo "<script>
                alert('Successfully deleted book');
                window.location.replace('dashboard.php');
            </script>";
        } else {
            echo "Error deleting book from database: " . mysqli_error($conn);
        }
    } else {
        echo "Book not found or already deleted.";
    }
}


function delete_category($data)
{
    global $conn;

    $category_id = (int) $data['id'];

    $query = "DELETE FROM categories WHERE id = $category_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
            alert('Successfully deleted category');
            window.location.replace('dashboard.php');
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn); // Display or log the error
    }
}

function update_category($data)
{
    global $conn;

    $category_id = (int) $data['id'];
    $name = $data['name'];
    $description = $data['description'];

    $query = "UPDATE categories SET name = '$name', description = '$description' WHERE id = $category_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
            alert('Successfully updated category');
            window.location.replace('dashboard.php');
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn); // Display or log the error
    }
}

function update_book($data) {
    global $conn;

    $id = (int) $data['id'];
    $title = mysqli_real_escape_string($conn, $data['title']);
    $author = mysqli_real_escape_string($conn, $data['author']);
    $year = (int) $data['year'];
    $category_id = (int) $data['category_id'];

    // Memeriksa apakah ada file gambar baru
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        // Gambar baru diunggah
        $new_image = $_FILES['cover_image']['name'];
        $file_tmp = $_FILES['cover_image']['tmp_name'];

        // Ekstensi file
        $file_extension = pathinfo($new_image, PATHINFO_EXTENSION);

        // Nama file unik
        $unique_filename = uniqid() . '.' . $file_extension;
        $target_file = "uploads/" . $unique_filename;

        // Upload file
        if (move_uploaded_file($file_tmp, $target_file)) {
            // Jika ada file lama, hapus
            if ($data['cover_image'] && file_exists($data['cover_image'])) {
                unlink($data['cover_image']);
            }
            // Simpan nama file baru untuk di database
            $cover_image = $target_file;
        } else {
            return "Error uploading the file.";
        }
    } else {
        // Jika tidak ada file baru, gunakan gambar lama
        $cover_image = $data['image_old'];  // Menggunakan gambar lama jika tidak ada gambar baru
    }

    // Query untuk update data
    $query = "UPDATE books SET 
                title = ?, 
                author = ?, 
                publication_year = ?, 
                category_id = ?, 
                cover_image = ? 
              WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssissi', $title, $author, $year, $category_id, $cover_image, $id);

    if ($stmt->execute()) {
        return "Book updated successfully!";
    } else {
        return "Error updating book: " . $stmt->error;
    }
}
