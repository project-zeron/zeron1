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
    <link rel="stylesheet" href="./CSS/styles.css">
</head>
<body>
   <header>
            <h1>Project Zeron</h1>
        </header>
        <div class="nav">
            <button id="team-btn">user</button>
            <button id="admin-btn">admin</button>
        </div>
   <main>
    <form action="login.php" method="post">
       <div class="logo">
                <img src="./user_profiles/test_upload.jpg" alt="Logo" width="80">
            </div>
            <h2 id="details">login as: user</h2>
            <p class="error"><?php if (isset($message)) { echo $message; } ?></p>
        <input type="email" id="email" name="email" placeholder="Enter your email"><br>
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <input type="hidden" name="role" value="user" id="role-input">
        <input type="submit" value="Submit">
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </form>
   </main>

      <script>
       function switchRole(location){
        document.getElementById('role-input').value = location;
        document.getElementById('details').textContent = 'login as: ' + location;

       }

         document.getElementById('team-btn').addEventListener('click', function() {
          switchRole('user');
         });
            document.getElementById('admin-btn').addEventListener('click', function() {
            switchRole('admin');
            });

    </script>
    
</body>
</html>