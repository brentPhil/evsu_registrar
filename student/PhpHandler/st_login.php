<?php
session_start();
include '../../db_conn/config.php';

if (empty($_POST['st_id'])) {
    $_SESSION['error'] = 'Pls enter Student ID';
    header("Location: /evsu_registrar/student_login.php");
    exit();
}

if (empty($_POST['password'])) {
    $_SESSION['error_pass'] = 'Pls enter your password';
    header("Location: /evsu_registrar/student_login.php");
    exit();
}

$st_id = mysqli_real_escape_string($conn, $_POST['st_id']);

if ($stmt = $conn->prepare('SELECT st_id, user_name, dept_id, password, Profile_ID FROM student WHERE student_id = ?')) {
    $stmt->bind_param('s', $st_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $deptId, $password, $Profile_ID);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $name;
            $_SESSION['dept_id'] = $deptId;
            $_SESSION['id'] = $id;
            $_SESSION['Profile_ID'] = $Profile_ID;
            if (!isset($Profile_ID)) {
                $_SESSION['success'] = 'Welcome <span class="text-capitalize fw-bolder">'.$name.'!</span> Please Set up your profile before we continue';
                header('Location: /evsu_registrar/st_profile.php');
            } else {
                $_SESSION['success'] = 'Welcome back <span class="text-capitalize fw-bold">'.$name.'!</span>';
                header('Location: /evsu_registrar/student/st_main.php');
            }
            unset($_SESSION['error_pass']);
            unset($_SESSION['error']);
        } else {
            $_SESSION['error_pass'] = 'Password is Invalid';
            header("Location: /evsu_registrar/student_login.php");
        }
    } else {
        $_SESSION['error'] = 'Invalid Student ID';
        header("Location: /evsu_registrar/student_login.php");
    }
    exit();
}

