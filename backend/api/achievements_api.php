<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "./Database.php";
include "../class/Achievements.class.php";

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["message" => "Database connection failed"]);
    exit();
}

$achievements = new Achievements($db);
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        if (isset($_GET["user_id"])) {
            echo json_encode($achievements->getAchievementsByUser($_GET["user_id"]));
        } else {
            echo json_encode(["message" => "Missing user_id"]);
        }
        break;

    case "POST":
        $upload_dir = "../../frontend/src/imgs/achievements/";
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $image = null;
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $file_name = time() . "_" . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $file_name);
            $image = $file_name;
        }

        $data = [
            "user_id" => $_POST["user_id"] ?? null,
            "title" => $_POST["title"] ?? null,
            "description" => $_POST["description"] ?? "",
            "category" => $_POST["category"] ?? "General",
            "issuer" => $_POST["issuer"] ?? null,
            "date_achieved" => $_POST["date_achieved"] ?? null,
            "image" => $image,
            "display_order" => $_POST["display_order"] ?? 0
        ];

        if (!$data["user_id"] || !$data["title"]) {
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }

        echo json_encode(["message" => $achievements->createAchievement($data)
            ? "Achievement added successfully"
            : "Failed to add achievement"]);
        break;

    case "PUT":
        $input = json_decode(file_get_contents("php://input"), true);
        echo json_encode(["message" => $achievements->updateAchievement($input)
            ? "Achievement updated successfully"
            : "Failed to update achievement"]);
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(["message" => $achievements->deleteAchievement($data["id"])
            ? "Achievement deleted successfully"
            : "Failed to delete achievement"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
