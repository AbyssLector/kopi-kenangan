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
            $url = 'http://localhost:3000/api/users';

            //The data you want to send via POST
            $fields = [
                'phone' => $row['notelp'],
                'password' => $password,
            ];

            //url-ify the data for the POST
            $fields_string = json_encode($fields);
            // echo $fields_string;

            //open connection
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            $result = curl_exec($ch);
            $result = json_decode($result);

            //execute post
            $_SESSION['username'] = $row['username'];
            $_SESSION['notelp'] = $row['notelp'];
            $_SESSION['jwt'] = $result->token;
            header("Location: http://localhost/kopi-kenangan/home.php");
            exit();
        } else {
            $_SESSION['msg'] = "<script>alert('Password anda salah!')</script>";
            // echo "<script>alert('Password anda salah!')</script>";
            header("Location: http://localhost/kopi-kenangan/login.php");
            exit();
        }
    } else {
        $_SESSION['msg'] = "<script>alert('Nomor telepon belum terdaftar, silahkan daftar terlebih dahulu')</script>";
        header("Location: http://localhost/kopi-kenangan/login.php");
        exit();
    }
}
