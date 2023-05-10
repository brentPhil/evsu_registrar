<?php
//this is for admin_request.php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$db_name = "Sched_system";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $db_name);

if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}