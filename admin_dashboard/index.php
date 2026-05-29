<?php
session_start();

// If not logged in or role isn't admin, kick them back to login page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php?error=unauthorized");
    exit();
}

require_once '../config/db.php';


?>

<!-- create dashboard content to include a header. header to include admin image and name and a h1 to say project zeron use CSS styles.css as your external stylesheet -->

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <header class="dashboard">
        
        <h3>  <?php //get message and echo it if it exists safely using htmlspecialchars
                $message = $_GET['message'] ?? '';
                if ($message) {
                    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
                    echo $safeMessage;
                }
                ?></h3>
        <div class="flexed-header">
            <button id="logout" class="dash-button" >Logout</button>
            <div class="logo">
                <img src="../user_profiles/test_upload.jpg" alt="Logo" width="60">
               
            </div>
        </div>

    </header>
    <!-- create a navigation bar with buttons for dashboard, user management, bundle management. -->
    <div class="admin-container">
    <nav class="block_style">
       <button id="dashboard" class="nav-button">Dashboard</button><br>
       <button id="user-management" class="nav-button">User Management</button><br>
       <button id="bundle-management" class="nav-button">Bundle Management</button><br>
        </nav>
    <main class="admin-main-content" id="main-content">
        <h1>Welcome to the Admin Dashboard</h1>
        
    </main>
    </div>

    <script src="./js/modules/main.js" type="module"></script>
</body>
</html>