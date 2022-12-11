<?php
session_start();
//The url you wish to send the POST request to
$url = 'http://localhost:3000/api/users';
$authorization = "Authorization: Bearer " . $_SESSION['jwt'];
// echo $fields_string;

//open connection
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $authorization));
$result = curl_exec($ch);
$result = json_decode($result);
echo $result->user_balance;
echo number_format($result->user_balance, 2, ',', '.');
