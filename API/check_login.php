<?php

require_once 'connection.php';

if ($con) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tabel_user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);
    $response = array();

    $row = mysqli_num_rows($result);

    $data = mysqli_fetch_assoc($result);

    $role = $data["role"];

    if ($row > 0) {
        if ($role == "ADMIN") {
            array_push($response, array('role' => 'ADMIN'));
        } else if ($role == "CUSTOMER") {
            array_push($response, array('role' => 'CUSTOMER'));
        }
    } else {
        array_push($response, array('status' => 'FAILED'));
    }
} else {
    array_push($response, array('status' => 'FAILED'));
}

echo json_encode(array("server_response" => $response));
mysqli_close($con);
