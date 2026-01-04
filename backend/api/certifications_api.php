<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "./Database.php";
include "../class/Certifications.class.php";

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["message" => "Database connection failed"]);
    exit();
}

$certifications = new Certifications($db);
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        if (isset($_GET["user_id"])) {
            echo json_encode($certifications->getCertificationsByUser($_GET["user_id"]));
        } else {
            echo json_encode(["message" => "Missing user_id"]);
        }
        break;

    case "POST":
        $upload_dir = "../../frontend/src/imgs/certifications/";
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $logo = null;
        if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK) {
            $file_name = time() . "_" . basename($_FILES["logo"]["name"]);
            move_uploaded_file($_FILES["logo"]["tmp_name"], $upload_dir . $file_name);
            $logo = $file_name;
        }

        $data = [
            "user_id" => $_POST["user_id"] ?? null,
            "certification_name" => $_POST["certification_name"] ?? null,
            "issuing_organization" => $_POST["issuing_organization"] ?? null,
            "issue_date" => $_POST["issue_date"] ?? null,
            "expiry_date" => $_POST["expiry_date"] ?? null,
            "credential_id" => $_POST["credential_id"] ?? null,
            "credential_url" => $_POST["credential_url"] ?? null,
            "description" => $_POST["description"] ?? "",
            "logo" => $logo
        ];

        if (!$data["user_id"] || !$data["certification_name"] || !$data["issuing_organization"]) {
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }

        echo json_encode(["message" => $certifications->createCertification($data)
            ? "Certification added successfully"
            : "Failed to add certification"]);
        break;

    case "PUT":
        $input = json_decode(file_get_contents("php://input"), true);
        echo json_encode(["message" => $certifications->updateCertification($input)
            ? "Certification updated successfully"
            : "Failed to update certification"]);
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $data);
        echo json_encode(["message" => $certifications->deleteCertification($data["id"])
            ? "Certification deleted successfully"
            : "Failed to delete certification"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
