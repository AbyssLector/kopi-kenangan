<?php
include '../config/db.php';
session_start();
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $notelp = $conn->real_escape_string($_POST['notelp']);
    $confirmpassword = $conn->real_escape_string($_POST['confirmpassword']);
    $password = $conn->real_escape_string($_POST['password']);
    // $password = md5($_POST['password']);
    if (is_numeric($notelp) != 1) {
        $_SESSION['msg'] = "<script>alert('Nomor telpon tidak valid')</script>";
        header("Location: http://localhost/kopi-kenangan/register.php");
        exit();
    } else if (!$username || !$notelp || !$confirmpassword || !$password) {
        $_SESSION['msg'] = "<script>alert('Parameter belum terisi dengan lengkap')</script>";
        header("Location: http://localhost/kopi-kenangan/register.php");
        exit();
    } else if (strcmp($password, $confirmpassword)) {
        $_SESSION['msg'] = "<script>alert('Password dan konfirmasi tidak sama')</script>";
        header("Location: http://localhost/kopi-kenangan/register.php");
        exit();
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username,notelp,password) VALUES ('$username','$notelp','$password')";
        if ($conn->query($sql)) {
            header("Location: login.php");
            exit();
        } else {
            echo "<script>alert('Server Error')</script>";
        }
    }
}
