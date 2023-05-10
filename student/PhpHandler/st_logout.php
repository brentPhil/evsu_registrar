<?php
session_start();
unset($_SESSION["loggedin"]);
unset($_SESSION["id"]);
unset($_SESSION['Profile_ID']);
unset($_SESSION['dept_id']);
unset($_SESSION['name']);
// Redirect to the login page:
header('Location: ../../student_login.php');