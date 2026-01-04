<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "./Database.php";
include "../class/User.class.php";

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["message" => "Database connection failed"]);
    exit();
}

$user = new User($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        if (isset($_GET["id"])) {
            $userData = $user->getUserById($_GET["id"]);
            echo json_encode($userData);
        } else {
            $allUsers = $user->getAllUsers();
            echo json_encode($allUsers);
        }
        break;

    case "PUT":

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
