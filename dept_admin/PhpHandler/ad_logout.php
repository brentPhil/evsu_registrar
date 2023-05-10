<?php
session_start();
unset($_SESSION["dept_login"]);
// Redirect to the login page:
header('Location: ../../admin_login.php');