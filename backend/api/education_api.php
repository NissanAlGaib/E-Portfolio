<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "./Database.php";
include "../class/Education.class.php";

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["message" => "Database connection failed"]);
    exit();
}

$education = new Education($db);
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        if (isset($_GET["user_id"])) {
            echo json_encode($education->getEducationByUser($_GET["user_id"]));
        } else {
            echo json_encode(["message" => "Missing user_id"]);
        }
        break;

    case "POST":
        $upload_dir = "../../frontend/src/imgs/education/";
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $logo = null;
        if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK) {
            $file_name = time() . "_" . basename($_FILES["logo"]["name"]);
            move_uploaded_file($_FILES["logo"]["tmp_name"], $upload_dir . $file_name);
            $logo = $file_name;
        }

        $data = [
            "user_id" => $_POST["user_id"] ?? null,
            "institution_name" => $_POST["institution_name"] ?? null,
            "degree" => $_POST["degree"] ?? null,
            "field_of_study" => $_POST["field_of_study"] ?? null,
            "location" => $_POST["location"] ?? null,
            "start_date" => $_POST["start_date"] ?? null,
            "end_date" => $_POST["end_date"] ?? null,
            "gpa" => $_POST["gpa"] ?? null,
            "description" => $_POST["description"] ?? "",
            "logo" => $logo
        ];

        if (!$data["user_id"] || !$data["institution_name"] || !$data["degree"]) {
            echo json_encode(["success" => false, "message" => "Missing required fields"]);
            exit();
        }

        $result = $education->createEducation($data);
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Education added successfully" : "Failed to add education"
        ]);
        break;

    case "PUT":
        $input = json_decode(file_get_contents("php://input"), true);
        $result = $education->updateEducation($input);
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Education updated successfully" : "Failed to update education"
        ]);
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $data);
        $result = $education->deleteEducation($data["id"]);
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Education deleted successfully" : "Failed to delete education"
        ]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
