<?php
session_start();
include 'config.php';

if ( empty($_POST['username'])) {
    $_SESSION['error'] = 'Pls enter your username';
    header("Location: /evsu_registrar/admin_login.php");
    exit();
}
elseif ( empty($_POST['password'])){
    $_SESSION['error'] = 'Pls enter your password';
    header("Location: /evsu_registrar/admin_login.php");
    exit();
}

if ($stmt = $conn->prepare('SELECT id, dept_id, password FROM admin WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id,$dept_id, $password);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['admin_login'] = TRUE;
            $_SESSION['ad_name'] = $_POST['username'];
            $_SESSION['dept_id'] = $dept_id;
            $_SESSION['id'] = $id;
            $_SESSION['success'] = 'Welcome back '. $_POST['username'];
            header("Location: ../admin/dashboard.php");
        } else {
            $_SESSION['error'] = 'Invalid password';
            header("Location: /evsu_registrar/admin_login.php");
        }
    } else {
        $_SESSION['error'] = 'Username doesnt exist';
        header("Location: /evsu_registrar/admin_login.php");
    }
    exit();
}

