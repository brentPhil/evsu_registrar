<?php
session_start();
include '../../db_conn/config.php';

if (empty($_POST['st_id']) || empty($_POST['password'])) {
    handle_error('Please enter username and password');
}

$st_id = mysqli_real_escape_string($conn, $_POST['st_id']);

if ($stmt = $conn->prepare('SELECT st_id, user_name, dept_id, password, Profile_ID FROM student WHERE student_id = ?')) {
    $stmt->bind_param('s', $st_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $dept_id, $password, $Profile_ID);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $name;
            $_SESSION['dept_id'] = $dept_id;
            $_SESSION['id'] = $id;
            $_SESSION['Profile_ID'] = $Profile_ID;
            if (!isset($Profile_ID)) {
                header('Location: ../../st_profile.php?setup');
            } else {
                header('Location: ../st_main.php?success=Welcome');
            }
            exit();
        }
    }
}

handle_error('Incorrect username or password');

function handle_error($message) {
    header('Location: ../../student_login.php?error=' . urlencode($message));
    exit();
}
