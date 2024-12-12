<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tokoberkah";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getBaseUrl($page = "") {
    $currentPath = $_SERVER['PHP_SELF'];
    $pathInfo = pathinfo($currentPath);
    $hostName = $_SERVER['HTTP_HOST'];
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
    return $protocol . '://' . $hostName . $pathInfo['dirname'] . "/" . $page;
}

function jsonResponse($code, $msg, $data = null) {
    http_response_code($code);
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
    );
    header('Status: ' . $status[$code]);
    $res["success"] = $code == 200;
    $res["message"] = "$msg";
    if ($data != null) {
        $res["data"] = $data;
    }
    echo json_encode($res);
}

?>