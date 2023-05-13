<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /evsu_registrar/student_login.php");
    exit;
}

if (!isset($_SESSION['Profile_ID'])){
    header("Location: /evsu_registrar/st_profile.php");
    exit;
}