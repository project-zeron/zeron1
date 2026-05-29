<?php
// admin_dashboard/api/router.php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized access"]);
    exit();
}

require_once '../../config/db.php'; 
require_once 'controllers/UserController.php';
require_once 'controllers/PackageController.php'; // 🔴 ADD THIS

header('Content-Type: application/json');
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'get_users':
        $data = getUsers($conn);
        if ($data !== false) {
            echo json_encode($data);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Query failure"]);
        }
        break;

    // 🔴 ADD THIS NEW CASE FOR PACKAGES:
    case 'get_packages':
        $data = getPackages($conn);
        if ($data !== false) {
            echo json_encode($data);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Query failure"]);
        }
        break;
}
