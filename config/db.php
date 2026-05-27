<?php
//connect to the database and for include in all files that need database connection
$conn = mysqli_connect("localhost", "root", "", "zeron");
if (!$conn) {
    die("Database connection failed");
}

?>