<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "./Database.php";
include "../class/Hobbies.class.php";

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["message" => "Database connection failed"]);
    exit();
}

$hobby = new Hobbies($db);
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        if (isset($_GET["user_id"])) {
            echo json_encode($hobby->getHobbiesByUser($_GET["user_id"]));
        } else {
            echo json_encode(["message" => "Missing user_id"]);
        }
        break;

    case "POST":
        $upload_dir = "../../frontend/src/imgs/hobbies/";
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $icon = null;
        if (isset($_FILES["icon"]) && $_FILES["icon"]["error"] === UPLOAD_ERR_OK) {
            $file_name = time() . "_" . basename($_FILES["icon"]["name"]);
            move_uploaded_file($_FILES["icon"]["tmp_name"], $upload_dir . $file_name);
            $icon = $file_name;
        }

        $data = [
            "user_id" => $_POST["user_id"] ?? null,
            "hobby_name" => $_POST["hobby_name"] ?? null,
            "description" => $_POST["description"] ?? "",
            "icon" => $icon,
            "category" => $_POST["category"] ?? "General",
            "proficiency" => $_POST["proficiency"] ?? 75
        ];

        if (!$data["user_id"] || !$data["hobby_name"]) {
            echo json_encode(["success" => false, "message" => "Missing required fields", "data" => $data]);
            exit();
        }

        $result = $hobby->createHobby($data);
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Hobby added successfully" : "Failed to add hobby"
        ]);
        break;

    case "PUT":
        $input = json_decode(file_get_contents("php://input"), true);
        $result = $hobby->updateHobby($input);
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Hobby updated successfully" : "Failed to update hobby"
        ]);
        break;

    case "DELETE":
        // Check if ID is in query parameter first, then in request body
        $id = $_GET["id"] ?? null;

        if (!$id) {
            parse_str(file_get_contents("php://input"), $data);
            $id = $data["id"] ?? null;
        }

        if (!$id) {
            echo json_encode([
                "success" => false,
                "message" => "Missing hobby ID"
            ]);
            exit();
        }

        $result = $hobby->deleteHobby($id);
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Hobby deleted successfully" : "Failed to delete hobby"
        ]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
