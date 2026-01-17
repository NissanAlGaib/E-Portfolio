<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "./Database.php";
include "../class/Experience.class.php";

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["message" => "Database connection failed"]);
    exit();
}

$experience = new Experience($db);
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        if (isset($_GET["user_id"])) {
            echo json_encode($experience->getExperienceByUser($_GET["user_id"]));
        } else {
            echo json_encode(["message" => "Missing user_id"]);
        }
        break;

    case "POST":
        $upload_dir = "../../frontend/src/imgs/experience/";
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $company_logo = null;
        if (isset($_FILES["company_logo"]) && $_FILES["company_logo"]["error"] === UPLOAD_ERR_OK) {
            $file_name = time() . "_" . basename($_FILES["company_logo"]["name"]);
            move_uploaded_file($_FILES["company_logo"]["tmp_name"], $upload_dir . $file_name);
            $company_logo = $file_name;
        }

        $data = [
            "user_id" => $_POST["user_id"] ?? null,
            "company_name" => $_POST["company_name"] ?? null,
            "job_title" => $_POST["job_title"] ?? null,
            "location" => $_POST["location"] ?? null,
            "employment_type" => $_POST["employment_type"] ?? "full_time",
            "start_date" => $_POST["start_date"] ?? null,
            "end_date" => $_POST["end_date"] ?? null,
            "description" => $_POST["description"] ?? "",
            "responsibilities" => $_POST["responsibilities"] ?? "",
            "achievements" => $_POST["achievements"] ?? "",
            "company_logo" => $company_logo
        ];

        if (!$data["user_id"] || !$data["company_name"] || !$data["job_title"]) {
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }

        echo json_encode(["message" => $experience->createExperience($data)
            ? "Experience added successfully"
            : "Failed to add experience"]);
        break;

    case "PUT":
        $input = json_decode(file_get_contents("php://input"), true);
        echo json_encode(["message" => $experience->updateExperience($input)
            ? "Experience updated successfully"
            : "Failed to update experience"]);
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(["message" => $experience->deleteExperience($data["id"])
            ? "Experience deleted successfully"
            : "Failed to delete experience"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
