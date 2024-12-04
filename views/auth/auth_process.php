<?php
include("../../database/database.php");
$alert = 0;

function register($request)
{
    global $conn;
    global $alert;
    // AMBIL EMAIL LALU SIMPAN DI VARIABLE
    $email = strtolower(trim($request['email']));
    $name = $request['name'];

    // CEK APAKAH EMAIL SUDAH SESAUAI DENGAN FORMAT
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alert = 1;
        return;
    }

    // CEK APAKAH EMAIL SUDAH ADA DI DATABASE
    $resultCheckEmail = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    if (mysqli_num_rows($resultCheckEmail) > 0) {
        $alert = 2;
        return;
    }

    // AMBIL PW LALU SIMPAN DI VARIABLE

    //
    $pw = mysqli_real_escape_string($conn, $request['password']);
    $pw2 = mysqli_real_escape_string($conn, $request['confirm_password']);

    // CEK PW1 === PW2
    if ($pw !== $pw2) {
        $alert = 3;
        return;
    }

    // HASH PW -> Mengacak pw
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $pw2 = mysqli_real_escape_string($conn, $request['confirm_password']); // Keep this as is

    // SIMPAN EMAIL DAN PW
    $result = mysqli_query($conn, "INSERT INTO users(name, email, password) VALUES('$name','$email', '$pw')");

    if ($result) {
        echo "<script>
            alert('Success to make a new account, Please login');
            window.location.replace('login.php');
        </script>";
        $alert = 0;
    } else {
        echo "Error: " . mysqli_error($conn); // Display or log the error
    }
}

function login($request)
{
    global $conn;
    global $alert;

    //AMBIL EMAIL & PW LALU SIMPAN DI VARIABLE
    $email = trim($request['email']);
    $pw = $request['password'];
    $name = $request['name'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    //QUERY EMAIL YANG SAMA DENGAN $email
    if (mysqli_num_rows($result) === 1) {

        //FETCH DATA
        $dataFetch = mysqli_fetch_assoc($result);

        //CEK APAKAH DATA SAMA DENGAN DATBASE
        if (password_verify($pw, $dataFetch['password'])) {

            $alert = 0;
            // SET SESI NAMA UNTUK DIAMBIL DI INDEX.PHP
            $_SESSION['user_id'] = $dataFetch['id'];
            $_SESSION['user_email'] = $dataFetch['email'];
            $_SESSION['name'] = $dataFetch['name'];
            $_SESSION['login'] = true;

            switch ($dataFetch['role']) {
                case 'admin':
                    $_SESSION['role'] = 'admin';
                    $_SESSION['admin'] = true;
                    break;
                case 'user':
                    $_SESSION['role'] = 'user';
                    $_SESSION['user'] = true;
                    break;
                default:
                    $_SESSION['role'] = 'guest';
                    $_SESSION['guest'] = true;
                    break;
            }
            header('location: ../../index.php');
            exit;
        } else {
            $alert = 1;
            return;
        }
    } else {
        $alert = 2;
        return;
    }
}