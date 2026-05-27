
<?php
//get message and echo it if it exists
$message = $_GET['message'] ?? '';

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
        <h3>  <?php //get message and echo it if it exists safely using htmlspecialchars
                if ($message) {
                    $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
                    echo $safeMessage;
                }
                ?></h3>

    </header>
    <main class="admin-main-content">
        <!-- view packages first in flex style -->
        <div class="packages-container">
            <!--create a div with form for adding packages -->
            <div class="add-package-form">
                <h2>Add New Package</h2>
                <form action="../actions/add_package.php" method="POST">
                    <input type="text" name="package_name" placeholder="Package Name" required>
                    <textarea name="package_description" placeholder="Package Description" required></textarea>
                    <input type="number" step="0.01" name="package_price" placeholder="Package Price" required>
                    <button type="submit">Add Package</button>
                </form>
            </div>
            <!-- create a div to view packages -->
            <div class="view-packages">
                <?php include '../packages/index.php' ?>
            </div>
        </div>
    </main>