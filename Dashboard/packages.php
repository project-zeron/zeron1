<?php
//get all packages from the database
$conn = mysqli_connect("localhost", "root", "", "zeron");

if (!$conn) {
    die("Database connection failed");
}   

$sql = "SELECT * FROM packages";
?>