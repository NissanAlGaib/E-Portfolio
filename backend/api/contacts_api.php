<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "./Database.php";
include "../class/Contacts.class.php";

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["message" => "Database connection failed"]);
    exit();
}

$contacts = new Contacts($db);
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        if (isset($_GET["status"])) {
            echo json_encode($contacts->getContactsByStatus($_GET["status"]));
        } else {
            echo json_encode($contacts->getAllContacts());
        }
        break;

    case "POST":
        $data = [
            "name" => $_POST["name"] ?? null,
            "email" => $_POST["email"] ?? null,
            "subject" => $_POST["subject"] ?? "",
            "message" => $_POST["message"] ?? null,
            "status" => $_POST["status"] ?? "new",
            "ip_address" => $_SERVER["REMOTE_ADDR"] ?? null
        ];

        if (!$data["name"] || !$data["email"] || !$data["message"]) {
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }

        echo json_encode(["message" => $contacts->createContact($data)
            ? "Contact message sent successfully"
            : "Failed to send contact message"]);
        break;

    case "PUT":
        $input = json_decode(file_get_contents("php://input"), true);
        if (isset($input["id"]) && isset($input["status"])) {
            echo json_encode(["message" => $contacts->updateContactStatus($input["id"], $input["status"])
                ? "Contact status updated successfully"
                : "Failed to update contact status"]);
        } else {
            echo json_encode(["message" => "Missing required fields"]);
        }
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(["message" => $contacts->deleteContact($data["id"])
            ? "Contact deleted successfully"
            : "Failed to delete contact"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
