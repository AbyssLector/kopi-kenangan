<?php
include '../config/db.php';
session_start();
error_reporting(0);
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $notelp = $conn->real_escape_string($_POST['notelp']);
    $password = $conn->real_escape_string($_POST['password']);
    // $password = md5($_POST['password']);

    $sql = "SELECT * FROM user WHERE notelp='$notelp'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['notelp'] = $row['notelp'];
            // print_r($_SESSION);
            // die($_SESSION['notelp'] . $_SESSION['username']);
            header("Location: http://localhost/kopi-kenangan/home.php");
            exit();
        } else {
            $_SESSION['msg'] = "<script>alert('Password anda salah!')</script>";
            // echo "<script>alert('Password anda salah!')</script>";
            header("Location: http://localhost/kopi-kenangan/login.php");
        }
    } else {
        echo "<script>alert('Nomor telepon belum terdaftar, silahkan daftar terlebih dahulu')</script>";
    }
}
