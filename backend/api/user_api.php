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
        // Parse multipart form data for PUT request
        $_PUT = [];
        $boundary = null;

        // Get content type and extract boundary
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (preg_match('/boundary=(.*)$/', $contentType, $matches)) {
            $boundary = $matches[1];

            // Read raw input
            $rawData = file_get_contents('php://input');

            // Split the data into parts
            $parts = array_slice(explode('--' . $boundary, $rawData), 1, -1);

            foreach ($parts as $part) {
                if (empty(trim($part))) continue;

                // Parse headers and content
                list($rawHeaders, $content) = explode("\r\n\r\n", $part, 2);

                // Remove trailing CRLF
                $content = substr($content, 0, -2);

                // Parse Content-Disposition header
                if (preg_match('/name="([^"]*)"/', $rawHeaders, $nameMatch)) {
                    $name = $nameMatch[1];

                    // Check if it's a file upload
                    if (preg_match('/filename="([^"]*)"/', $rawHeaders, $fileMatch)) {
                        $filename = $fileMatch[1];
                        if (!empty($filename)) {
                            // Handle file upload
                            $tempFile = tempnam(sys_get_temp_dir(), 'php');
                            file_put_contents($tempFile, $content);

                            $_FILES[$name] = [
                                'name' => $filename,
                                'type' => 'image/' . pathinfo($filename, PATHINFO_EXTENSION),
                                'tmp_name' => $tempFile,
                                'error' => UPLOAD_ERR_OK,
                                'size' => strlen($content)
                            ];
                        }
                    } else {
                        // Regular form field
                        $_PUT[$name] = $content;
                    }
                }
            }
        }

        // Get form data from PUT request
        $id = $_PUT['id'] ?? null;
        $first_name = $_PUT['first_name'] ?? null;
        $last_name = $_PUT['last_name'] ?? null;
        $middle_initial = $_PUT['middle_initial'] ?? '';
        $job_title = $_PUT['job_title'] ?? '';
        $email = $_PUT['email'] ?? null;
        $phone = $_PUT['phone'] ?? '';
        $location = $_PUT['location'] ?? '';
        $bio = $_PUT['bio'] ?? '';
        $linkedin_url = $_PUT['linkedin_url'] ?? '';
        $github_url = $_PUT['github_url'] ?? '';
        $portfolio_url = $_PUT['portfolio_url'] ?? '';

        if (!$id || !$first_name || !$last_name || !$email) {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Required fields missing", "debug" => $_PUT]);
            break;
        }

        $profile_image = null;

        // Handle profile image upload
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../../frontend/src/imgs/profile/";

            // Create directory if it doesn't exist
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $imageFileType = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
            $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'webp');

            if (in_array($imageFileType, $allowed_types)) {
                // Generate unique filename
                $profile_image = uniqid() . '.' . $imageFileType;
                $target_file = $target_dir . $profile_image;

                // For PUT requests, use copy instead of move_uploaded_file
                if ($method === 'PUT') {
                    if (!copy($_FILES["profile_image"]["tmp_name"], $target_file)) {
                        http_response_code(500);
                        echo json_encode(["success" => false, "message" => "Failed to upload image"]);
                        break;
                    }
                    // Clean up temp file
                    @unlink($_FILES["profile_image"]["tmp_name"]);
                } else {
                    if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                        http_response_code(500);
                        echo json_encode(["success" => false, "message" => "Failed to upload image"]);
                        break;
                    }
                }
            } else {
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "Invalid file type. Only JPG, JPEG, PNG, GIF & WEBP files are allowed."]);
                break;
            }
        }

        if ($user->updateProfile($id, $first_name, $last_name, $middle_initial, $job_title, $email, $phone, $location, $bio, $linkedin_url, $github_url, $portfolio_url, $profile_image)) {
            echo json_encode(["success" => true, "message" => "Profile updated successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Failed to update profile"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}
