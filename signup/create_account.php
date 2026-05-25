//insert new user into database
<?php   
$conn = mysqli_connect("localhost", "root", "", "zeron");       
if (!$conn) {
    die("Database connection failed");
}
$email = $_POST['email'];
$password = $_POST['password'];
$role = "user";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)"; 
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sss", $email, $hashed_password, $role);
if (mysqli_stmt_execute($stmt)) {
    header("Location: ../Dashboard?message=account_created_successfully");
    exit();
} else {
    header("Location: signup.php?message=account_creation_failed");
    exit();
}  

//get the details of the newly created user to set session variables
$sql = "SELECT * FROM users WHERE email = ?";    
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt); 
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header("Location: index.php?message=there was an error creating your account, that is all we know");
    exit();
}   
$user = mysqli_fetch_assoc($result);


//start session and set session variables for the new user
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['role'] = $role;

//close session and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

 