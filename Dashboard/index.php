<?php
session_start();
//check if logged in from the session if not return back to loggin in page
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';

$sql = "SELECT bundle_id, bundle_name, bundle_description, bundle_price FROM bundles";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../CSS/client.css">
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

    <main>

        <div class="project-title">
                <h1 >PROJECT<br> ZERON</h1>
        </div>

        <div class="module-card">
                <h2>Available Wi-Fi Bundles</h2>
                
                <!-- Reusing your horizontal flex scroll container class -->
                <div class="packages-scroll-container">
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($bundle = mysqli_fetch_assoc($result)): ?>
                            
                            <!-- Reusing the bundle-card element class with your inline data tracking targets -->
                            <div class="bundle-card client-card" 
                                data-id="<?php echo htmlspecialchars($bundle['bundle_id'], ENT_QUOTES, 'UTF-8'); ?>"
                                 data-name="<?php echo htmlspecialchars($bundle['bundle_name'], ENT_QUOTES, 'UTF-8'); ?>" 
                                 data-price="<?php echo htmlspecialchars($bundle['bundle_price'], ENT_QUOTES, 'UTF-8'); ?>">
                                
                                <div class="bundle-header">
                                    <h3><?php echo htmlspecialchars($bundle['bundle_name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                </div>
                                
                                <div class="bundle-body">
                                    <p><?php echo htmlspecialchars($bundle['bundle_description'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                
                                <div class="bundle-footer" style="display: flex; flex-direction: column; gap: 15px;">
                                    <span class="price-tag">KES <?php echo htmlspecialchars($bundle['bundle_price'], ENT_QUOTES, 'UTF-8'); ?></span>
                                    <!-- Added the explicit execution button requested -->
                                    <button class="dash-button buy-action-trigger" style="width: 100%; margin: 0; background: #00ffcc; color: #000; font-weight: bold;">Buy Package</button>
                                </div>
                                
                            </div>

                        <?php endwhile; ?>
                    <?php else: ?>
                        <p style="color: #ccc; padding: 20px;">No active bundles are currently deployed on the system. the system must be offline</p>
                    <?php endif; ?>
                </div>
        </div>
    </main>
    <script src="./modules/main.js" type="module"></script>

</body>
</html>
