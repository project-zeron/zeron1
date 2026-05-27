
<?php
//get message and echo it if it exists
$message = $_GET['message'] ?? '';

if ($message !== '') {

    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    
    echo $safeMessage;

}
?>
<!-- create dashboard content to include a header. header to include admin image and name and a h1 to say project zeron use CSS styles.css as your external stylesheet -->

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>
<body>
    <header class="dashboard">
        <div class="logo">
                <img src="../user_profiles/test_upload.jpg" alt="Logo" width="80">
            </div>
        <h1> Project Zeron</h1>
    </header>
    <main class="admin-main-content">
        <!-- Additional dashboard content can go here -->
    </main>