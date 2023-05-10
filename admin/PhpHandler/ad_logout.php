<?php
session_start();
unset($_SESSION["admin_login"]);
// Redirect to the login page:
header('Location: ../../admin_login.php');