<?php
include '../config/db.php';
session_start();

if (strtoupper($_SERVER['REQUEST_METHOD']) == "POST") {
    $post = file_get_contents('php://input');
    $data = json_decode($post);

    $price = $data->{'Kopi Kenangan Mantan'} * 19000;
    $price = $price + $data->{'Kopi Susu'} * 17000;
    $price = $price + $data->{'Kopi Bareng doi'} * 23000;
    $price = $price + $data->{'Kopi Hitam'} * 14000;
    // print_r($data);
    // echo $price;
    //The data you want to send via POST
    $url = 'http://localhost:3000/api/pay';
    $authorization = "Authorization: Bearer " . $_SESSION['jwt'];
    $fields = [
        'amount' => (int)$price,
        'description' => 'payment',
    ];

    // //url-ify the data for the POST
    $fields_string = json_encode($fields);
    // // echo $fields_string;

    //open connection
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $authorization));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
    $result = curl_exec($ch);
    $result = json_decode($result);
    // print_r($result);
    if ($result->status != "200") {
        $msg = [
            "status" => 400,
            "msg" => "Payment error, value must be greater than zero or balance insufficient"
        ];
        echo json_encode($msg);
    } else {
        $sql = "INSERT INTO transaction (notelp,amount,data) VALUES ('" . $_SESSION['notelp'] . "','$price','$post')";
        if ($conn->query($sql)) {
            $_SESSION['success'] = true;
            $msg = [
                "status" => 200,
                "msg" => "Payment Success!"
            ];
            echo json_encode($msg);
        } else {
            $msg = [
                "status" => 400,
                "msg" => "Server Error"
            ];
            echo json_encode($msg);
        }
    }
}
