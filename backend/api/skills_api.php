<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "./Database.php";
include "../class/Skills.class.php";

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["message" => "Database connection failed"]);
    exit();
}

$skills = new Skills($db);
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        if (isset($_GET["user_id"])) {
            echo json_encode($skills->getSkillsByUser($_GET["user_id"]));
        } else {
            echo json_encode(["message" => "Missing user_id"]);
        }
        break;

    case "POST":
        $upload_dir = "../../frontend/src/imgs/skills/";
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $icon = null;
        if (isset($_FILES["icon"]) && $_FILES["icon"]["error"] === UPLOAD_ERR_OK) {
            $file_name = time() . "_" . basename($_FILES["icon"]["name"]);
            move_uploaded_file($_FILES["icon"]["tmp_name"], $upload_dir . $file_name);
            $icon = $file_name;
        }

        $data = [
            "user_id" => $_POST["user_id"] ?? null,
            "skill_name" => $_POST["skill_name"] ?? null,
            "skill_type" => $_POST["skill_type"] ?? "technical",
            "category" => $_POST["category"] ?? "",
            "proficiency" => $_POST["proficiency"] ?? 50,
            "years_experience" => $_POST["years_experience"] ?? null,
            "description" => $_POST["description"] ?? "",
            "icon" => $icon
        ];

        if (!$data["user_id"] || !$data["skill_name"]) {
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }

        echo json_encode(["message" => $skills->createSkill($data)
            ? "Skill added successfully"
            : "Failed to add skill"]);
        break;

    case "PUT":
        $input = json_decode(file_get_contents("php://input"), true);
        echo json_encode(["message" => $skills->updateSkill($input)
            ? "Skill updated successfully"
            : "Failed to update skill"]);
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(["message" => $skills->deleteSkill($data["id"])
            ? "Skill deleted successfully"
            : "Failed to delete skill"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
