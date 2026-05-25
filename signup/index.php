<?php
if (isset($_GET['message'])) {
    $message=$_GET['message'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>project zeron</title>
    <link rel="stylesheet" href="../CSS/styles.css">
</head>
<body>
   <header>
            <h1>Project Zeron</h1>
        </header>

   <main>
    <form action="create_account.php" method="post">
       <div class="logo">
                <img src="./user_profiles/test_upload.jpg" alt="Logo" width="80">
            </div>
            <h2 id="details">Create account as: user</h2>
            <p class="error"><?php if (isset($message)) { echo $message; } ?></p>
        <input type="email" id="email" name="email" placeholder="Enter your email"><br>
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <input type="hidden" name="role" value="user" id="role-input">
        <input type="submit" value="Submit">
        <p>Already have an account? <a href="index.php">Login</a></p>
    </form>
   </main>
    
</body>
</html>