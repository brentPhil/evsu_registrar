<?php
include '../../db_conn/insert.php';
$insert = new insert();
session_start();
if (isset($_POST['save_pro'])) {
    $required_fields = array('lname', 'fname', 'middle', 'gender', 'address', 'email', 'phone');

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            header("Location: ../../st_profile.php?error=Pls fill up all the fields");
            exit();
        }
    }

    $result = $insert->save_profile(
        $_SESSION['id'],
        $_POST['course'],
        $_POST['lname'],
        $_POST['fname'],
        $_POST['middle'],
        $_POST['gender'],
        $_POST['address'],
        $_POST['email'],
        $_POST['phone']
    );

    if ($result) {
        header("Location: ../st_main.php?success=Welcome");
    } else {
        header("Location: ../../st_profile.php?error");
    }
}
