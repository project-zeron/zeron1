<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "zeron");

if (!$conn) {
    die("Database connection failed");
}

$email = $_POST['email'];
$password = $_POST['password'];
$form_role = $_POST['role'];

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {

    header("Location: index.php?message=username_not_found");
    exit();

}

$user = mysqli_fetch_assoc($result);

if (!password_verify($password, $user['password'])) {

    header("Location: index.php?message=Incorrect_password");
    exit();

}

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['user_name'];
$_SESSION['role'] = $user['role'];

if ($user['role'] === 'admin' && $form_role === 'admin') {

    header("Location: ./admin_dashboard?message=admin_login_successful");
    exit();

}

if ($form_role === 'admin' && $user['role'] !== 'admin') {

    header("Location: ./Dashboard?message=admin_access_denied");
    exit();

}

header("Location: ./Dashboard?message=login_successful");
exit();


?>