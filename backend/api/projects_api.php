<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "./Database.php";
include "../class/Projects.class.php";

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["message" => "Database connection failed"]);
    exit();
}

$projects = new Projects($db);
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        if (isset($_GET["user_id"])) {
            echo json_encode($projects->getProjectsByUser($_GET["user_id"]));
        } else {
            echo json_encode(["message" => "Missing user_id"]);
        }
        break;

    case "POST":
        $upload_dir = "../../frontend/src/imgs/projects/";
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $image_preview = null;
        if (isset($_FILES["image_preview"]) && $_FILES["image_preview"]["error"] === UPLOAD_ERR_OK) {
            $file_name = time() . "_" . basename($_FILES["image_preview"]["name"]);
            move_uploaded_file($_FILES["image_preview"]["tmp_name"], $upload_dir . $file_name);
            $image_preview = $file_name;
        }

        $data = [
            "user_id" => $_POST["user_id"] ?? null,
            "title" => $_POST["title"] ?? null,
            "description" => $_POST["description"] ?? null,
            "project_url" => $_POST["project_url"] ?? null,
            "github_url" => $_POST["github_url"] ?? null,
            "demo_url" => $_POST["demo_url"] ?? null,
            "image_preview" => $image_preview,
            "tags" => $_POST["tags"] ?? "",
            "start_date" => $_POST["start_date"] ?? null,
            "end_date" => $_POST["end_date"] ?? null,
            "status" => $_POST["status"] ?? "completed",
            "featured" => isset($_POST["featured"]) ? (int)$_POST["featured"] : 0,
            "display_order" => $_POST["display_order"] ?? 0
        ];

        if (!$data["user_id"] || !$data["title"] || !$data["description"]) {
            echo json_encode(["success" => false, "message" => "Missing required fields"]);
            exit();
        }

        $result = $projects->createProject($data);
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Project added successfully" : "Failed to add project"
        ]);
        break;

    case "PUT":
        $input = json_decode(file_get_contents("php://input"), true);
        $result = $projects->updateProject($input);
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Project updated successfully" : "Failed to update project"
        ]);
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $data);
        $result = $projects->deleteProject($data["id"]);
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Project deleted successfully" : "Failed to delete project"
        ]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
