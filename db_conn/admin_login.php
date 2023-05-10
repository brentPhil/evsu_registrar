<?php
session_start();
include 'config.php';

if ( empty($_POST['username'])) {
    header("Location: ../../admin_login.php?error=Pls enter username");
    exit();
}
elseif ( empty($_POST['password'])){
    header("Location: ../../admin_login.php?error=Pls enter password");
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
            header("Location: ../admin/dashboard.php?success=Welcome");
        } else {
            header("Location: ../admin_login.php?error=Incorrect Password");
        }
    } else {
        header("Location: ../admin_login.php?error=Username doesn't exist");
    }
    exit();
}

