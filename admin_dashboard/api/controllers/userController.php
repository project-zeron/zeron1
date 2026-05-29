<?php
// admin_dashboard/api/controllers/UserController.php
//get the database connection
require_once '../../config/db.php';

function getUsers($conn) {
    $sql = "SELECT email, created_at FROM users WHERE role = 'user'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    return false;
}
?>