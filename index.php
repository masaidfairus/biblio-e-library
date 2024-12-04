<?php

session_start();

// REDIRECT USER YANG BELUM LOGIN KE LOGIN.php
if (!isset($_SESSION['login'])) {
    header('location: ./views/auth/login.php');
    exit;
}

if (isset($_SESSION['admin'])) {
    header('location: ./views/admin/dashboard.php');
    exit;
}

if (isset($_SESSION['user'])) {
    header('location: ./views/user/home.php');
    exit;
}